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

    public function criaTxt($nomeCandidato){
        $date = date('d-m-Y_H:i:s');
        $nomeTxt = ($nomeCandidato.'_'.$date);
        $fp = fopen("../ifeel/$nomeTxt", "w");
        return $fp;
    }

    public function salvarTxt($post, $nomeCandidato){
        $cont = 1;          
        $fp = $this->criaTxt($nomeCandidato);                 
        foreach ($post as $value) {            
            if ($cont <=900) {
                fwrite($fp, ($value['post']."\n"));   
            }else{
                sleep(1);
                $cont = 0;
                fclose($fp); 
                $fp = $this->criaTxt($nomeCandidato); 
                echo'ok'.'<br>';        
            } 
            $cont++;           
        }
        fclose($fp);  
        echo'fim';      
    }
    
    function mostraFormatado($infos){        
        echo"<pre>";
        var_dump($infos);
        echo"</pre>";
    }
    
    function ler(){
        set_time_limit(0);
        $arquivo = "../arquivos/pimentel 09 Sep 18 21:32:31.txt";
        $teste = array();
        $fp = fopen($arquivo, "r");
        $valor = null;
        while (!feof ($fp)) {            
            $valor = $valor.''. fgets($fp, 4096);       
        }    
        fclose($fp);
        $aux = explode('-------------------------', $valor);
        $this->mostra($aux);
    }
}
$nomeCandidato = 'pimentel';
$ft = new Fatoracao($nomeCandidato);
$candidato = new Candidato();

//$ft->ler(); // ler o txt do python e salva no mysql 
$ft->salvarTxt($candidato->buscar($nomeCandidato), $nomeCandidato); //prepara o arquivo para ifeel

?>

