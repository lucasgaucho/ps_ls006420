<?php

namespace PetShop\Core;

class DB
{
    private static $db;


    public static function getInstance() : \PDO
    {
        if ( is_null(self::$db) ){
            try{
                $options = [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,    
                \PDO::ATTR_EMULATE_PREPARES => false,    
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ];
            } catch(\PDOException $e){
                error_log( $e->getMessage());
                throw new Exception('Falha ao realizar a conexão com o servidor, por favor, tente mais tarde');
            }
        }
        return self::$db;
    }

    public static function select(string $sql, array $params=[]) : array
    {
        $st = self::query($sql, $params);
        return $st->fetchAll();
    }

    
    public static function query(string $sql, array $params=[]) : \PDOStatement
    {
        try{
            $st = self::getInstance()->prepare($sql);
            if (!$st) {
                error_log("Erro ao preparar a consulta:\n{$sql}");
                throw new Exception ('Falha a preparar comando SQL');
            }

            $params = array_values($params);
            if (!$st->execute($params)) {
                error_log("Erro ao executar comando SQL:\n{$sql}\nParâmetros:\n " .
                var_export($params, true));
                throw new Exception ('Falha ao executar comando SQL');
            }
            return $st;
        } catch(\PDOException $e){
            $msgErroLog = sprintf("Erro PDO: %s, na linha: %s, comando: \n%s\nParâmetros\n%s",
        $e->getMessage(),
        $e->getLine(),
        $sql,
        var_export($params, true)
        );
            error_log($msgErroLog);
            throw new Exception('Falha ao realizar comando no banco de dados');
        }
    }
}