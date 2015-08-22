<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessaoFuncionario
 *
 * @author leonardosommariva
 */
class SessaoFuncionario
{
    public function verificaSessao()
    {
        session_start();
        if(isset($_SESSION['banco_funcionario']))
        {
            return $_SESSION['banco_funcionario'];
        }
        else
        {
            return false;
        }
    }
}
