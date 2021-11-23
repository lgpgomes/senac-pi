<?php
date_default_timezone_set('America/Sao_Paulo');

//Função Cadastrar Usuários
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
    $q->execute(array(ucwords($nome), $senha, $email, $tipo, 1));
    Banco::desconectar();
    return "Sucesso!";
}
//Função Cadastrar Serviços
function cadastrarServico($descricao, $imagem_nome, $icone_nome)
{
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert = "INSERT INTO servico(`Descricao`, `Imagem`, `Icone`, Status) VALUES (?,?,?,?)";
    $q = $pdo->prepare($insert);
    $q->execute(array(ucwords($descricao), $imagem_nome, $icone_nome, STATUS_SERVICO_ATIVO));
    Banco::desconectar();
    return "Sucesso!";
}
//Função Editar Serviços
function editarServico($descricao, $imagem_nome, $icone_nome, $id)
{
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (empty($icone_nome) && empty($imagem_nome)) {
        $update = "UPDATE `servico` SET `DESCRICAO`='$descricao' WHERE `ID` = $id";
    } else if (empty($imagem_nome)) {
        $update = "UPDATE `servico` SET `DESCRICAO`='$descricao', `ICONE`='$icone_nome' WHERE `ID` = $id";
    } else if (empty($icone_nome)) {
        $update = "UPDATE `servico` SET `DESCRICAO`='$descricao',`IMAGEM`='$imagem_nome' WHERE `ID` = $id";
    } else {
        $update = "UPDATE `servico` SET `DESCRICAO`='$descricao',`IMAGEM`='$imagem_nome',`ICONE`='$icone_nome' WHERE `ID` = $id";
    }
    $q = $pdo->prepare($update);
    $q->execute(array(ucwords($descricao), $imagem_nome, $icone_nome, $id));
    Banco::desconectar();
    return "Sucesso!";
}
//Função Verificar Existencia Email
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
//Função Para Marcar Agendamentos
function agendar($idServico, $date, $time, $status, $idFuncionario, $idCliente)
{
    $data = $date.' '.$time;
    if(validarAgendamento($data, $idFuncionario) -> rowCount() > 0){
        return 'Horário Ocupado!';
    }
    else if ($data <= date('Y-m-d H:i:s') || fimDeSemana($date) == true || $time < '08:00:00' || $time > '17:00:00') {
        return 'Data Inválida!';
    }
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert = "INSERT INTO `agendamento`(ID_SERV, DATA_HORA, STATUS, ID_FUNCIONARIO, ID_CLIENTE) VALUES (?,?,?,?,?)";
    $q = $pdo->prepare($insert);
    $q->execute(array($idServico, $data, $status, $idFuncionario, $idCliente));
    Banco::desconectar();
    return 'Sucesso!';
}
//Função Recuperar Senha
function resetPassword($email, $senha, $confirmar_senha) 
{
    $erro = validarCampo('null', 'null', $senha, $confirmar_senha);
    if (!empty($erro)) {
        return $erro;
    }
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update = "UPDATE `usuario` SET `SENHA`='$senha' WHERE usuario.EMAIL = '$email'";
    $q = $pdo->prepare($update);
    $q->execute(array($senha));
    Banco::desconectar();
    return 'Sucesso!';
}
//Função Editar Usuários
function editarUsuario($nome, $senha, $confirmar_senha, $id) 
{
    $erro = validarCampo('null', $nome, $senha, $confirmar_senha);
    if (!empty($erro)) {
        return $erro;
    }
    
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (empty($senha)) {
        $update = "UPDATE `usuario` SET `NOME`='$nome' WHERE `ID` = $id";
    } else {
        $update = "UPDATE `usuario` SET `NOME`='$nome',`SENHA`='$senha' WHERE `ID` = $id";
    }
    $q = $pdo->prepare($update);
    $q->execute(array(ucwords($nome), $senha));
    Banco::desconectar();
    return 'Sucesso!';
}
//Função Validar Campos
function validarCampo($email, $nome, $senha, $confirmar_senha) {
    if(empty($nome)) {
         return 'Nome Em Branco!';
    }
    else if(empty($email)) {
        return 'Email Em Branco!';
    }
    else if (validarExistencia($email) > 0 && $email != 'null') {
        return 'Usuário Já Existe!';
    }
    else if (filter_var($email, FILTER_VALIDATE_EMAIL) != true && $email != 'null') {
        return 'Insira Um E-mail Válido!';
    }  
    else if (empty($senha)) {
        return 'Senha Em Branco!';
    }
    else if (empty($confirmar_senha)) {
        return 'Confirmar Senha Em Branco!';
    }
    else if ($senha != $confirmar_senha) {
        return 'As Senhas Não Coincidem!';
    } 
    return "";
}
//Verifica Se Data Está Livre 
function validarAgendamento($dataEscolhida, $idFuncionario){
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = "SELECT `ID_FUNCIONARIO`,`DATA_HORA` FROM `agendamento` WHERE `ID_FUNCIONARIO`= '$idFuncionario' and `DATA_HORA`= '$dataEscolhida'";
    Banco::desconectar();
    return $pdo -> query($consulta);
}
//Muda Status Do Agendamento Para Concluído/Cancelado
function statusAgend($idServico, $status){
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update = "UPDATE `agendamento` SET `STATUS`= '$status' WHERE `ID`= '$idServico'";
    $q = $pdo->prepare($update);
    $q->execute(array($status, $idServico));
    Banco::desconectar();
}
//Ativa/Desativa Usuário
function statusUser($idUsuario, $statusUser){
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update = "UPDATE `usuario` SET `STATUS`= '$statusUser' WHERE `ID`= '$idUsuario'";
    $q = $pdo->prepare($update);
    $q->execute(array($statusUser, $idUsuario));
    Banco::desconectar();
}
//Ativa/Desativa Serviços
function statusServ($idServico, $statusServico){
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update = "UPDATE `servico` SET `STATUS`= '$statusServico' WHERE `ID`= '$idServico'";
    $q = $pdo->prepare($update);
    $q->execute(array($statusServico, $idServico));
    Banco::desconectar();
}

function fimDeSemana($date) {
    $weekDay = date('w', strtotime($date));
    return ($weekDay == 0 || $weekDay == 6);
}
?>
