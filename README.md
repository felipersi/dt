# Data Trasport - DT

Data Transport é um sistema de uma série de três sistemas open source. Ele visa resolver problemas de transferir aplicações entre provedores em larga escala(revendas de hospedagem) ao mesmo tempo com facil gerenciamento da lista e sem a necessidade de acompanhamento "moment by moment".

## Instalação

Para a instalação é de suma importancia que você tenha conhecimento de configurações do servidor web.

Para a instalação, você precisará de servidor web Centos 7 com:
```bash
Apache2 - yum -y install httpd
Php 7.0+ - yum --enablerepo=epel -y install php php-mbstring php-pear php-fpm 
SSHPASS - yum --enablerepo=epel -y install sshpass
Mysql 5.7 - yum --enablerepo=centos-sclo-rh -y install rh-mysql57-mysql-server 
```

Este mecanismo foi desenvolvido utilizando o MAMP + sshpass para abrir um canal de download do FTP por dentro dele.

Após ter o servidor com os requisitos adequados para o funcionamento, você só precisará subir os arquivos para a raiz do site ou em uma subpasta.

Você precisará criar crons no servidor para executar os arquivos `monitora.php` e `upload.php`. Estes arquivos controlam o dowload e upload, particularmente eu defini a cron a cada 2 minutos para monitora.php e a cada 3 minutos para upload.php.


##Como utilizar

No arquivo da raiz `config.php` digite os dados do seu banco de dados
```bash
define('DB_USUARIO', 'usuario');
define('DB_SENHA', 'senha_banco');
define('DB_HOST', 'localhost');
define('DB_NOME', 'nome_banco');
```
## Suporte
luis.felipersi@gmail.com

## Licença
[MIT](http://opensource.org/licenses/mit-license.php)