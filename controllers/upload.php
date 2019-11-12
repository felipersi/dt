<?php
error_reporting(0);
include_once($_SERVER['DOCUMENT_ROOT'] . '/ftp/models/classFTP.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/ftp/models/classDB.php');
/**
 * função: cron que inicia upload se estiver status 2 e statusUpload 1/ o monitora_progresso_upload verifica finalização no arquivo de log em /processo_upload.
 */
$conecta = new db();
$status_progresso = '3';

$upload = $conecta->inicia_upload_destino();
$monitora_upload = $conecta->monitora_progresso_upload($status_progresso);

