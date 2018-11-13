<?php

require_once('../Model/Candidato.php');

session_start();

class ExcelController{
    // ler todos os post que tem no nome dos candidatos e salvar o id em um array, conforme o tamanho do txt - OK
    // ler o txt com os sentimentos e salvar em um array. - OK    
    // percorrer o array com os sentimentos e salvar no banco. - OK
    public static function salvar($nomeCandidato, $inicioDaBusca, $fimDaBusca, $arquivo){  
              
        $candidato = new Candidato;
        $idCnadidados = $candidato->buscar($nomeCandidato, $inicioDaBusca, $fimDaBusca);                         
        $sentimentosPost = self::lerTxtIfeel($nomeCandidato, $arquivo); 
        if (count($idCnadidados) != count($sentimentosPost)) {
            $_SESSION['danger'] = "Quantidade de arquivo diferente de quantidade de sentimento.<br/>
                                Banco = ".count($idCnadidados)." Sentimentos = ". count($sentimentosPost).
                                " Candidato = ". $nomeCandidato;
            header("Location: ../View/Exel.php");
            die(); 
        }
        foreach ($idCnadidados as $key=>$value) {            
            $candidato->inserirSentimentos($value["id"], $nomeCandidato, $sentimentosPost[$key]);
        }
        $_SESSION['success'] = "Quantidade de id igual a quantidade de sentimentos".
                            " Candidato - ". $nomeCandidato;
        header("Location: ../View/Exel.php");
        die(); 
    }

    private static function lerTxtIfeel($nomeCandidato, $arquivo){       
        set_time_limit(0);
        $caminho = "../../ifeel/sentimentos_analisados/".$nomeCandidato."/". $arquivo;
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