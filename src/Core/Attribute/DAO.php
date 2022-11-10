<?php
namespace Petshop\Core;

use Exception;

class DAO {

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
        if(!isset($info['tabela']) || !isset($info['campos'])) {
            throw new Exception('Os atributos da classe/propriedades não foram preenchidos');
        }
        
        return $info;
    }    
    public function __get($name)
    {
        $metodoProcurado = 'get' . $name;
        if( method_exists($this,$metodoProcurado)) {
            return $this->$metodoProcurado();
        } else {
            throw new Exception("O atributo {$name} não tem metodo get associado");
        }
    }

    public function __set(string $name, $value)
    {
        $metodoProcurado = 'set' . $name;
        if (method_exists($this, $metodoProcurado)) {
            return $this->$metodoProcurado($value);
        } else {
            throw new Exception("O atributo {$name} não tem 
            método 'set' associado");
        }
    }

}