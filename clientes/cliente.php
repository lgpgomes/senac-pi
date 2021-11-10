<?php
const TIPO_USUARIO_FUNCIONARIO = 1;
const TIPO_USUARIO_CLIENTE = 2;
const STATUS_USUARIO_ATIVO = 1; 
const STATUS_SERVICO_ATIVO = 1; 

function cadastrarUsuario($nome, $senha, $confirmar_senha, $email, $tipo)
{
    $erro = validarCampo($email, $nome, $senha, $confirmar_senha);

    if (!empty($erro)) {
        return $erro;
    }

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert = "INSERT INTO usuario(`Nome`, `Senha`, `Email`, Tipo, Status) VALUES (?,?,?,?,?)";
    $q = $pdo->prepare($insert);
    $q->execute(array(ucwords($nome), $senha, $email, $tipo, STATUS_USUARIO_ATIVO));
    Banco::desconectar();
}


function cadastrarServico($descricao, $imagem_nome, $icone_nome)
{
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert = "INSERT INTO servico(`Descricao`, `Imagem`, `Icone`, Status) VALUES (?,?,?,?)";
    $q = $pdo->prepare($insert);
    $q->execute(array(ucwords($descricao), $imagem_nome, $icone_nome, STATUS_SERVICO_ATIVO));
    Banco::desconectar();
    return true;
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

function agendar($idServico, $data, $status, $idFuncionario, $idCliente)
{
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert = "INSERT INTO `agendamento`(ID_SERV, DATA_HORA, STATUS, ID_FUNCIONARIO, ID_CLIENTE) VALUES (?,?,?,?,?)";
    $q = $pdo->prepare($insert);
    $q->execute(array($idServico, $data, $status, $idFuncionario, $idCliente));
    Banco::desconectar();
    return true;
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
