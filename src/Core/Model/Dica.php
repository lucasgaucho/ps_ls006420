<?php

namespace Petshop\Model;

use Exception;
use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;

#[Entidade(name: 'dicas')]
class Dica extends DAO
{
    #[Campo(label: 'Cód. Dica', nn:true, pk:true, auto:true)]
    protected $idDica;

    #[Campo(label: 'Titulo', nn:true, order:true)]
    protected $titulo;

    #[Campo(label: 'Descrição', nn:true)]
    protected $descricao;

    #[Campo(label: 'Dt. Criação', nn:true, auto:true)]
    protected $created_at;

    #[Campo(label: 'Dt. Alteração', nn:true, auto:true)]
    protected $updated_at;

    public function getIdDica()
    {
        return $this->idDica;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($titulo): self
    {
        $titulo = trim($titulo);
        if(!$titulo) {
            throw new Exception('Titulo invalido');
        }
        $this->titulo = $titulo;
        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao($descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getCreated_At()
    {
        return $this->created_at;
    }
    public function getUpdated_At()
    {
        return $this->updated_at;
    }

    public function loadById(int | string $id) : bool
    {
        if (!$this->getPkName()) {
            return false;
        }
        $registro = $this->find([
            $this->getPkName() . '=' => $id;
        ]); 

        if( !isset($registro[0] ) )
        {
            return false;
        }
        
        $atributos = array_keys( $this->getFields() );
        foreach($atributos as $atributo) {
            $this->$atributo = $registro[0][ strtolower($atributo) ];
        }
        return true;
    }

        public function save() : bool
        {
            $nomedatabela = $this->getTableName();
            $nomeCampoChave = $this->getPkName();
            $valorCampoChave = $this->$nomeCampoChave;

            $campos = [];
            foreach($this->getFields() as $atributo => $parametros) {
                if (array_key_exists('auto', $parametros)) {
                    continue;
                }

                if(isnull($this->$atributo) && array_key_exists('nn', $parametros) ) {
                    $label = $parametros['label'];
                    throw new Exception("O campo {} deve ser preenchido");
                }
                $campos[ strtolower($atributo) ] = $this->$atributo;
            }
        }
}