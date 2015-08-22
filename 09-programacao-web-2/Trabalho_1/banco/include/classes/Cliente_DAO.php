<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente_DAO
 *
 * @author leonardosommariva
 */
class Cliente_DAO
{
    private $instancia;
    
    public function Cliente_DAO()
    {
        $this->instancia=Factory::getInstance();
    }
    
    public function inserir(Cliente $Cliente)
    {
        $prepare=$this->instancia->prepare("INSERT INTO clientes (agencia,conta,senha,senha_letra,saldo,nome,tentativas,saldo_especial,foto) VALUES (:agencia,:conta,:senha,:senha_letra,:saldo,:nome,:tentativas,:saldo_especial,:foto)");
        $this->instancia->bindParam($prepare,":agencia",$Cliente->getAgencia());
        $this->instancia->bindParam($prepare,":conta",$Cliente->getConta());
        $this->instancia->bindParam($prepare,":senha",$Cliente->getSenha());
        $this->instancia->bindParam($prepare,":senha_letra",$Cliente->getSenha_letras());
        $this->instancia->bindParam($prepare,":saldo",$Cliente->getSaldo());
        $this->instancia->bindParam($prepare,":nome",$Cliente->getNome());
        $this->instancia->bindParam($prepare,":tentativas",$Cliente->getTentativas());
        $this->instancia->bindParam($prepare,":saldo_especial",$Cliente->getSaldo_especial());
        $this->instancia->bindParam($prepare,":foto",$Cliente->getFoto());
        return $this->instancia->execute($prepare);
    }
    
    public function atualizar(Cliente $Cliente)
    {
        $prepare=$this->instancia->prepare("UPDATE clientes SET agencia=:agencia,conta=:conta,senha=:senha,senha_letra=:senha_letra,saldo=:saldo,nome=:nome,tentativas=:tentativas,saldo_especial=:saldo_especial,foto=:foto WHERE id=:id");
        $this->instancia->bindParam($prepare,":id",$Cliente->getId());
        $this->instancia->bindParam($prepare,":agencia",$Cliente->getAgencia());
        $this->instancia->bindParam($prepare,":conta",$Cliente->getConta());
        $this->instancia->bindParam($prepare,":senha",$Cliente->getSenha());
        $this->instancia->bindParam($prepare,":senha_letra",$Cliente->getSenha_letras());
        $this->instancia->bindParam($prepare,":saldo",$Cliente->getSaldo());
        $this->instancia->bindParam($prepare,":nome",$Cliente->getNome());
        $this->instancia->bindParam($prepare,":tentativas",$Cliente->getTentativas());
        $this->instancia->bindParam($prepare,":saldo_especial",$Cliente->getSaldo_especial());
        $this->instancia->bindParam($prepare,":foto",$Cliente->getFoto());
        return $this->instancia->execute($prepare);
        
    }
    
    public function excluir($id)
    {
        $prepare=$this->instancia->prepare("DELETE FROM clientes WHERE id=:id");
        $this->instancia->bindParam($prepare,":id",$id);
        return $this->instancia->execute($prepare);
    }
    
   public function consultar($id)
    {
        $prepare=$this->instancia->prepare("SELECT * FROM clientes WHERE id=:id");
        $this->instancia->bindParam($prepare,":id",$id);
        $retorno=$this->instancia->executeFA($prepare);
        $Cliente=new Cliente($retorno['id'],$retorno['agencia'], $retorno['conta'], $retorno['senha'], $retorno['senha_letras'], $retorno['saldo'], $retorno['nome'], $retorno['tentativas'], $retorno['saldo_especial'], $retorno['foto']);
        return $Cliente;
    }
    
    public function listar()
    {
        $prepare=$this->instancia->prepare("SELECT * FROM clientes");
        $listaArray=$this->instancia->executeFALL($prepare);
        if($listaArray)
        {
            foreach ($listaArray as $retorno)
            {
                $lista[]=new Cliente($retorno['id'],$retorno['agencia'], $retorno['conta'], $retorno['senha'], $retorno['senha_letras'], $retorno['saldo'], $retorno['nome'], $retorno['tentativas'], $retorno['saldo_especial'], $retorno['foto']);
            }
            return $lista;
        }
        else
        {
            return false;
        }
    }
    
    public function consultaLogin($agencia,$conta)
    {
        $prepare=$this->instancia->prepare("SELECT * FROM clientes WHERE agencia=:agencia AND conta=:conta");
        $this->instancia->bindParam($prepare,":agencia",$agencia);
        $this->instancia->bindParam($prepare,":conta",$conta);
        $retorno=$this->instancia->executeFA($prepare);
        if($retorno)
        {
            return new Cliente($retorno['id'],$retorno['agencia'], $retorno['conta'], $retorno['senha'], $retorno['senha_letra'], $retorno['saldo'], $retorno['nome'], $retorno['tentativas'], $retorno['saldo_especial'], $retorno['foto']);
        }
        else
        {
            return false;
        }
    }
    
    public function ultimoID()
    {
        return $this->instancia->ultimoId();
    }
}
