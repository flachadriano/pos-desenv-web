<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FotoCliente
 *
 * @author leonardosommariva
 */
class FotoCliente
{
    private $Cliente;
    
    public function FotoCliente(Cliente $Cliente)
    {
        $this->Cliente=$Cliente;
    }
    
    public function upload()
    {
        $arquivo=$_FILES['foto']['tmp_name'];
        $upload=move_uploaded_file($arquivo, '../img/fotos/'.$this->Cliente->getId().'.jpg');
        if($upload)
        {
            $imagemOriginal = ImageCreateFromJPEG('../img/fotos/'.$this->Cliente->getId().'.jpg');
            $imagemReduzida=ImageCreateTrueColor(120, 100);
            ImageCopyResampled($imagemReduzida, $imagemOriginal, 0, 0, 0, 0, 120, 100, ImagesX($imagemOriginal),ImagesY($imagemOriginal));
            imagejpeg($imagemReduzida, '../img/fotos/tb_'.$this->Cliente->getId().'.jpg');
            imagedestroy($imagemReduzida);
            imagedestroy($imagemOriginal);
            unlink("../img/fotos/".$this->Cliente->getId().".jpg");
        }
        else
        {
            return false;
        }
    }
}
