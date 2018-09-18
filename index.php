<?php

require_once('RemoveEmoji.php');
require_once('Candidato.php');

class Fatoracao{
    private $nomeCandidato;

    public function __construct($nomeCancidato){
        $this->nomeCancidato = $nomeCancidato;
    }

    function mostra($dados){
        $infos = array();
        $candidato = new Candidato();
        //$fp = fopen($this->nomeCandidato.".txt", "w");
        
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
            $candidato->inserePost($info,$this->nomeCandidato);            
            $info = array();
        }
        $this->mostraFormatado($infos);
        fclose($fp);
    }
    public function salvarTxt($post, $nomeTxt){  
        $fp = fopen("ifeel/$nomeTxt", "w"); 
        foreach ($post as $value) {
            $escreve = fwrite($fp, ($value['post']."\n"));
        }
        fclose($fp);  
        echo'ok';      
    }
    
    function mostraFormatado($infos){        
        echo"<pre>";
            var_dump($infos);
        echo"</pre>";
    }
    
    function ler(){
        set_time_limit(0);
        $arquivo = "arquivos/pimentel 09 Sep 18 21:32:31.txt";
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
$nomeCandidato = 'pimentel';
$ft = new Fatoracao($nomeCandidato);
$candidato = new Candidato();
$date = date('d-m-Y_H:i:s');
$nomeTxt = ($nomeCandidato.'_'.$date);
//$ft->ler(); // ler o txt do python e salva no mysql 
$ft->salvarTxt($candidato->buscar($nomeCandidato), $nomeTxt); //prepara o arquivo para ifeel

?>

