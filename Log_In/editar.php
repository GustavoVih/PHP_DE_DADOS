<?php

include_once 'php_action/db_connect.php';

include_once 'includes/header.php';


if(isset($_GET['id'])):
    $id = mysqli_escape_string($connect, $_GET['id']);

    $sql = "SELECT id, nome, login, email FROM usuario WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
endif;
?>
<div class="row">
    <div class="col s12 m6 push-m3">
        <h3 class="light">Editar Login</h3>
        <form action="php_action/update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $dados['id'];?>">
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome" value="<?php echo $dados['nome'];?>">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="login" id="login" value="<?php echo $dados['login'];?>">
                <label for="login">Login</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="email" id="email" value="<?php echo $dados['email'];?>">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="senha" id="senha" value="">
                <label for="senha">Senha</label>
            </div>
            <button type="submit" name="btn-editar" class="btn">    Atualizar   </button>
            <a href="index.php" class="btn green">Lista de Logins</a>
        </form>
    </div>
</div>

<?php
//Footer
include_once 'includes/footer.php';
?>