<?php

require_once('../Helper/RemoveEmoji.php');
require_once('../Dao/Candidato.php');
session_start();

class SalvarMysqlController{
    private $nomeCandidato;
    
    public function __construct($nomeCandidato){
        $this->nomeCandidato = $nomeCandidato;
    }
    
    private function mostra($dados, $arquivo){
        $salvou = array();
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
            $retorno = $candidato->inserePost($info,$this->nomeCandidato);
            array_push($salvou, $retorno);               
            $info = array();
        }

        if (!array_search(false, $salvou)) {
            $_SESSION['success'] = 'Arquivo salvo com sucesso na tabela - '. $this->nomeCandidato.' arquvio - '. $arquivo;
            header("Location: ../View/SalvaMysql.php");
            die();   
        }else{
            $_SESSION['danger'] = 'Erro ao salvar arquivo na tabela - '. $this->nomeCandidato.' arquvio - '. $arquivo;
            header("Location: ../View/SalvaMysql.php");
            die();   
        }
        
    }
    
    public function ler($arquivo){
        set_time_limit(0);
        $caminho = "../../arquivos/1° Turno/".$arquivo;
        $teste = array();
        $fp = fopen($caminho, "r");
        $valor = null;
        while (!feof ($fp)) {            
            $valor = $valor.''. fgets($fp, 4096);       
        }    
        fclose($fp);
        $aux = explode('-------------------------', $valor);        
        $this->mostra($aux, $arquivo);
    }
}

?>