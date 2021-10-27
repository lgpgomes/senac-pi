<?php
require '../banco/banco.php';

const TIPO_USUARIO_CLIENTE = 2; 
const STATUS_CLIENTE_ATIVO = 0; 

function Cadastrar($nome, $senha, $confirmar_senha, $email)
{
    if (ValidarClienteExiste($email) > 0) {
        $_SESSION['msg'] = '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Usuário Já Existe!</span> </div>';
        return;
    } else {
        $_SESSION['msg'] = '<div class="msgSucesso"><i class="fa fa-check"></i> <span>Cadastro Feito Com Sucesso!</span> </div>';
    }
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert = "INSERT INTO usuario(`Nome`, `Senha`, `Email`, Tipo, Status) VALUES (?,?,?,?,?)";
    $q = $pdo->prepare($insert);
    $q->execute(array($nome, $senha, $email, TIPO_USUARIO_CLIENTE, STATUS_CLIENTE_ATIVO));
    Banco::desconectar();
}

function Logar($email, $senha)
{
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert = "SELECT Email, Senha FROM usuario WHERE Email = ? AND Senha = ?";
    $q = $pdo->prepare($insert);
    $q->execute(array($email, $senha));
    Banco::desconectar();
    
    if($q -> rowCount() > 0){
        return true;
    } else {
        return false;
    }
}


function ValidarClienteExiste($email)
{
    $quantidadeUsuariosExistentes = "SELECT COUNT(EMAIL) as quantidadeUsuarios FROM usuario WHERE EMAIL = ?";
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($quantidadeUsuariosExistentes);
    $q->execute(array($email));
    $dados = $q -> fetch(PDO::FETCH_ASSOC);
    Banco::desconectar();

    return $dados['quantidadeUsuarios'];
}

?>
