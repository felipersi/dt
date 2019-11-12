<?php

class ftp {
	private $host;
	private $usuario;
	private $senha;
	private $dir_backup;
	private $progresso;
	private $host_destino;
	private $usuario_destino;
	private $senha_destino;
	private $caminho_backup;
	private $processo_upload;


function __construct() {

    }

    /**
     * @param $host
     * @param $usuario
     * @param $senha
     * @param $dir_backup
     * @param $progresso
     * @param $data
     * @return string
     * função: executa o wget com os dados passados no form de inicialização direcioando o log para a pasta /processo.
     */

public function download_conteudo($host, $usuario, $senha,  $dir_backup, $progresso, $data) {

	$this->host = $host;
	$this->usuario = $usuario;
	$this->senha = $senha;
	$this->progresso = $progresso;
	$this->dir_backup = $dir_backup;
    $this->data = $data;
    $this->pasta = $this->host;

        $this->pasta_backup = substr($this->pasta, 0, -1);

	$comandowget = 'wget -bcr -l inf -o ../processo/' .$this->progresso.
        ' --user='.$this->usuario.
        ' --password=' .$this->senha. ' ' . $this->host  .
        ' -P ' .$this->dir_backup. '/'. substr($this->pasta_backup, 6).'-'.$this->data;

		shell_exec($comandowget);


	return $comandowget;
	
	}

    /**
     * @param $servidor_destino
     * @param $usuario_destino
     * @param $senha_destino
     * @param $caminho_backup
     * @param $processo_upload
     * @return string
     * função: executa o upload dos arquivos posteriormente a migração
     *
     */
public function upload_conteudo($servidor_destino, $usuario_destino, $senha_destino, $caminho_backup, $processo_upload) {
	
	$this->processo_upload = $processo_upload;
	$this->servidor_destino = $servidor_destino;
	$this->usuario_destino = $usuario_destino;
	$this->senha_destino =  $senha_destino;
	$this->caminho_backup = $caminho_backup;

    $comandorsync = 'sshpass -p ' .$this->senha_destino. ' rsync -azhe "ssh -o StrictHostKeyChecking=no" --info=progress2 '.$this->caminho_backup. ' ' . $this->usuario_destino.'@'.$this->servidor_destino.':~/ --log-file=../processo_upload/'.$this->processo_upload;

        shell_exec($comandorsync);

	return $comandorsync;
	}

}

