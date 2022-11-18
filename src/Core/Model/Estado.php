<?php

namespace Petshop\Core\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;

#[Entidade(name: 'estados')]
class Estado extends DAO
{
  #[Campo(label: 'Unidade Federativa do estado ', pk: true, nn: true)]
  protected $uf;

  #[Campo(label: 'Cód. IBGE do estado ', nn: true)]
  protected $ibge;

  #[Campo(label: 'Nome do estado ', nn: true, order: true)]
  protected $estado;

  #[Campo(label: 'Região do estado ', nn: true)]
  protected $regiao;


  public function getUf()
  {
    return $this->uf;
  }

  public function getIbge()
  {
    return $this->ibge;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function getRegiao()
  {
    return $this->regiao;
  }
}
