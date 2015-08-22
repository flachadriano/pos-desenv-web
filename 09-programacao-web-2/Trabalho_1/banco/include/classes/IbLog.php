<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IbLog
 *
 * @author leonardosommariva
 */
class IbLog
{
    private $id;
    private $id_cliente;
    private $data;
    
    public function __construct($id, $id_cliente, $data)
    {
        $this->id = $id;
        $this->id_cliente = $id_cliente;
        $this->data = $data;
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



}
