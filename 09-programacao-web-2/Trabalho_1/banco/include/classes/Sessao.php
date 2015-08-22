<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sessao
 *
 * @author leonardosommariva
 */
class Sessao
{   
    public function verificaSessao()
    {
        session_start();
        if(isset($_SESSION['banco']))
        {
            return $_SESSION['banco'];
        }
        else
        {
            return false;
        }
    }
}
