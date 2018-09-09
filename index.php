<?php

require_once('RemoveEmoji.php');

class Fatoracao{
    function mostra($dados){
        $infos = array();
        foreach ($dados as $dado) {
            $aux = explode('|||', $dado);
            if (isset($aux[6])) {
                $aux[6] = RemoveEmoji::remove($aux[6]);
            }
            if (isset($aux[3])) {
                $aux[3] = RemoveEmoji::remove($aux[3]);
            }
            
            $info = array(
                'cont'          => isset($aux[0]) ? $aux[0] : '', 
                'id'            => isset($aux[1]) ? $aux[1] : '', 
                'nome'          => isset($aux[2]) ? $aux[2] : '',            
                'localizacao'   => isset($aux[3]) ? $aux[3] : '',
                'aparelho'      => isset($aux[4]) ? $aux[4] : '',
                'data'          => isset($aux[5]) ? $aux[5] : '',
                'post'         => isset($aux[6]) ? $aux[6] : '',
            );            
            array_push($infos, $info);
        }
        $this->salvar($infos);
    }
    
    function salvar($infos){
        
        echo"<pre>";
            var_dump($infos);
        echo"</pre>";
    }
    
    function ler(){
        $arquivo = "arquivo.txt";
        $teste = array();
        $fp = fopen($arquivo, "r");
        $valor = null;
        while (!feof ($fp)) {
            $valor = $valor.''. fgets($fp, 4096);       
            //array_push($teste,  $valor);
        }    
        fclose($fp);
        //echo($valor);
        $aux = explode('-------------------------', $valor);
        $this->mostra($aux);
    }
}
$ft = new Fatoracao();

$ft->ler();

?>

