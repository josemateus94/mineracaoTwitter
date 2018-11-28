<?php
switch ($_POST['tipo']) {
    case 'salvarMysql':
        require_once("../Controller/SalvaMysqlController.php");
        $salvarMysql = new SalvarMysqlController($_POST['nomeCandidato']);
        $salvarMysql->ler($_POST['arquivo'], $_POST['nomeCandidato']);
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
    case 'twitterPorUsuario':
        require_once('../Controller/TwitterPorUsuarioController.php');
        TwitterPorUsuarioController::comparar($_POST['nomeCandidato']);
        break;
    case 'mediaTwitterPorUsuario':
        require_once('../Controller/TwitterPorUsuarioController.php');
        TwitterPorUsuarioController::mediaTwitterPorUsuario();
        break;
    case 'TotalIdsDiferente':
        require_once('../Controller/TwitterPorUsuarioController.php');
        TwitterPorUsuarioController::TotalIdsDiferente();
        break;
    case 'CorrigirHoras':
        require_once('../Controller/TwitterPorUsuarioController.php');
        TwitterPorUsuarioController::CorrigirHoras($_POST['nomeCandidato']);
        break;
    case 'MediaPorPeriodo':
        require_once('../Controller/TwitterPorUsuarioController.php');
        TwitterPorUsuarioController::MediaPorPeriodo($_POST['nomeCandidato']);
        break;
}
?>