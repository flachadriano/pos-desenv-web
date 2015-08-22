<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Factory
 *
 * @author leonardosommariva
 */
class Factory
{
    private $Conexao;
    private static $instance;
    private $servidor="127.0.0.1";
    private $usuario="root";
    private $senha="root";
    private $banco="banco";
    
    private function Factory()
    {
        try
        {
            $this->Conexao = new PDO("mysql:host=$this->servidor;port=3306;dbname=$this->banco", "$this->usuario", "$this->senha");
        } 
        catch(PDOException $i)
        {
            echo $i->getMessage();
        }
    }
    
    public function carregaListagem($sql)
    {
        $resultado = $this->Conexao->query($sql)->fetchAll();
        if(count($resultado))
        {
            return $resultado;
        }
        else
        {
            return false;
        }
    }
    
    public function carregaLinha($executa)
    {
        $resultado = $this->Conexao->query($executa);
        return $resultado;
    }

    public function numLinhas($sql)
    {
        $consulta = $this->Conexao->query($sql)->fetchAll();
        return count($consulta);
    }
    
    public function iniciarTransacao()
    {
        return $this->Conexao->beginTransaction();
    }
    
    public function commit()
    {
        return $this->Conexao->commit();
    }
    
    public function rollBack()
    {
        return $this->Conexao->rollBack();
    }

    public function ultimoId()
    {
        return $this->Conexao->lastInsertId();
    }

    public function erros()
    {
        return $this->Conexao->errorInfo();
    }
    
    public static function getInstance()
    {
        if (self::$instance === null) 
        {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    public function prepare($sql)
    {
        return $this->Conexao->prepare($sql);
    }
    
    public function bindParam($objPrepare,$flag,$valor)
    {
        return $objPrepare->bindParam($flag, $valor, PDO::PARAM_STR);
    }
    
    public function execute($objPrepare)
    {
        return $objPrepare->execute();
    }
    
    public function executeFA($objPrepare)
    {
        $objPrepare->execute();
        return $objPrepare->fetch();
    }
    
    public function executeFALL($objPrepare)
    {
        $objPrepare->execute();
        return $objPrepare->fetchAll();
    }

    public function __destruct()
    {
        $this->Conexao = null;
    }
}
