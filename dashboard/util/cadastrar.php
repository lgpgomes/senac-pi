<?php

if (isset($_POST['cadservicos'])) {
    $descricao = $_POST['descricao'];
    $imagem_nome = str_replace(" ", "_", $_FILES['imagem']['name']);
    $caminho_imagem = "../assets/uploads/img/".basename($imagem_nome);
    $icone_nome = str_replace(" ", "_", $_FILES['icone']['name']);
    $caminho_icone = "../assets/uploads/icons/".basename($icone_nome);

    if(cadastrarServico($descricao, $imagem_nome, $icone_nome) && move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem) && move_uploaded_file($_FILES['icone']['tmp_name'], $caminho_icone)) {
        header('Location: ./dashboard.php');
        $msg = '<div id="msg" class="msgSucesso"><i class="fa fa-check"></i> <span>Cadastro Realizado!</span> </div>';
    } 
    else {
        header('Location: ./dashboard.php');
        $msg = '<div id="msg" class="msgErro"><i class="fa fa-exclamation-triangle"></i> <span>Ocorreu Um Erro!</span> </div>';
    }
}

if (isset($_POST['cadfuncionario'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $email = $_POST['email'];
    $Mensagem = cadastrarUsuario($nome, $senha, $confirmar_senha, $email, TIPO_USUARIO_FUNCIONARIO);

    if(isset($Mensagem)) {
        header('Location: ./dashboard.php');
        $msg= $Mensagem;
    } 
    else {
        header('Location: ./dashboard.php');
        $msg = '<div id="msg" class="msgSucesso"><i class="fa fa-check"></i> <span>Cadastro Realizado!</span> </div>';
    }
}

if (isset($_POST['cadcliente'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $email = $_POST['email'];
    $Mensagem = cadastrarUsuario($nome, $senha, $confirmar_senha, $email, TIPO_USUARIO_CLIENTE);

    if(isset($Mensagem)) {
        header('Location: ./dashboard.php');
        $msg = $Mensagem;
    } 
    else {
        header('Location: ./dashboard.php');
        $msg = '<div id="msg" class="msgSucesso"><i class="fa fa-check"></i> <span>Cadastro Realizado!</span> </div>';
    }
}

if (isset($_POST['agendamento'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $idServico = $_POST['servico'];
    $idFuncionario = $_POST['profissional'];
    $data = $date.' '.$time.':00';
    agendar($idServico, $data, 1, $idFuncionario, $_SESSION['usuario'] -> get_id());
}
?>