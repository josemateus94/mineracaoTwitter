<?php

require_once('../Helper/RemoveEmoji.php');
require_once('../Model/Candidato.php');
session_start();

class twitterPorUsuarioController {
        
    public static function comparar($nomeCandidato){
        $candidato = new Candidato();
        $idEleitores = $candidato->buscarUsuarioOrdenados($nomeCandidato);        
        $eleitores = $idEleitores;
        //$post = str_replace("'", '"', $eleitores[0]['post']); 
        $tw_id = $eleitores[0]['tw_id']; 
        $dia = $eleitores[0]['dia']; 
        $hora = $eleitores[0]['hora'];        
        $arrayEleitores = array();
        foreach ($eleitores as $key=>$eleitore) {               
            if ($tw_id == $eleitore['tw_id'] &&  $dia != $eleitore['dia'] && $hora != $eleitore['hora']) {
                $info= array('idOrigim' => $eleitore['id'], 'origem'=> $nomeCandidato, 'tw_id' => $eleitore['tw_id'], 'dia' => $eleitore['dia'], 'hora' => $eleitore['hora'], 'teste'=>'teste001');
                array_push($arrayEleitores, $info);                
                $tw_id = $eleitore['tw_id'];
                $dia = $eleitore['dia'];
                $hora = $eleitore['hora'];
            }elseif ($tw_id != $eleitore['tw_id']) {
                $info= array('idOrigim' => $eleitore['id'], 'origem'=> $nomeCandidato, 'tw_id' => $eleitore['tw_id'], 'dia' => $eleitore['dia'], 'hora' => $eleitore['hora'], 'teste'=>'teste002');
                array_push($arrayEleitores, $info);                
                $tw_id = $eleitore['tw_id'];
                $dia = $eleitore['dia'];
                $hora = $eleitore['hora'];
            }
        }      
        foreach ($arrayEleitores as $key => $arrayEleitore) {
            echo($candidato->salvarTwitterPorUsuario($arrayEleitore));
            echo'<br>';
        }
    }
}
?>