<?php require_once("Cabecalho.php"); ?>

<div class='controller'>
    <h1>Twitter Por Usuario</h1>      
    <table class='table'>
        <tr>                
            <td>Nome candidado</td>
            <td>
                <select name='nomeCandidato' id='nomeCandidato' onclick='candidato()'>
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
    Para segurança, alguns botões se encontra desativado, ativo para utilizar(via codígo).
    <br/>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3"> 
                <form method='POST' action='../Routes/Routes.php'>
                    <input class='hidden' type='text' name='tipo' value='twitterPorUsuario'>       
                    <input class='hidden nomeCandidato' type='text' name='nomeCandidato' value=''>  
                    <button class='btn bg-primary' >Salvar na tabela twitter por usuario</button>
                </form>
            </div>            
            <div class="col-md-3"> 
                <form method='POST' action='../Routes/Routes.php'>                        
                    <input class='hidden' type='text' name='tipo' value='CorrigirHoras'>
                    <input class='hidden nomeCandidato' type='text' name='nomeCandidato' value=''>                                
                    <button class='btn bg-primary' >Corrigir Horas da tabela do candidato</button>
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
                    <input class='hidden' type='text' name='tipo' class='tipo' value='TotalIdsDiferente'>        
                    <button class='btn bg-primary'>Total Ids Diferente</button>
                </form>
            </div> 
            <div class="col-md-3"> 
                <form method='POST' action='../Routes/Routes.php'>                        
                    <input class='hidden' type='text' name='tipo' value='MediaPorPeriodo'>
                    <input class='hidden nomeCandidato' type='text' name='nomeCandidato' value=''>                                
                    <button class='btn bg-primary'>Media por dia</button>
                </form>
            </div>               
        </div>
    </div>           
</div>

<?php require_once("Rodape.php"); ?>

<script>
    $('.nomeCandidato').val($('#nomeCandidato').val());
    function candidato(){
        nomeCandidato = $('#nomeCandidato').val();
        $('.nomeCandidato').val(nomeCandidato);
    }    
</script>

