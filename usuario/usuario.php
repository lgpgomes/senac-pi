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
function obterClientes() {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = "SELECT ID, NOME, SENHA, EMAIL, TIPO, STATUS FROM usuario WHERE Tipo = 2";
    Banco::desconectar();
    return $pdo -> query($consulta);
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

function charts() {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = "SELECT servico.DESCRICAO, COUNT(agendamento.ID_SERV) as Total_Sevicos FROM `agendamento` INNER JOIN servico on servico.ID=agendamento.ID_SERV GROUP by agendamento.ID_SERV ORDER by COUNT(agendamento.ID_SERV) DESC;";
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

function obterTodosAgendamentos() {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = 'SELECT DISTINCT agendamento.ID, agendamento.DATA_HORA, servico.DESCRICAO, usuario.NOME AS NOME_FUNCIONARIO,  AGEND_CLIENTE.NOME_CLIENTE, 
    CASE WHEN agendamento.STATUS=1 THEN "PENDENTE" WHEN agendamento.STATUS=2 THEN "CANCELADO" ELSE "CONCLUIDO" END AS STATUS
    FROM `agendamento`
    INNER JOIN servico on servico.ID=agendamento.ID_SERV
    INNER JOIN usuario on usuario.ID =agendamento.ID_FUNCIONARIO AND usuario.TIPO=1
    INNER JOIN 
    (SELECT agendamento.ID AS AGEND_ID, usuario.NOME AS NOME_CLIENTE
    FROM `agendamento`
    INNER JOIN servico on servico.ID=agendamento.ID_SERV
    INNER JOIN usuario on usuario.ID =agendamento.ID_CLIENTE AND usuario.TIPO=2) AGEND_CLIENTE 
    ON AGEND_ID=agendamento.ID;';
    Banco::desconectar();
    return $pdo -> query($consulta);
}

function validarUsuario($email, $data) {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = "SELECT DATE_FORMAT(agendamento.DATA_HORA, '%Y-%m-%d') as DATA_HORA
    FROM agendamento, usuario
    WHERE agendamento.ID_CLIENTE = usuario.ID
    AND usuario.EMAIL = '$email'
    AND DATE(DATA_HORA) = '$data'
    ORDER BY agendamento.DATA_HORA DESC;";
    Banco::desconectar();
    return $pdo -> query($consulta);
}

function resetPassword($email, $senha) {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = "UPDATE `usuario` SET `SENHA`='$senha' WHERE usuario.EMAIL = '$email'";
    Banco::desconectar();
    return $pdo -> query($consulta);
}
?>