<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginCliente
 *
 * @author leonardosommariva
 */
class LoginCliente
{
    private $Cliente;
    private $agencia;
    private $conta;
    private $senha;
    private $senha_letra;
    private $Cliente_DAO;
    private $motivo;
    
    public function LoginCliente($agencia, $conta, $senha, $senha_letra)
    {
        $this->Cliente_DAO=new Cliente_DAO;
        $this->agencia=$agencia;
        $this->conta=$conta;
        $this->senha=$senha;
        $this->senha_letra=$senha_letra;
    }
    
    public function login()
    {
        $retorno=$this->Cliente_DAO->consultaLogin($this->agencia,$this->conta);
        
        if($retorno)
        {
            $this->Cliente=$retorno;
            
            if($this->Cliente->getSenha()==$this->senha)
            {
                if($this->Cliente->getSenha_letras()==$this->senha_letra)
                {
                    $tentativas=$this->Cliente->getTentativas();
                    if($tentativas>=3)
                    {
                        $this->motivo='TENTATIVAS';
                        $this->incremetarTentativas();
                        return false;
                    }
                    else
                    {
                        $this->abrirSessao($this->Cliente->getId());
                        $this->zerarTentativas();
                        $Ib_log_DAO=new Ib_log_DAO;
                        $Ib_log_DAO->inserir(new IbLog(null,$this->Cliente->getId(),date("Y/m/d")));
                        return true;
                    }
                }
                else
                {
                    $this->motivo='SENHA_LETRA';
                    $this->incremetarTentativas();
                    return false;
                }
            }
            else
            {
                $this->motivo='SENHA_NUMERICA';
                $this->incremetarTentativas();
                return false;
            }
        }
        else
        {
            $this->motivo='DADOS';
            return false;
        }
    }
    
    private function abrirSessao($idCliente)
    {
        session_start();
        $_SESSION['banco']=$idCliente;
    }
    
    public function getMotivo()
    {
        return $this->motivo;
    }
    
    private function incremetarTentativas()
    {
        $tentativas=$this->Cliente->getTentativas()+1;
        $this->Cliente->setTentativas($tentativas);
        $this->Cliente_DAO->atualizar($this->Cliente);
    }
    
    private function zerarTentativas()
    {
        $this->Cliente->setTentativas(0);
        $this->Cliente_DAO->atualizar($this->Cliente);
    }
}
