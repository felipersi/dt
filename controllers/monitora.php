<?php
error_reporting(0);
include_once($_SERVER['DOCUMENT_ROOT'] . '/ftp/models/classFTP.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/ftp/models/classDB.php');
/**
 * nome: Luis Felipe
 * função: Cron que confere status de migrações 1 e se finalizado muda para 2, monitorando finalização
 * 1. migrando 2. migrado 3. em migraca
 */
$conecta = new db();
$status = '1';
$busca = $conecta->verifica_fim_download($status);

