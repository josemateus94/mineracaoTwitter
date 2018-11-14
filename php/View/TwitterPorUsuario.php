<?php require_once("Cabecalho.php"); ?>

<div class='controller'>
    <h1>Twitter Por Usuario</h1>
    <form method='POST' action='../Routes/Routes.php'>  
    <table class='table'>
            <tr>                
                <td>Nome candidado</td>
                <td>
                    <select name='nomeCandidato'>
                        <option value='anastasia'>anastasia</option>
                        <option value='romeu_zema'>Romeu Zema</option>
                        <option value='pimentel'>pimentel</option>
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
                <td></td>
                <td></td>
            </tr>             
        </table>  
            Para segurança, o botão se encontra comentado, descomente para utilizar.
            <br/>As tabelas anastasia, pimentel, e romeu_zema terar que ser modelada.
        <!--<input class='hidden' type='text' name='tipo' id='tipo' value='twitterPorUsuario'>
        </br>
        <button class='btn bg-primary'>iniciar</button>-->
    </form>
</div>

<?php require_once("Rodape.php"); ?>

