<?php
    header('Content-Type: text/htm; charset=utf-8;');

//Verifica se a classe Conexo já foi definida para evitar declaração duplicada
if (!class_exists('Conexao')){
    class Conexao {
        private static $conexao;

        private function __construct(){
            //Log para verificar quando a classe é instanciada
            error_log("Classe Conexao instanciada");
        }
        public static function getConexao(){
            //não existe instancia no atributo conexão?
            if(!isset(self::$conexao)){
                try {
                    //verificar persistencia dos valores
                    //aceitar caracteres com acentos e cedilhas
                    //levantar exceção ao criar sql com erros
                    $options = array(
                        PDO::ATTR_PERSISTENT => true,
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4;',
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    );
                        self::$conexao = new PDO("mysql:host=localhost;dbname=jmtg_service", "root", "", $options);
                }catch (PDOException $exc) {
                    echo "Erro ao conectar ao banco".$exc->getMessage();
                }
            }
            return self::$conexao;
        }
    }
}
?>
