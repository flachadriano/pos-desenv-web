<?php
class BD {
    private $Conexao;
    
    public function BD(){
        $this->Conexao=new PDO("mysql:host=localhost;port=3306;dbname=ib", "root");        
    }
    
    public function getConnection(){
        return $this->Conexao;
    }
}