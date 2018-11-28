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
                $eleitore['hora'] = date('H:i',strtotime('-3 Hour', strtotime($eleitore['hora']))); // Todas as horas estão com 3 horas a mais, função para retirar as horas a mais
                $info = array('idOrigim' => $eleitore['id'], 'origem'=> $nomeCandidato, 'tw_id' => $eleitore['tw_id'], 'dia' => $eleitore['dia'], 'hora' => $eleitore['hora'], 'teste'=>'teste001');
                array_push($arrayEleitores, $info);                
                $tw_id = $eleitore['tw_id'];
                $dia = $eleitore['dia'];
                $hora = $eleitore['hora'];
            }elseif ($tw_id != $eleitore['tw_id']) {
                $eleitore['hora'] = date('H:i',strtotime('-3 Hour', strtotime($eleitore['hora']))); // Todas as horas estão com 3 horas a mais, função para retirar as horas a mais
                $info = array('idOrigim' => $eleitore['id'], 'origem'=> $nomeCandidato, 'tw_id' => $eleitore['tw_id'], 'dia' => $eleitore['dia'], 'hora' => $eleitore['hora'], 'teste'=>'teste002');
                array_push($arrayEleitores, $info);                
                $tw_id = $eleitore['tw_id'];
                $dia = $eleitore['dia'];
                $hora = $eleitore['hora'];
            }
        }        
        foreach ($arrayEleitores as $key => $arrayEleitore) {
            $candidato->salvarTwitterPorUsuario($arrayEleitore);                 
        }
        $_SESSION['success'] = "Twitter por candidato - " .$nomeCandidato. " submetido.";
        header("Location: ../View/TwitterPorUsuario.php");
        die(); 
    }

    public static function mediaTwitterPorUsuario(){
        $candidato = new Candidato();
        $twitterPorUsuario = $candidato->twitterPorUsuario();
        $somaTwitterPorEleitores = 0;
        foreach ($twitterPorUsuario as $key => $value) {
            $somaTwitterPorEleitores += $value['total'];
        }
        $somaTwitterPorEleitores = number_format(($somaTwitterPorEleitores/count($twitterPorUsuario)), 2, '.', '');
        $_SESSION['success'] = "Media de Twitter por usuario - ". $somaTwitterPorEleitores;
        header("Location: ../View/TwitterPorUsuario.php");
        die(); 
    }

    public static function TotalIdsDiferente(){
        $candidato = new Candidato();
        $twitterPorUsuario = $candidato->twitterPorUsuario();
        $_SESSION['success'] = "Total de ids - ". count($twitterPorUsuario);
        header("Location: ../View/TwitterPorUsuario.php");
        die();
    }

    public static function CorrigirHoras($nomeCandidato){
        $candidato = new Candidato();
        $eleitores = $candidato->buscarUsuarioOrdenados($nomeCandidato);  
        $salvou = array();
        foreach ($eleitores as $key => $eleitore) {            
            $eleitore['hora'] = date('H:i:s',strtotime('-3 Hour', strtotime($eleitore['hora']))); // Todas as horas estão com 3 horas a mais, função para retirar as horas a mais            
            $retorno = $candidato->corrgirHoras($nomeCandidato, $eleitore['id'], $eleitore['hora']);            
            array_push($salvou, $retorno);    
        }

        if (!in_array(false, $salvou)) {
            $_SESSION['success'] = "Horas corrigidas - ". $nomeCandidato;
            header("Location: ../View/TwitterPorUsuario.php");
            die();  
        }else{
            $_SESSION['danger'] = "Erro - ". $nomeCandidato;
            header("Location: ../View/TwitterPorUsuario.php");
            die();
        }
    }

    public static function MediaPorPeriodo($nomeCandidato){
        $candidato = new Candidato();
        $eleitores = $candidato->buscarUsuarioOrdenados($nomeCandidato);
        $diaInicio = '2018-08-31';
        $diaFinal = '2018-09-14'; 
        $cont = 0;               
        foreach ($eleitores as $key => $eleitore) { 
            //echo('dia - '.$eleitore['dia'].' tw_id - '.strtotime($eleitore['dia']). ' Inicio - '.strtotime($diaInicio). ' Final - '. strtotime($diaFinal). '<br>');
            $eleitore['dia'] = date('Y/m/d', strtotime($eleitore['dia']));                         
            if (strtotime($eleitore['dia']) >= strtotime($diaInicio) && strtotime($eleitore['dia']) <= strtotime($diaFinal)) {                
                $cont++;
            }             
        }                
        $_SESSION['success'] = $nomeCandidato . ' Periodo - '. $cont;
        header("Location: ../View/TwitterPorUsuario.php");
        die();
    }
}
?>