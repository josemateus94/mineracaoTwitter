<?php

require_once('Conexao.php');

class Candidato{

    private $conexao;
    private $pdo;

    public function __construct(){
        $this->conexao = new Conexao();
        $this->pdo = $this->conexao->conectar();
    }

    function inserePost($candidato, $nomeCandidato){

        try {
            $pdt = $this->pdo->prepare("INSERT INTO $nomeCandidato (tw_id, nome, localizacao, aparelho ,tw_data, post)
                                        VALUES (:tw_id, :nome, :localizacao, :aparelho , :tw_data, :post)");
            $pdt->bindParam(":tw_id", $candidato['tw_id'], PDO::PARAM_STR);
            $pdt->bindParam(":nome",  $candidato['nome'], PDO::PARAM_STR);
            $pdt->bindParam(":localizacao",  $candidato['localizacao'], PDO::PARAM_STR);
            $pdt->bindParam(":aparelho",  $candidato['aparelho'], PDO::PARAM_STR);
            $pdt->bindParam(":tw_data", $candidato['tw_data'], PDO::PARAM_STR);
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
}

?>