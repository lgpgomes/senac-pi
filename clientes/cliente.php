<?php
require '../banco/banco.php';

const TIPO_USUARIO_CLIENTE = 2; 
const STATUS_CLIENTE_ATIVO = 0; 


function Cadastrar($nome, $senha, $confirmar_senha, $email)
{
    $erro = validarCampo($email, $nome, $senha, $confirmar_senha);

    if (!empty($erro)) {
        return $erro;
    }

    if (ValidarClienteExiste($email) > 0) {
        return '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Usuário Já Existe!</span> </div>';
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
    $insert = "SELECT Email, Senha, Tipo, ID FROM usuario WHERE Email = ? AND Senha = ? AND Status = 1";
    $q = $pdo->prepare($insert);
    $q->execute(array($email, $senha));
    $dados = $q -> fetch(PDO::FETCH_ASSOC);
    Banco::desconectar();
    
    if($q -> rowCount() > 0){
        session_start();
        $_SESSION['usuario_tipo'] = $dados['tipo'];
        $_SESSION['usuario_id'] = $dados['id'];

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

function validarCampo($email, $nome, $senha, $confirmar_senha) {
    if(empty($nome)) {
         return '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Nome Em Branco!</span> </div>';
    }
    if(empty($email)) {
        return '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Email Em Branco!</span> </div>';
    }
    return "";
}
?>
