<?php
class Ba {
    public function loginFuncionario($user, $password) 
    {
        $Connection = (new BD)->getConnection();
        $stmt = $Connection->prepare("SELECT id FROM funcionarios WHERE usuario = :usuario "
                . "AND senha = :senha");

        $stmt->bindParam(':usuario', $user, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $password, PDO::PARAM_STR);
        
        $stmt->execute();
        $result = $stmt->fetch();
        
        if (count($result) > 0 )
        {
            session_start();
            $_SESSION['usuario']=$user;
            header("Location: index.php");
        }
        else
        {
            return $msg="Usuário e/ou senha incorretos";
        }
    }
    
    public function listarClientes()
    {
        $Connection = (new BD)->getConnection();
        return $Connection->query("SELECT id, nome, saldo, foto, tentativasLogin "
                . "FROM clientes")->fetchAll();
    }
    
    public function atualizarCliente($id, $saldo, $nome, $foto, $tentativasLogin)
    {
        $Connection = (new BD)->getConnection();
        $stmt = $Connection->pepare("UPDATE clientes SET nome = :nome, "
                . "saldo:saldo, foto:foto, tentativasLogin:tentativasLogin")->fetchAll();
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':saldo', $saldo);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':tentativasLogin', $tentativasLogin);
        
        $stmt->execute();
    }
    
    public function novoCliente($id, $saldo, $nome, $foto)
    {
        $Connection = (new BD)->getConnection();
        $stmt = $Connection->pepare("INSERT INTO clientes (nome, saldo, foto, tentativasLogin)"
                . "values (:nome, :saldo, :foto, :tentativasLogin)")->fetchAll();
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':saldo', $saldo);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':tentativasLogin', 0);
        
        $stmt->execute();
    }
}
