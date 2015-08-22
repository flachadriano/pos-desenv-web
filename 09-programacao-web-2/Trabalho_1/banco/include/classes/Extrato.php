<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Extrato
 *
 * @author leonardosommariva
 */
class Extrato
{

    private $id;
    private $id_cliente;
    private $data;
    private $descricao;
    private $valor;
    private $tipo;
    private $operacao;

    public function __construct($id, $id_cliente, $data, $descricao, $valor, $tipo, $operacao)
    {
        $this->id = $id;
        $this->id_cliente = $id_cliente;
        $this->data = $data;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->tipo = $tipo;
        $this->operacao = $operacao;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getOperacao()
    {
        return $this->operacao;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function setOperacao($operacao)
    {
        $this->operacao = $operacao;
    }

}
