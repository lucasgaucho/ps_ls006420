<?php

namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;

#[Entidade(name: 'cidades')]
class Cidade extends DAO
{
    #[Campo(label: 'Cód. Cidade', nn:true, pk:true, auto:true)]
    protected $idCidade;

    #[Campo(label: 'Estado', nn:true)]
    protected $uf;

    #[Campo(label: 'IBGE', nn:true)]
    protected $ibge;

    #[Campo(label: 'IBGE7', nn:true)]
    protected $igbe7;

    #[Campo(label: 'Municipio', nn:true)]
    protected $municipio;

    #[Campo(label: 'Região', nn:true)]
    protected $regiao;

    #[Campo(label: 'População', nn:true)]
    protected $populacao;

    #[Campo(label: 'Porte', nn:true)]
    protected $porte;

    #[Campo(label: 'Capital', nn:true)]
    protected $capital;

    public function getIdCidade()
    {
        return $this->idCidade;
    }

    public function getUf()
    {
        return $this->uf;
    }
    public function setUf($uf): self
    {
        $this->uf = $uf;
        return $this;
    }

    public function getIbge()
    {
        return $this->ibge;
    }
    public function setIbge($ibge): self
    {
        $this->ibge = $ibge;
        return $this;
    }

    public function getIgbe7()
    {
        return $this->igbe7;
    }
    public function setIgbe7($igbe7): self
    {
        $this->igbe7 = $igbe7;
        return $this;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }
    public function setMunicipio($municipio): self
    {
        $this->municipio = $municipio;
        return $this;
    }

    public function getRegiao()
    {
        return $this->regiao;
    }
    public function setRegiao($regiao): self
    {
        $this->regiao = $regiao;
        return $this;
    }

    public function getPopulacao()
    {
        return $this->populacao;
    }
    public function setPopulacao($populacao): self
    {
        $this->populacao = $populacao;

        return $this;
    }

    public function getPorte()
    {
        return $this->porte;
    }
    public function setPorte($porte): self
    {
        $this->porte = $porte;
        return $this;
    }

    public function getCapital()
    {
        return $this->capital;
    }
    public function setCapital($capital): self
    {
        $this->capital = $capital;
        return $this;
    }
}