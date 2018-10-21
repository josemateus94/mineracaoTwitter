<?php
require_once('../Model/Candidato.php');
session_start();
class IfeelController{

    private function criaTxt($nomeCandidato){
        $date = date('d-m-Y_H:i:s');
        $nomeTxt = ($nomeCandidato.'_'.$date.'.txt');
        $fp = fopen("../../ifeel/$nomeTxt", "w");
        return $fp;
    }

    public function salvarTxt($nomeCandidato, $inicioDaBusca){
        $totalArqruivos = 1;
        $candidato = new Candidato();
        $post = $candidato->buscar($nomeCandidato, $inicioDaBusca);
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
                $totalArqruivos++;      
            } 
            $cont++;           
        }
        fclose($fp);  
        $_SESSION['success'] = 'Foram gerados '.$totalArqruivos.' arquivo do candidato - '.$nomeCandidato;
        header("Location: ../View/Ifeel.php");
        die(); 
    }   
}
?>