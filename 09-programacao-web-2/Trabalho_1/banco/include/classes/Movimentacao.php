<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Movimentacao
 *
 * @author leonardosommariva
 */
class Movimentacao
{
    private $Cliente;
    private $Extrato_DAO;
    private $Cliente_DAO;
    private $saldoTotal;
    private $erro;
    
    public Function Movimentacao(Cliente $Cliente)
    {
        $this->Cliente=$Cliente;
        $this->Extrato_DAO=new Extrato_DAO;
        $this->Cliente_DAO=new Cliente_DAO;
    }
    
    public function getSaldo()
    {
        return $this->Cliente->getSaldo();
    }
    
    public function getSaldoEspecial()
    {
        return $this->Cliente->getSaldo_especial();
    }
    
    public function getSaldoTotal()
    {
        $this->saldoTotal=$this->Cliente->getSaldo()+$this->Cliente->getSaldo_especial();
        return $this->saldoTotal;
    }
    
    public function getExtrato()
    {
        
    }
    
    private function geraMovimentacao($valor, $tipo, $operacao, $descricao)
    {
        $Extrato=new Extrato(null, $this->Cliente->getId(), date('Y-m-d H:i:s'), $descricao, $valor, $tipo, $operacao);
        $this->alteraSaldo($valor, $operacao);
        return $this->Extrato_DAO->inserir($Extrato);
    }
    
    private function alteraSaldo($valor,$operacao)
    {
        if($operacao=="C")
        {
            $novoValor=$this->Cliente->getSaldo()+$valor;
        }
        else if($operacao=="D")
        {
            $novoValor=$this->Cliente->getSaldo()-$valor;
        }
        else
        {
            return false;
        }
        
        $this->Cliente->setSaldo($novoValor);
        return $this->Cliente_DAO->atualizar($this->Cliente);
    }
    
    public function pagamento($valor,$vencimento,$codigoBoleto)
    {
        if($valor<=$this->getSaldoTotal())
        {
            $geraMovimentacao=$this->geraMovimentacao($valor, "pagamento", "D", "Pagamento de boleto bancário");
            if($geraMovimentacao==true)
            {
                return true;
            }
            else
            {
                $this->erro='Ocorreu algum erro ao registrar a operação';
                return false;
            }
        }
        else
        {
            $this->erro='Saldo insuficiente';
            return false;
        }
    }
    
    public function getErro()
    {
        return $this->erro;
    }
}
