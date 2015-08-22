<?php
class Cliente
{
    private $id;
    private $nome;
    private $saldo;
    private $foto;
    private $tentativasLogin;
    
//    public function Cliente()
//    {
//        $this->nome="João";
//    }
    
    public function Cliente($id, $nome, $saldo, $foto, $tentativasLogin)
    {
        $this->id=$id;
        $this->nome=$nome;
        $this->saldo=$saldo;
        $this->foto=$foto;
        $this->tentativasLogin=$tentativasLogin;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function getSaldo()
    {
        return $this->saldo;
    }
    
    public function getFoto()
    {
        return $this->foto;
    }
    
    public function getTentativasLogin()
    {
        return $this->tentativasLogin;
    }    
}
