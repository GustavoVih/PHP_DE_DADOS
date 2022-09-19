<?php

//Sessão
session_start();

//Conexão
require_once 'db_connect.php';

//Clear
function clear($input) {
    global $connect;
    //Variáveis globais podem sair da função, podem ser usadas no código inteiro!!!

    //sql
    $var = mysqli_escape_string($connect, $input);
    //Pega o código SQL e tenta escapa, pega comandos como select e executa como um variável e não um query!!!

    //xxs
    $var = htmlspecialchars($var);
    //Esse aqui também é essecial para cyber-segurança!!!

    return $var;
}

if(isset($_POST['btn-cadastrar'])):
    $nome = clear($_POST['nome']);
    $login = clear($_POST['login']);
    $email = clear($_POST['email']);
    $senha = clear($_POST['senha']);

    $logins = "SELECT COUNT(*) FROM usuario WHERE login = '$login'";

    $emails = "SELECT COUNT(*) FROM usuario WHERE email = '$email'";

    if(empty($_POST['nome']) or empty($_POST['login']) or empty($_POST['email']) or empty($_POST['senha'])):

        if(empty($_POST['nome'])):
            // Textinho em vermelho
        endif;

        if(empty($_POST['login'])):
            // Textinho em vermelho
        endif;

        if(empty($_POST['email'])):
            // Textinho em vermelho
        endif;

        if(empty($_POST['senha'])):
            // Textinho em vermelho
        endif;

        header('Location: ../adicionar.php');
        exit(0);
    endif;

    // die($logins);
    // exit(0);

    /*
    if(($logins !== 0) or ($emails !== 0)):
        if($login !== 0):
            //Textinho em vermelho
        endif;
        
        if($emails !== 0):
            // Textinho em vermelho
        endif;
        header('Location: ../adicionar.php');
        exit(0);
    endif;
    */


    if((mysqli_query($connect, $logins)) or (mysqli_query($connect, $emails))):

        if(mysqli_query($connect, $logins)):
            // Textinho em vermelho
        endif;
        
        if(mysqli_query($connect, $emails)):
            // Textinho em vermelho
        endif;

        header('Location: ../adicionar.php');
        exit(0);
    endif;
    

    if(strlen($senha) < 8):
        header("Location: ../adicionar.php");
        exit(0);
    endif;

    $sql = "INSERT INTO usuario (nome, login, email, senha) VALUES ('$nome', '$login', '$email', '$senha')";

    if(mysqli_query($connect, $sql)):
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../index.php');
    else:
        $_SESSION['mensagem'] = "Erro ao cadastrar";
        header('Location: ../index.php');
    endif;
endif;

?>