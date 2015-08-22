<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Funcionarios_DAO
 *
 * @author leonardosommariva
 */
class Funcionarios_DAO
{
    private $instancia;
    
    public function Funcionarios_DAO()
    {
        $this->instancia=Factory::getInstance();
    }
    
    public function inserir(Funcionario $Funcionario)
    {
        $prepare=$this->instancia->prepare("INSERT INTO funcionarios (usuario,senha,nome)"
                . "VALUES (:usuario,:senha,:nome)");
        $this->instancia->bindParam($prepare,":usuario",$Funcionario->getUsuario());
        $this->instancia->bindParam($prepare,":senha",$Funcionario->getSenha());
        $this->instancia->bindParam($prepare,":nome",$Funcionario->getNome());
        return $this->instancia->execute($prepare);
    }
    
    public function atualizar(Funcionario $Funcionario)
    {
        $prepare=$this->instancia->prepare("UPDATE funcionarios SET usuario=:usuario,senha=:senha,nome=:nome WHERE id=:id");
        $this->instancia->bindParam($prepare,":id",$Funcionario->getId());
        $this->instancia->bindParam($prepare,":usuario",$Funcionario->getUsuario());
        $this->instancia->bindParam($prepare,":senha",$Funcionario->getSenha());
        $this->instancia->bindParam($prepare,":nome",$Funcionario->getNome());
        return $this->instancia->execute($prepare);
    }
    
    public function excluir($id)
    {
        $prepare=$this->instancia->prepare("DELETE FROM funcionarios WHERE id=:id");
        $this->instancia->bindParam($prepare,":id",$id);
        return $this->instancia->execute($prepare);
    }
    
    public function consultar($id)
    {
        $prepare=$this->instancia->prepare("SELECT * FROM funcionarios WHERE id=:id");
        $this->instancia->bindParam($prepare,":id",$id);
        $retorno=$this->instancia->executeFA($prepare);
        $Funcionario=new Funcionario($retorno['id'], $retorno['usuario'], $retorno['senha'], $retorno['nome']);
        return $Funcionario;
    }
    
    public function consultaLogin($usuario,$senha)
    {
        $prepare=$this->instancia->prepare("SELECT * FROM funcionarios WHERE usuario=:usuario AND senha=:senha");
        $this->instancia->bindParam($prepare,":usuario",$usuario);
        $this->instancia->bindParam($prepare,":senha",$senha);
        $retorno=$this->instancia->executeFA($prepare);
        
        if($retorno)
        {
            $Funcionario=new Funcionario($retorno['id'], $retorno['usuario'], $retorno['senha'], $retorno['nome']);
            return $Funcionario;
        }
        else
        {
            return false;
        }
    }
    
    public function listar()
    {
        $prepare=$this->instancia->prepare("SELECT * FROM funcionarios");
        $listaArray=$this->instancia->executeFALL($prepare);
        if($listaArray)
        {
            foreach ($listaArray as $retorno)
            {
                $lista[]=new Funcionario($retorno['id'], $retorno['usuario'], $retorno['senha'], $retorno['nome']);
            }
            return $lista;
        }
        else
        {
            return false;
        }
    }
}
