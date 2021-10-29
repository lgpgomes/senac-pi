<?php
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
        $insert = "SELECT Nome, Status, Email, Senha, Tipo, ID FROM usuario WHERE Email = ? AND Senha = ? AND Status = 0";
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
?>