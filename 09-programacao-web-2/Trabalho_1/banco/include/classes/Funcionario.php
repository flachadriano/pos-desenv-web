<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Funcionario
 *
 * @author leonardosommariva
 */
class Funcionario
{
    private $id;
    private $usuario;
    private $senha;
    private $nome;
    
    public function __construct($id, $usuario, $senha, $nome)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->nome = $nome;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

}
