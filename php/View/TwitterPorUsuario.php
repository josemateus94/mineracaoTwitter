<?php require_once("Cabecalho.php"); ?>

<div class='controller'>
    <h1>Twitter Por Usuario</h1>
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
                <td></td>
                <td></td>
            </tr>             
        </table>  
            Para segurança, o botão se encontra comentado, descomente para utilizar.
        <br/>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3"> 
                    <input class='hidden' type='text' name='tipo' value='twitterPorUsuario'>        
                    <button class='btn bg-primary' disabled>Salvar na tabela twitter por usuario</button>
                </div>        
    </form>
                <div class="col-md-2"> 
                    <form method='POST' action='../Routes/Routes.php'>
                        <input class='hidden' type='text' name='tipo' value='CorrigirHoras'>        
                        <button class='btn bg-primary' disabled>Corrigir Horas</button>
                    </form>
                </div>

                <div class="col-md-2"> 
                    <form method='POST' action='../Routes/Routes.php'>
                        <input class='hidden' type='text' name='tipo' value='mediaTwitterPorUsuario'>        
                        <button class='btn bg-primary'>Media twitter por usuario</button>
                    </form>
                </div>
                <div class="col-md-2"> 
                    <form method='POST' action='../Routes/Routes.php'>
                        <input class='hidden' type='text' name='tipo' value='TotalIdsDiferente'>        
                        <button class='btn bg-primary'>Total Ids Diferente</button>
                    </form>
                </div>                
            </div>
        </div>           
</div>

<?php require_once("Rodape.php"); ?>

