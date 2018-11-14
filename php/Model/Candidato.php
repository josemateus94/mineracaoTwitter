<?php

require_once('Conexao.php');

class Candidato{

    private $conexao;
    private $pdo;

    public function __construct(){
        $this->conexao = new Conexao();
        $this->pdo = $this->conexao->conectar();
    }

    public function inserirTwitter($candidato, $nomeCandidato){
        
        try {
            $pdt = $this->pdo->prepare("INSERT INTO $nomeCandidato (tw_id, nome, localizacao, aparelho , dia, hora, post)
                                        VALUES (:tw_id, :nome, :localizacao, :aparelho , :dia, :hora, :post)");
            $pdt->bindParam(":tw_id", $candidato['tw_id'], PDO::PARAM_STR);
            $pdt->bindParam(":nome",  $candidato['nome'], PDO::PARAM_STR);
            $pdt->bindParam(":localizacao",  $candidato['localizacao'], PDO::PARAM_STR);
            $pdt->bindParam(":aparelho",  $candidato['aparelho'], PDO::PARAM_STR);
            $pdt->bindParam(":dia", $candidato['dia'], PDO::PARAM_STR);
            $pdt->bindParam(":hora", $candidato['hora'], PDO::PARAM_STR);
            $pdt->bindParam(":post", $candidato['post'], PDO::PARAM_STR);

            if($pdt->execute()){
                return true;    
            } else{
                return false;
            }       

        } catch (PDOException $exc) {
            echo "" . ($exc->getMessage());
        }     
    }

    public function buscar($nomeCandidato, $inicioDaBusca=1, $fimDaBusca=null){

        if (is_null($fimDaBusca) || $fimDaBusca == '') {
            $fimDaBusca = '';
        }else{
            $fimDaBusca = 'and id <='.$fimDaBusca;
        }
        
        try{
            $pdt = $this->pdo->prepare("SELECT post, id FROM $nomeCandidato 
                                        WHERE id >= :inicioDaBusca and post like '%$nomeCandidato%' $fimDaBusca");
            $pdt->bindParam(':inicioDaBusca', $inicioDaBusca, PDO::PARAM_STR);
            $pdt->execute();                                        
            return $pdt->fetchAll();            
        }catch(PDOException $exc){
            echo "" . ($exc->getMessage());
        }
    }

    public function inserirSentimentos($idCandidato, $nomeCandidato, $sentimento){
        try{
            $pdt = $this->pdo->prepare("UPDATE $nomeCandidato SET sentimento = :sentimento
                                        WHERE id = :idCandidato");
            $pdt->bindParam(':idCandidato', $idCandidato, PDO::PARAM_STR);
            $pdt->bindParam(':sentimento', $sentimento, PDO::PARAM_STR);
            if ($pdt->execute()) {
                return true;
            }else{
                return false;
            }
        }catch(PDOException $exc){
            echo "" . ($exc->getMessage());
        }
    }

    public function buscarUsuarioOrdenados($nomeCandidato){ 
        var_dump($nomeCandidato);           
        try {
        $pdt = $this->pdo->prepare("SELECT id, tw_id, dia, hora, post FROM $nomeCandidato where post like '%$nomeCandidato%' order by tw_id, dia, hora");        
        $pdt->execute();                                        
        return $pdt->fetchAll();

        } catch (\Throwable $th) {
            echo "" . ($th->getMessage());
        }
    }
    public function salvarTwitterPorUsuario($arrayEleitore){        
        try {
            $pdt = $this->pdo->prepare("INSERT INTO twitter_por_usuario (id_origem, origem, tw_id, dia, hora)
                                        VALUES (:id_origem, :origem, :tw_id, :dia, :hora)");                   
            $pdt->bindParam(":id_origem",  $arrayEleitore['idOrigim'], PDO::PARAM_STR);
            $pdt->bindParam(":origem",  $arrayEleitore['origem'], PDO::PARAM_STR);
            $pdt->bindParam(":tw_id", $arrayEleitore['tw_id'], PDO::PARAM_STR);            
            $pdt->bindParam(":dia", $arrayEleitore['dia'], PDO::PARAM_STR);
            $pdt->bindParam(":hora", $arrayEleitore['hora'], PDO::PARAM_STR);            

            if($pdt->execute()){                
                return true;    
            } else{                
                return false;
            }       

        } catch (\Throwable $th) {
            echo "" . ($th->getMessage());
        }  
    }
}

?>