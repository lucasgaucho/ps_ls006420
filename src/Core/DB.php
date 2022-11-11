<?php

namespace Petshop\Core;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;

class DB
{
    private $tableinfo = [];

    public function __construct()
    {
        $this->tableInfo = $this->getTableInfo();;
    }

    /**
     * Variavel estática que armazenara a conexão ao banco de dados 
     * num objeto PDO
     *
     * @var \PDO
     */
    private static $db;

    /**
     * Retorna uma uma instância de conexão ao banco de dados
     * reusa se já houver uma estabelecida
     *
     * @return \PDO
     */
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

    /**
     * Método estático que retorna o resultado d uma consulta SQL
     * preparada ou não. Retorna um vetor de dados (PDO::FETCH_ASSOC)
     *
     * @param string $sql Consulta preparada com ou sem parâmetros
     * @param array $params Parâmetros opcionais
     * @return array
     */
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

    /**
     * Método estático que retorna um Statement de uma execução SQL
     * no banco de dados 
     *
     * @param string $sql Comando SQL (insert/update/delete) preparado
     * @param array $params Parâmetros/valores referentes a consulta
     * @return \PDOStatement
     */
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

    public function getTableInfo() : array
    {
        /*vetor que armazenara as informações da classe 
        referente as tabelas e campos do banco de dados
         */
        $info = [];

        /*pegando as metainformações da classe referente ao
        objeto atual instanciado
         */
        $ref = new \ReflectionClass($this::class);
        foreach($ref->getAttributes(Entidade::class) as $attrTable) {
            $info['tabela'] = $attrTable->getArguments();

            //procurando as metainformações das propriedades da classe
            foreach($ref->getProperties() as $propriedade) {
                // para cada campo/prop localizada, procura seus atributos
                foreach($propriedade->getAttributes(Campo::class) as $attrCampo) {
                    $info['campos'][$propriedade->getName()] = $attrCampo->getArguments();
                }
            }
        }
    
    public function getTableName() : string
    {
    return $this->tableinfo['tabela']['name'];
    }   

    public function getFields() : array
    {
        return $this->tableInfo['campos'];
    }

    public function getOrderbyField() : string 
    {
        foreach($this->tableinfo['campos'] as $cname => $cprops) {
            if(array_key_exists('order', $cprops)) {
                return strtolower($cname);
            }
            return ''; 
    }}

    public function find(array $params=[], array $order=[], string $columns='*') : array
    {
        $where = '';
        if (count($params)) {
            $where = 'WHERE' . implode('? and ', $array_keys($params)) . ' ? ';
            die($where);

            $orderBy = '';
            if (count($order)) {
                $orderBy = ' ORDER BY ' . implode(',', $order);
            } elseif ($this->getOrderbyField() ){
                $orderBy = 'ORDER BY ' . $this->getOrderbyField(); 
            }
            $sql = sprintf(
                 'SELECT s% FROM %s %s %s',
                 $columns,
                 $this->getTableName(),
                 $where,
                 $orderBy
            );
            return DB::select($params);
        }
    }

    public function getPkName() : array 
    {
        foreach($this->tableinfo['campos'] as $cname => $cprops) {
            if(array_key_exists('pk', $cprops)) {
                return strtolower($cname);
            }
            return '';
                }
        }

}