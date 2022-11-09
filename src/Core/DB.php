<?php

namespace PetShop\Core;

class DB
{
    /**
     * Váriável estática que armazenará a conexão ao banco de dados
     * em um objeto PDO
     *
     * @var \PDO
     */
    private static $db;

    /**
     * Retorna a conexão do banco de dados
     * reusa se já tiver estabelecida.
     *
     * @return \PDO
     */
    public static function getInstance() : \PDO {
            if( is_null(self::$db)) {
                try {
                    $dsn = sprintf('mysql:dbname=%s;host=%s', DB_SCHEMA, DB_HOST);
                    self ::$db = new \PDO($dsn, DB_USER, DB_PASSWORD);
                } catch(\PDOException $e) {
                    error_log($e->getMessage());
                    throw new Exception('Falha ao realizar conexão com o servidor, por favor, tente mais tarde. :('); 
                }
            }
            return self::$db;
    }
        public static function query(string $sql, array $params=[]) : \PDOStatement 
        {
            try {
                $st = self::getInstance()->prepare($sql);
                if (!$st) {
                    error_log('Erro ao preparar consulta: ' . $sql);
                    throw new Exception('Falha ao preparar comando SQL.');
                }
                if (!$st->execute($params)) {
                    error_log('Erro ao executar comando sql: ' . $sql . ' - ' .  var_export($params, true) );
                    throw new Exception('Falha ao executar comando SQL.');
                }
                return $st;
            } catch(\PDOException $e) {
                error_log('Erro PDO ' . $e->getMessage() . ' - Linha: ' . $e->getLine());
                throw new Exception('Falha ao executar comando no DB');
            }
        }
}