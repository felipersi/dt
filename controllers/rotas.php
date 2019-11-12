<?php
include_once('../models/classFTP.php');
include_once('../models/classDB.php');
/**
 * 1. migrando 2. migrado 3. em upload
 * dados origem
 *
 */

$ftphost = $_POST['host_origem'];
$usuario = $_POST['usuario_origem'];
$senha = $_POST['senha_origem'];
$host = 'ftp://' . $ftphost .'/';
$dir_backup =  '/var/www/html/ftp/download'; //alterar quando subir para o servidor de migração
$progress = uniqid().'.txt';
$data = date("Y-m-d-H-i-s");
$status = '1';
/**
 * dados destino
 */
$ftphost_destino = $_POST['host_destino'];
$usuario_destino = $_POST['usuario_destino'];
$senha_destino = $_POST['senha_destino'];
$caminho_backup = $dir_backup.'/'.$ftphost.'-'.$data;

    $ftp = new ftp();
    $inicia_download = $ftp->download_conteudo($host, $usuario, $senha, $dir_backup, $progress, $data);


    $conectadb = new db();
    $tabela = 'ftp';


$dados_migracao = array(
      'idProcesso' => '',
      'hostFtp' => $host,
      'usuario' => $usuario,
      'senha' => $senha,
      'arquivoProgresso' => $progress,
      'dirBackup' => $dir_backup,
      'status' => $status,
      'data' => $data,
      'hostDestino' => $ftphost_destino,
      'usuarioDestino' => $usuario_destino,
      'senhaDestino' => $senha_destino,
      'caminhaBackup' => $caminho_backup,
      'statusUpload' => $status,
      'arquivoUpload' => $progress,
    );

    $insert = $conectadb->inserir_dados_migracao($tabela, $dados_migracao);

    echo $inicia_download;

?>

<script type="text/javascript">
window.location.href = 'http://chamadosn1.kinghost.net/ftp';
</script>
