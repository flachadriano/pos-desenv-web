<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ib_log_DAO
 *
 * @author leonardosommariva
 */
class Ib_log_DAO
{
    private $instancia;
    
    public function Ib_log_DAO()
    {
        $this->instancia=Factory::getInstance();
    }
    
    public function inserir(IbLog $IbLog)
    {
        $prepare=$this->instancia->prepare("INSERT INTO ib_log (id_cliente,data)"
                . "VALUES (:id_cliente,:data)");
        $this->instancia->bindParam($prepare,":id_cliente",$IbLog->getId_cliente());
        $this->instancia->bindParam($prepare,":data",$IbLog->getData());
        return $this->instancia->execute($prepare);
    }
    
    public function listar()
    {
        $prepare=$this->instancia->prepare("SELECT * FROM ib_log");
        $listaArray=$this->instancia->executeFALL($prepare);
        if($listaArray)
        {
            foreach ($listaArray as $retorno)
            {
                $lista[]=new IbLog($retorno['id'],$retorno['id_cliente'],$retorno['data']);
            }
            return $lista;
        }
        else
        {
            return false;
        }
    }
}
