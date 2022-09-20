<?php

//Sessão
session_start();

// A função error_reporting(0) não mostra os erros ao usuário
// Pensei em usar ela, contudo ela não leva o cliente à página adicionar.php de volta!!!
// error_reporting(0);

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

    // Variáveis que usaria no if especial do método wilberT (tacar comando no sql por variáveis instanciadas)

    // $logins = "SELECT COUNT(*) FROM usuario WHERE login = '$login'";

    // $emails = "SELECT COUNT(*) FROM usuario WHERE email = '$email'";

    // Esse if tem como objetivo verificar se os dados que acabaram de entrar estão vazios
    // Tem varios if's dentro do if main pois queria tratar cada dado vazio de maneira particular!
    if(empty($_POST['nome']) or empty($_POST['login']) or empty($_POST['email']) or empty($_POST['senha'])):

        if(empty($_POST['nome'])):
            // Textinho em vermelho sobre o nome
        endif;

        if(empty($_POST['login'])):
            // Textinho em vermelho sobre o login
        endif;

        if(empty($_POST['email'])):
            // Textinho em vermelho sobre o email
        endif;

        if(empty($_POST['senha'])):
            // Textinho em vermelho sobre a senha
        endif;

        header('Location: ../adicionar.php');
        exit(0);
    endif;

    // Apartir daqui foi só erroKKKKKK ;(

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

/*
    if((mysqli_query($connect, $logins)) or (mysqli_query($connect, $emails))):
        //Nothin
    else:
        header('Location: ../adicionar.php');
        exit(0);
    endif;
*/

    //Verifica se a senha inserida pelo usuário tem mais do que 8 dígitos!!!
    // Tudo graças a função strlen()!
    if(strlen($senha) < 8):
        header("Location: ../adicionar.php");
        exit(0);
    endif;

    //Tratamento de erro, usei caso tenha cadastros repetitivos!!!
    // OBS: ela trata o erro de dados repetitivos por chaves únicas no SQL
    // Tudo mérito da função error_reporting(E_ALL), que pode ser usada para tratar erros
    if(error_reporting(E_ALL)){
        header('Location: ../adicionar.php');
        exit(0);
    }

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