<?php

require_once('RemoveEmoji.php');
require_once('MineracaoComPhp.php');
require_once('Candidato.php');

class Fatoracao{
    private $nomeCandidato = 'anastasia';

    function mostra($dados){
        $infos = array();
        $candidato = new Candidato();
        $fp = fopen($nomeCandidato.".txt", "w");
        foreach ($dados as $dado) {
            $aux = explode('|||', $dado);
            if (isset($aux[6])) {
                $aux[6] = RemoveEmoji::remove($aux[6]);
                $aux[6] = preg_replace('~[\r\n]+~', ' ', $aux[6]);
            }
            if (isset($aux[3])) {
                $aux[3] = RemoveEmoji::remove($aux[3]);
            }
            
            $info = array(
                'cont'         => isset($aux[0]) ? $aux[0] : '', 
                'tw_id'        => isset($aux[1]) ? $aux[1] : '', 
                'nome'         => isset($aux[2]) ? $aux[2] : '',            
                'localizacao'  => isset($aux[3]) ? $aux[3] : '',
                'aparelho'     => isset($aux[4]) ? $aux[4] : '',
                'tw_data'      => isset($aux[5]) ? $aux[5] : '',
                'post'         => isset($aux[6]) ? $aux[6] : '',
            );            
            array_push($infos, $info);
            $candidato->inserePost($info,$nomeCandidato);
            $this->salvarTxt($info['post'], $fp);
            $info = array();
        }
        $this->salvar($infos);
        fclose($fp);
    }
    private function salvarTxt($post, $fp){        
        $escreve = fwrite($fp, ( $post."\n"));
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

