<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente
 *
 * @author leonardosommariva
 */
class Cliente
{
    private $id;
    private $agencia;
    private $conta;
    private $senha;
    private $senha_letras;
    private $saldo;
    private $nome;
    private $tentativas;
    private $saldo_especial;
    private $foto;
    
    public function __construct($id, $agencia, $conta, $senha, $senha_letras, $saldo, $nome, $tentativas, $saldo_especial, $foto)
    {
        $this->id = $id;
        $this->agencia = $agencia;
        $this->conta = $conta;
        $this->senha = $senha;
        $this->senha_letras = $senha_letras;
        $this->saldo = $saldo;
        $this->nome = $nome;
        $this->tentativas = $tentativas;
        $this->saldo_especial = $saldo_especial;
        $this->foto = $foto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAgencia()
    {
        return $this->agencia;
    }

    public function getConta()
    {
        return $this->conta;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getSenha_letras()
    {
        return $this->senha_letras;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getTentativas()
    {
        return $this->tentativas;
    }

    public function getSaldo_especial()
    {
        return $this->saldo_especial;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;
    }

    public function setConta($conta)
    {
        $this->conta = $conta;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setSenha_letras($senha_letras)
    {
        $this->senha_letras = $senha_letras;
    }

    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setTentativas($tentativas)
    {
        $this->tentativas = $tentativas;
    }

    public function setSaldo_especial($saldo_especial)
    {
        $this->saldo_especial = $saldo_especial;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

}
