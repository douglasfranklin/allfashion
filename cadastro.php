<?php
    include_once 'config/conexao.php';
    $db = new Conexao();

    // print_r($_POST);exit;

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    // $email = "cassi.nodari@hotmail.com";
    $cpf = $_POST['cpf'];
    $senha = MD5($_POST['senha']);
    // $db = mysqli_select_db('allfashion');
    $query_select = "SELECT * FROM USUARIOS WHERE email = '$email'";

    $existe_email = $db->executa($query_select);
    $existe_email = $existe_email->fetch_array();
    // print_r($existe_email);
    // echo count($existe_email);exit;
    if (count($existe_email) > 0) {
        echo '<script>alert("Este e-mail já está cadastrado em nossa base de dados!"); window.location.href = "formCadastro.php"; </script>';
        exit;
    }

    $sql = "INSERT INTO USUARIOS (nome, email, cpf, senha) VALUES ('".$nome."', '".$email."', '".$cpf."', '".$senha."')";
    $db->executa($sql);

    session_start();

    $_SESSION['usuario']['nome'] = $nome;
    $_SESSION['usuario']['email'] = $email;
    $_SESSION['usuario']['cpf'] = $cpf;

    echo '<script>alert("Usuário cadastrado com sucesso!"); window.location.href = "index.php"; </script>';
?>
