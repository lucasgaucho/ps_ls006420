<?php

namespace PetShop\Core;

class DB
{
    private static $db;


    public static function getInstance() : \PDO
    {
        if ( is_null(self::$db) ){
            try{
                $dsn = sprintf('mysql:dbname=%s;host=%s', DB_SCHEMA, DB_HOST);
            self::$db = new \PDO($dsn, DB_USER, /*DB_PASS*/);
            } catch(\PDOException $e){
                error_log( $e->getMessage());
                throw new Exception('Falha ao realizar a conexão com o servidor, por favor, tente mais tarde');
            }
        }
        return self::$db;
    }

    public static function select(string $sql, array $params=[]) : array
    {
        try{
            $st = self::getInstance()->prepare($sql);
            if (!$st) {
                error_log('Erro ao preparar a consulta: ' . $sql);
                throw new Exception ('Falha a preparar comando SQL');
            }

            $params = array_values($params);
            if (!$st->execute($params)) {
                error_log('Erro ao executar comando SQL: ' . $sql . '-' .
                var_export($params, true));
                throw new Exception ('Falha ao executar comando SQL');
            }
            return $st->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            error_log('Erro PDO: ' . $e->getMessage() . ' - Linha: ' . $e->getLine() . ' - ' . $sql);
            throw new Exception('Falha ao realizar consulta no banco de dados');
        }
        return [];
    }

    
    public static function query(string $sql, array $params=[]) : \PDOStatement
    {
        try{
            $st = self::getInstance()->prepare($sql);
            if (!$st) {
                error_log('Erro ao preparar a consulta: ' . $sql);
                throw new Exception ('Falha a preparar comando SQL');
            }

            $params = array_values($params);
            if (!$st->execute($params)) {
                error_log('Erro ao executar comando SQL: ' . $sql . '-' .
                var_export($params, true));
                throw new Exception ('Falha ao executar comando SQL');
            }
            return $st;
        } catch(\PDOException $e){
            error_log('Erro PDO: ' . $e->getMessage() . ' - Linha: ' . $e->getLine());
            throw new Exception('Falha ao realizar comando no banco de dados');
        }
    }
}