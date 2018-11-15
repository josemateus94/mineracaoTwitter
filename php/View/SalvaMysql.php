<?php require_once("Cabecalho.php"); ?>

<div class='controller'>
    <h1>Ler o txt do python e salva no mysql</h1>
    <form method='POST' action='../Routes/Routes.php'>
        <table class='table'>
            <tr>                
                <td>Nome candidado</td>
                <td>
                    <select name='nomeCandidato'>
                        <option value='anastasia'>Anastasia</option>
                        <option value='romeu_zema'>Romeu Zema</option>
                        <option value='pimentel'>Pimentel</option>
                        <option value='adalclever_lopes'>Adalclever Lopes</option>
                        <option value='alexandre_flach'>Alexandre Flach</option>
                        <option value='claudiney_dulim'>Claudiney Dulim</option>
                        <option value='dirlene_marques'>Dirlene Marques</option>
                        <option value='joao_batista_mares_guia'>João Batista Mares Guia</option>
                        <option value='jordano_metalurgico'>Jordano Metalúrgico</option>  
                    </select>                                                             
                </td>
            </tr>
            <tr>
                <td>Selecione o arquivo desejado</td>
                <td>
                    <input type='file' name='arquivo' class='form form-control'>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>             
        </table>        
        <input class='hidden' type='text' name='tipo' id='tipo' value='salvarMysql'>
        </br>
        <button class='btn bg-primary'>OK</button>
    </form>
</div>

<?php require_once("Rodape.php"); ?>

