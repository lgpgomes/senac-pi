<?php
const STATUS_AGENDAMENTO_PENDENTE = 1; 
const STATUS_AGENDAMENTO_CANCELADO = 2; 
const STATUS_AGENDAMENTO_CONCLUIDO = 3; 

class Usuario {
    private $id;
    private $email;
    private $nome;
    private $senha;
    private $tipo;
    private $status;

    public function set_id($id) {
        $this -> id = $id;
    }
    public function get_id() {
        return $this -> id;
    }
    public function set_email($email) {
        $this -> email = $email;
    }
    public function get_email() {
        return $this -> email;
    }
    public function set_nome($nome) {
        $this -> nome = $nome;
    }
    public function get_nome() {
        return $this -> nome;
    }
    public function set_senha($senha) {
        $this -> senha = $senha;
    }
    public function get_senha() {
        return $this -> senha;
    }
    public function set_tipo($tipo) {
        $this -> tipo = $tipo;
    }
    public function get_tipo() {
        return $this -> tipo;
    }
    public function set_status($status) {
        $this -> status = $status;
    }
    public function get_status() {
        return $this -> status;
    }

    public function Logar($email, $senha)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $insert = "SELECT Nome, Status, Email, Senha, Tipo, ID FROM usuario WHERE Email = ? AND Senha = ? AND Status = 1";
        $q = $pdo->prepare($insert);
        $q->execute(array($email, $senha));
        $dados = $q -> fetch(PDO::FETCH_ASSOC);
        Banco::desconectar();
        
        if($q -> rowCount() > 0) {
            session_start();
            $usuario = new Usuario();
            $usuario -> set_nome($dados['Nome']);
            $usuario -> set_email($dados['Email']);
            $usuario -> set_senha($dados['Senha']);
            $usuario -> set_tipo($dados['Tipo']);
            $usuario -> set_status($dados['Status']);
            $usuario -> set_id($dados['ID']);
            $_SESSION['usuario'] = $usuario;
            return true;
        } else {
            return false;
        }
    }
}

function obterFuncionarios() {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = "SELECT ID, NOME, SENHA, EMAIL, TIPO, STATUS FROM usuario WHERE Tipo = 1";
    Banco::desconectar();
    return $pdo -> query($consulta);
}

function obterServicos() {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = "SELECT ID, DESCRICAO, IMAGEM, ICONE, STATUS FROM servico";
    Banco::desconectar();
    return $pdo -> query($consulta);
}

function obterAgendamentos($id, $tipo, $status) {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($tipo == 1) {
        $consulta = "SELECT agendamento.data_hora, usuario.nome, servico.descricao from agendamento, usuario, servico where agendamento.id_serv = servico.id and agendamento.id_cliente = usuario.id and id_funcionario = $id and agendamento.status = $status;";
    } else {
        $consulta = "SELECT agendamento.data_hora, usuario.nome, servico.descricao from agendamento, usuario, servico where agendamento.id_serv = servico.id and agendamento.id_funcionario = usuario.id and id_cliente = $id and agendamento.status = $status;";
    }
    Banco::desconectar();
    return $pdo -> query($consulta);
}

?>