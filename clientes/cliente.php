<?php
require '../banco/banco.php';

const TIPO_USUARIO_CLIENTE = 2; 
const STATUS_CLIENTE_ATIVO = 0; 
const TIPO_USUARIO_FUNCIONARIO = 1; 
const STATUS_FUNCIONARIO_ATIVO = 0; 

function cadastrarCliente($nome, $senha, $confirmar_senha, $email)
{
    $erro = validarCampo($email, $nome, $senha, $confirmar_senha);

    if (!empty($erro)) {
        return $erro;
    }

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert = "INSERT INTO usuario(`Nome`, `Senha`, `Email`, Tipo, Status) VALUES (?,?,?,?,?)";
    $q = $pdo->prepare($insert);
    $q->execute(array(ucwords($nome), $senha, $email, TIPO_USUARIO_CLIENTE, STATUS_CLIENTE_ATIVO));
    Banco::desconectar();
}


function cadastrarFuncionario($nome, $senha, $confirmar_senha, $email)
{
    $erro = validarCampo($email, $nome, $senha, $confirmar_senha);

    if (!empty($erro)) {
        return $erro;
    }
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert = "INSERT INTO usuario(`Nome`, `Senha`, `Email`, Tipo, Status) VALUES (?,?,?,?,?)";
    $q = $pdo->prepare($insert);
    $q->execute(array(ucwords($nome), $senha, $email, TIPO_USUARIO_FUNCIONARIO, STATUS_FUNCIONARIO_ATIVO));
    Banco::desconectar();
}


function validarExistencia($email)
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
    if (validarExistencia($email) > 0) {
        return '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Usuário Já Existe!</span> </div>';
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) != true) {
        return '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Insira Um E-mail Válido!</span></div>';
    }  
    if(empty($senha)) {
        return '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Senha Em Branco!</span> </div>';
    }
    if(empty($confirmar_senha)) {
        return '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Confirmar Senha Em Branco!</span> </div>';
    }
    if ($senha != $confirmar_senha) {
        return '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>As Senhas Não Coincidem!</span></div>';
    } 
    return "";
}
?>
