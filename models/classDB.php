<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/ftp/config.php');
include_once($_SERVER['DOCUMENT_ROOT'] .'/ftp/models/classFTP.php');

class db
{
    private $db_host = DB_HOST;
    private $db_usuario = DB_USUARIO;
    private $db_senha = DB_SENHA;
    private $db_nome = DB_NOME;
    public $db;

    public function __construct(){
        if (!isset($this->db)) {
            try {
                $conexao = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_nome, $this->db_usuario, $this->db_senha);
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $conexao;
                echo "<br>";
            
            } catch (PDOException $e) {
                die("Falha ao conectar com MySQL: " . $e->getMessage());
            }
        }
    }

    /**
     * @param $tabela
     * @param $dados
     * @return array|bool
     * função: salvar os dados iniciais da migração no banco
     */
    public function inserir_dados_migracao($tabela, $dados) {
        if (!empty($dados) && is_array($dados)) {
            $string_coluna = implode(',', array_keys($dados));
            $string_valor = ":" . implode(',:', array_keys($dados));
            
            $sql = "INSERT INTO " . $tabela . " (" . $string_coluna . ") VALUES (" . $string_valor . ")";
            $query = $this->db->prepare($sql);
        
            foreach ($dados as $key => $val) {
                $val = htmlspecialchars(strip_tags($val));
                $query->bindValue(':' . $key, $val);
            }
        
            $insert = $query->execute();
        
            if ($insert) {
                $dados['id'] = $this->db->lastInsertId();
                return $dados;
            } else {
                return false;
            }
            } else {
                return false;
        }
    
    }


    /**
     * @return int
     * função: utilizado na index para montar a tabela das migrações
     */
    public function monta_tabela_migracoes(){
        
            $consulta = $this->db->prepare('SELECT * FROM `ftp` ORDER BY `idProcesso` DESC LIMIT 40');
            $consulta->execute();
                             
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $resul) {

            $lista = "<tr>
            <th scope='row'>". $resul['idProcesso']."</th>
            <td>host: " . $resul['hostFtp'] . 
            "<br> usuario: " . $resul['usuario']. 
            "<br> senha: " .$resul['senha'].  
            "<br> log: " .$resul['arquivoProgresso'].
            "<br> data: " .$resul['data']. 
            "</td>          
            <td>host: " . $resul['hostDestino'] . 
            "<br> usuario: " . $resul['usuarioDestino']. 
            "<br> senha: " .$resul['senhaDestino'].  
            "<br> log: " .$resul['arquivoUpload'].
            "<br> data: " .$resul['data']. 
            "</td>          
             <td>status Download: " . $resul['status'] . 
            "<br> statusUpload: " . $resul['statusUpload']. 
            "</td> ";

            echo $lista;

            }

        return 0;
    }

    /**
     * @param $status
     * @return false|int
     * função: recebe status 1 e verifica no log do arquivo cujo o status é 1 se ja localiza o finished, se sim, atualiza para 2.
     */
    public function verifica_fim_download($status)
    {

        $consulta = $this->db->query("SELECT arquivoProgresso FROM ftp WHERE status =" . $status);
        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);


            foreach ($resultados as $resul) {
                $log = "../processo/" . $resul['arquivoProgresso'];
                $line = file_get_contents($log);
                $localizafim = preg_match("/FINISHED/", $line);
                $status = '2';//1. migrando 2. migrado 3.em upload

                if ($localizafim == 1) {
                    echo "<br>";
                    echo "finalizado " . $resul['arquivoProgresso'];
                    $this->atualiza_status_download($status, $resul['arquivoProgresso']);
                } else {
                    echo "<br>";
                    echo "ainda não finalizado " . $resul['arquivoProgresso'];
                }
            }

        return $localizafim;
    }

    /**
     * @param $status
     * @return int
     * 1. migrando 2. migrado 3 .em upload
     * função: recebe o status 3 e abre o arquivo do log para conferir se acha sent, se acha sent, atualiza no banco o status para 2 como finalizado
     *
     */
    public function monitora_progresso_upload($status){

            $consulta = $this->db->query("SELECT arquivoUpload FROM ftp WHERE statusUpload =" . $status);
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);



              foreach ($resultados as $resul) {

               $log = "../processo_upload/" . $resul['arquivoUpload'];
               $line = file_get_contents($log);
               $localizafim = preg_match("/sent/", $line);
               $status = '2';
             
             if($localizafim == 1){
                echo "<br>";
                echo "finalizado ".$resul['arquivoUpload'];
                $this->atualiza_status_upload($status, $resul['arquivoUpload']);
            } else {
                echo "<br>";
                echo "ainda não finalizado " .$resul['arquivoUpload'];
         }
     }

        return 0;
    }

    /**
     * @return int
     * 1. migrando 2. migrado 3.em upload
     * função: verifica se o status é 2 e statusUpload é 1 e chama função do ftp para fazer upload, posteriormente atualiza o status para 3 no banco
     */
    public function inicia_upload_destino(){
    
     $consulta = $this->db->query("SELECT arquivoProgresso FROM ftp WHERE status = 2 AND statusUpload = 1");
             
             $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $resul) {
             $conexao_destino = $this->busca_dados_upload($resul['arquivoProgresso']);
             $conexao_destino['hostDestino'];
             $conexao_destino['usuarioDestino'];
             $conexao_destino['senhaDestino'];
             $conexao_destino['caminhaBackup'];
             $conexao_destino['arquivoUpload'];
             $status = '3';
                 $ftp = new ftp();
                 $envia_dados = $ftp->upload_conteudo($conexao_destino['hostDestino'], $conexao_destino['usuarioDestino'], $conexao_destino['senhaDestino'], $conexao_destino['caminhaBackup'], $conexao_destino['arquivoUpload']);
                 $this->atualiza_status_upload($status, $resul['arquivoProgresso']);

echo  $this->atualiza_status_upload($status, $resul['arquivoProgresso']);
             }
            
            return $resultados;
    }

    /**
     * @param $arquivoProgresso
     * @return bool|int|mixed
     * função: prover para inicia_upload_destino as migrações que precisam ser executadas
     */
    public function busca_dados_upload($arquivoProgresso){
        
        $consulta = $this->db->prepare('SELECT `hostDestino`, `usuarioDestino`, `senhaDestino`, `caminhaBackup`, `arquivoUpload`  FROM `ftp` WHERE `arquivoProgresso` = :arquivoProgresso;');
        $consulta->bindParam(':arquivoProgresso', $arquivoProgresso, PDO::PARAM_STR);
        $consulta->execute();
        
        $linha = $consulta->fetch(PDO::FETCH_ASSOC);
             return !empty($linha) ? $linha : false;


            return 0;
    }

    /**
     * @param $status
     * @param $arquivoProgresso
     * @return int
     * função: atualiza o satatus do banco para downloads
     */
    public function atualiza_status_download($status, $arquivoProgresso){
            $atualiza = $this->db->prepare('UPDATE `ftp` SET status = :status WHERE `arquivoProgresso` = :arquivoProgresso');
            $atualiza->execute(array(
            ':status' => $status,
            ':arquivoProgresso'=> $arquivoProgresso
        ));
        return 0;
    }

    /**
     * @param $status
     * @param $arquivoProgresso
     * @return int
     * função: atualiza statusUpload do banco para uploads
     */
    public function atualiza_status_upload($status, $arquivoProgresso){
            $atualiza = $this->db->prepare('UPDATE `ftp` SET statusUpload = :statusUpload WHERE `arquivoProgresso` = :arquivoProgresso');
            $atualiza->execute(array(
            ':statusUpload' => $status,
            ':arquivoProgresso'=> $arquivoProgresso
        ));
        return 0;
    }
    

}

