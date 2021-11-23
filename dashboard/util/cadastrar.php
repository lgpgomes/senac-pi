<?php
//Cadastra Servicos
if (isset($_POST['cadDescricaoServico'])) {
    $descricao = $_POST['cadDescricaoServico'];
    $imagem_nome = ""; 
    $icone_nome = "";
    $tamanhoImagem = "";
    $tamanhoIcone = "";
    if(!empty($_FILES['imagem']) && !empty($_FILES['icone'])) {
        //Imagem
        $imagem_nome = str_replace(" ", "_", $_FILES['imagem']['name']);
        $caminho_imagem = "../../assets/uploads/img/".basename($imagem_nome);
        $tamanhoImagem = $_FILES['imagem']['size'];
        if( $tamanhoImagem < 500000){
            $tamanhoImagem = 0;
            move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem);
        }
        //Icone
        $icone_nome = str_replace(" ", "_", $_FILES['icone']['name']);
        $caminho_icone = "../../assets/uploads/icons/".basename($icone_nome);
        $tamanhoIcone = $_FILES['icone']['size'];
        if( $tamanhoIcone < 100000){
            $tamanhoIcone = 0;
            move_uploaded_file($_FILES['icone']['tmp_name'], $caminho_icone);
        }
    }
    $msg = cadastrarServico($descricao, $imagem_nome, $icone_nome, $tamanhoImagem, $tamanhoIcone);
    if ($msg == "Sucesso!") {
        $msg = "Serviço Cadastrado!";
        $event = 1;
    } else {
        $event = 0;
    }
}
//Cadastra Funcionario
if (isset($_POST['cadNomeFunc'])) {
    $nome = $_POST['cadNomeFunc'];
    $senha = $_POST['cadSenhaFunc'];
    $confirmar_senha = $_POST['cadCsenhaFunc'];
    $email = $_POST['cadEmailFunc'];
    $msg = cadastrarUsuario($nome, $senha, $confirmar_senha, $email, TIPO_USUARIO_FUNCIONARIO);
    if ($msg == "Sucesso!") {
        $msg = "Funcionário Cadastrado!";
        $event = 1;
    } else {
        $event = 0;
    }
}
//Cadastra Cliente
if (isset($_POST['cadNomeClient'])) {
    $nome = $_POST['cadNomeClient'];
    $senha = $_POST['cadSenhaClient'];
    $confirmar_senha = $_POST['cadCsenhaClient'];
    $email = $_POST['cadEmailClient'];
    $msg = cadastrarUsuario($nome, $senha, $confirmar_senha, $email, TIPO_USUARIO_CLIENTE);
    if ($msg == "Sucesso!") {
        $msg = "Cliente Cadastrado!";
        $event = 1;
    } else {
        $event = 0;
    }
}
//Edita Servicos
if (isset($_POST['editDescricaoServico'])) {
    $descricao = $_POST['editDescricaoServico'];
    $id = $_POST['editIdServico'];
    $imagem_nome = ""; 
    $icone_nome = "";
    $tamanhoImagem = "";
    $tamanhoIcone = "";
    if(!empty($_FILES['imagem'])) {
        $imagem_nome = str_replace(" ", "_", $_FILES['imagem']['name']);
        $caminho_imagem = "../../assets/uploads/img/".basename($imagem_nome);
        $tamanhoImagem = $_FILES['imagem']['size'];
        if( $tamanhoImagem < 500000){
            $tamanhoImagem = 0;
            move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem);
        }
    } 
    if(!empty($_FILES['icone'])) {
        $icone_nome = str_replace(" ", "_", $_FILES['icone']['name']);
        $caminho_icone = "../../assets/uploads/icons/".basename($icone_nome);
        $tamanhoIcone = $_FILES['icone']['size'];
        if( $tamanhoIcone < 100000){
            $tamanhoIcone = 0;
            move_uploaded_file($_FILES['icone']['tmp_name'], $caminho_icone);
        }
    }
    $msg = editarServico($descricao, $imagem_nome, $icone_nome, $id, $tamanhoImagem, $tamanhoIcone);
    if ($msg == "Sucesso!") {
        $msg = "Serviço Alterado!";
        $event = 1;
    } else {
        $event = 0;
    }
}
//Edita Funcionario e Cliente
if (isset($_POST['editNomeUser'])) {
    $nome = $_POST['editNomeUser'];
    $senha = $_POST['editSenhaUser'];
    $confirmar_senha = $_POST['editCsenhaUser'];
    $id =  $_POST['editIdUser'];
    $msg = editarUsuario($nome, $senha, $confirmar_senha, $id);
    if ($msg == "Sucesso!") {
        $msg = "Usuário Alterado!";
        $event = 1;
    } else {
        $event = 0;
    }
}
//Muda status agendamento  
if (isset($_POST['statusAgend'])) {
    $id = $_POST['idAgend'];
    $status = $_POST['statusAgend'];
    statusAgend($id, $status);
}

//Ativa/Desativa Servicos
if (isset($_POST['idServ'])) {
    $id = $_POST['idServ'];
    if($_POST['statusServ'] == 0){
        $status = 1;
    } else {
        $status = 0;
    }
    statusServ($id, $status);
}
//Ativa/Desativa Usuarios
if (isset($_POST['idUser'])) {
    $id = $_POST['idUser'];
    if($_POST['statusUser'] == 0){
        $status = 1;
    } else {
        $status = 0;
    }
    statusUser($id, $status);
}
//Funcao de agendamento
if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $idServico = $_POST['idServico'];
    $idFuncionario = $_POST['idFuncionario'];
    $msg = agendar($idServico, $date, $time, 1, $idFuncionario, $_SESSION['usuario'] -> get_id());
    if ($msg == 'Sucesso!') {
        $msg = "Agendamento Feito Para ".date("d/m/Y", strtotime($date))." às ".date("H:i", strtotime($time));
        $event = 1;
    } else {
        $event = 0;  
    }
} 
ob_start();

ob_end_clean();

if(isset($msg)) {
    $data = array();
    $data['event'] = $event;
    $data['msg'] = $msg;
    if (!empty($data)) {
        echo json_encode($data);
    }
}



?>