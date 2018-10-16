<?php

switch ($_POST['tipo']) {
    case 'salvarMysql':
        require_once("../Controller/SalvaMysqlController.php");
        $salvarMysql = new SalvarMysqlController($_POST['nomeCandidato']);
        $salvarMysql->ler($_POST['arquivo']);
        break;
    case 'salvarifeel':
        require_once('../Controller/IfeelController.php');
        $ifeelController = new IfeelController();
        $ifeelController->salvarTxt($_POST['nomeCandidato'], $_POST['inicioDaBusca']);
        break;
    case 'exelMysal':
        require_once('../Controller/ExcelController.php');
        ExcelController::salvar($_POST['nomeCandidato'], $_POST['inicioDaBusca'], $_POST['fimDaBusca'], $_POST['arquivo']);
        break;
}
?>