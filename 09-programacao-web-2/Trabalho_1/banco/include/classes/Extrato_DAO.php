<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Extrato_DAO
 *
 * @author leonardosommariva
 */
class Extrato_DAO
{
    private $instancia;
    
    public function Extrato_DAO()
    {
        $this->instancia=Factory::getInstance();
    }
    
    public function inserir(Extrato $Extrato)
    {
        $prepare=$this->instancia->prepare("INSERT INTO extrato (id_cliente,data,descricao,valor,tipo,operacao)"
                . "VALUES (:id_cliente,:data,:descricao,:valor,:tipo,:operacao)");
        $this->instancia->bindParam($prepare,":id_cliente",$Extrato->getId_cliente());
        $this->instancia->bindParam($prepare,":data",$Extrato->getData());
        $this->instancia->bindParam($prepare,":descricao",$Extrato->getDescricao());
        $this->instancia->bindParam($prepare,":valor",$Extrato->getValor());
        $this->instancia->bindParam($prepare,":tipo",$Extrato->getTipo());
        $this->instancia->bindParam($prepare,":operacao",$Extrato->getOperacao());
        return $this->instancia->execute($prepare);
    }
    
    public function listar()
    {
        $prepare=$this->instancia->prepare("SELECT * FROM extrato");
        $listaArray=$this->instancia->executeFALL($prepare);
        if($listaArray)
        {
            foreach ($listaArray as $retorno)
            {
                $lista[]=new Extrato($retorno['id'],$retorno['id_cliente'],$retorno['data'],$retorno['descricao'],$retorno['valor'],$retorno['tipo'],$retorno['operacao']);
            }
            return $lista;
        }
        else
        {
            return false;
        }
    }
}

?>