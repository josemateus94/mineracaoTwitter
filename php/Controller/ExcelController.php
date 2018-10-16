<?php

require_once('../Dao/Candidato.php');

session_start();

class ExcelController{
    // ler todos os post que tem no nome dos candidatos e salvar o id em um array, conforme o tamanho do txt.
    // ler o txt com os sentimentos e salvar em um array.
    // percorrer o array com os sentimentos e salvar no banco.
    public static function salvar($nomeCandidato, $inicioDaBusca, $fimDaBusca, $arquivo){        
        $candidato = new Candidato;
        $idCnadidados = $candidato->buscar($nomeCandidato, $inicioDaBusca, $fimDaBusca);          
        $sentimentosPost = self::lerTxtIfeel($arquivo);        
        foreach ($idCnadidados as $value) {            
            echo($value['id']);
            //$aux = $candidato->inserirSentimentos($nomeCandidato, $nomeCandidato, $fimDaBusca);// ESTA FUNCIONANDO OK OK
        }
        die();
        
    }

    private static function lerTxtIfeel($arquivo){// informa o nome do arquivo         
        set_time_limit(0);
        $caminho = "../../arquivos/1° Turno/Sentimento/". $arquivo;
        $teste = array();
        $fp = fopen($caminho, "r");
        $valor = null;
        $sentimentosPost = array();
        while (!feof ($fp)) {            
            $valor = $valor.''. fgets($fp, 4096);  
            array_push($sentimentosPost, $valor);
            $valor = '';
        }    
        fclose($fp);                
        return $sentimentosPost;
    }
}

?>