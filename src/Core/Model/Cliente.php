<?php

namespace PetShop\Model;

use Exception;
use PetShop\Core\Attribute\Campo;
use PetShop\Core\Attribute\Entidade;
use PetShop\Core\DAO;

#[Entidade(name: 'clientes')]

class Cliente extends DAO {
    #[Campo(label: 'Cód. Cliente', nn:true, pk:true, auto:true)]
    protected $idCliente;

    #[Campo(label: 'Tipo de Cliente (PF/PJ)', nn:true)]
    protected $tipo;

    #[Campo(label: 'Cód. Cliente', nn:true, pk:true, auto:true)]
    protected $cpfcnpj;

    #[Campo(label: 'Nome Completo', nn:true)]
    protected $nome;
    
    #[Campo(label: 'E-mail', nn:true)]
    protected $email;
    
    #[Campo(label: 'Senha', nn:true)]
    protected $senha;

    #[Campo(label: 'Dt. Criação', nn:true, auto:true)]
    protected $created_at;

    #[Campo(label: 'Dt. Alteração', nn:true, auto:true)]
    protected $updated_at;

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of idCliente
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Get the value of tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     */
    public function setTipo($tipo): self
    {
        $tipo = strtoupper(trim($tipo));
        if ( !in_array($tipo, ['F', 'J']) ) {
            throw new Exception('O tipo de pessoa não está definido corretamente (F/J)');
        }
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     */
    public function setSenha($senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of cpfcnpj
     */
    public function getCpfcnpj()
    {
        return $this->cpfcnpj;
    }

    /**
     * Set the value of cpfcnpj
     */
    public function setCpfcnpj($cpfcnpj): self
    {
        $this->cpfcnpj = $cpfcnpj;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }


    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}