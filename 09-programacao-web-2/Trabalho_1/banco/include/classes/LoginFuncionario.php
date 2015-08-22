<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginFuncionario
 *
 * @author leonardosommariva
 */
class LoginFuncionario
{
    private $Funcionario;
    private $Funcionario_DAO;
    private $usuario;
    private $senha;
    
    public function LoginFuncionario($usuario, $senha)
    {
        $this->usuario=$usuario;
        $this->senha=$senha;
        $this->Funcionario_DAO=new Funcionarios_DAO;
    }
    
    public function login()
    {
        $Funcionario=$this->Funcionario_DAO->consultaLogin($this->usuario, $this->senha);
        if($Funcionario)
        {
            $this->abreSessao($Funcionario->getId());
            return true;
        }
        else
        {
            return false;
        }
    }
    
    private function abreSessao($idFuncionario)
    {
        session_start();
        $_SESSION['banco_funcionario']=$idFuncionario;
    }
}
