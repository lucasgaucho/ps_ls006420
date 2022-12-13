<?php

namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;
use Petshop\Core\Exception;
use Respect\Validation\Validator as v;

#[Entidade(name: 'empresas')]
class Empresa extends DAO
{
    #[Campo(label: 'Cód. Empresa', pk: true, nn: true, auto: true)]
    protected $idempresa;

    #[Campo(label: 'Nome Fantasia', nn: true)]
    protected $nomefantasia;

    #[Campo(label: 'Razão Social', nn: true)]
    protected $razaosocial;

    #[Campo(label: 'Tipo', nn: true)]
    protected $tipo;

    #[Campo(label: 'CEP', nn: true)]
    protected $cep;

    #[Campo(label: 'Cidade', nn: true)]
    protected $cidade;

    #[Campo(label: 'Estado', nn: true)]
    protected $estado;

    #[Campo(label: 'Rua', nn: true)]
    protected $rua;

    #[Campo(label: 'Bairro', nn: true)]
    protected $bairro;

    #[Campo(label: 'Número', nn: true)]
    protected $numero;

    #[Campo(label: 'Telefone 01', nn: true)]
    protected $telefone1;

    #[Campo(label: 'Telefone 02', nn: true)]
    protected $telefone2;

    #[Campo(label: 'Site', nn: true)]
    protected $site;

    #[Campo(label: 'Email', nn: true)]
    protected $email;

    #[Campo(label: 'CNPJ', nn: true)]
    protected $cnpj;

    #[Campo(label: 'Dt. Criação', nn: true, auto: true)]
    protected $created_at;

    #[Campo(label: 'Dt. Alteração', nn: true, auto: true)]
    protected $updated_at;

    /**
     * Get the value of idempresa
     */
    public function getIdempresa()
    {
        return $this->idempresa;
    }

    /**
     * Get the value of nomefantasia
     */
    public function getNomefantasia()
    {
        return $this->nomefantasia;
    }

    /**
     * Set the value of nomefantasia
     */
    public function setNomefantasia(string $nomefantasia): self
    {
        $nomefantasia = trim($nomefantasia);
        $tamanhoValido = v::stringType()->length(1, 255)->validate($nomefantasia);
        if (!$tamanhoValido) {
            throw new Exception('O tamanho do nome fantasia é inválido');
        }
        $this->nomefantasia = $nomefantasia;

        return $this;
    }

    /**
     * Get the value of razaosocial
     */
    public function getRazaosocial()
    {
        return $this->razaosocial;
    }

    /**
     * Set the value of razaosocial
     */
    public function setRazaosocial(string $razaosocial): self
    {
        $razãoSocial = trim($razaosocial);
        $tamanhoValido = v::stringType()->length(1, 255)->validate($razaosocial);
        if (!$tamanhoValido) {
            throw new Exception('O tamanho do campo razão social é inválido');
        }
        $this->razaosocial = $razaosocial;

        return $this;
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
        $tipoValido = in_array($tipo, ['Matriz', 'Filial']);
        if (!$tipoValido) {
            throw new Exception('O tipo deves ser matriz ou filial apenas');
        }
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of cep
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     */
    public function setCep(string $cep): self
    {
        $CepValido = v::postalCode('BR')->validate($cep);
        if (!$CepValido) {
            throw new Exception('Valor do CEP é inválido');
        }
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of cidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     */
    public function setCidade(string $cidade): self
    {
        $cidade = trim($cidade);
        $tamanhoValido = v::stringType()->length(2, 35)->validate($cidade);
        if (!$tamanhoValido) {
            throw new Exception('O tamanho do campo cidade é inválido');
        }
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     */
    public function setEstado($estado): self
    {
        $estado = trim($estado);
        $tamanhoValido = v::stringType()->length(2, 20)->validate($estado);
        if (!$tamanhoValido) {
            throw new Exception('O tamanho do campo estado social é inválido');
        }
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of rua
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * Set the value of rua
     */
    public function setRua(string $rua): self
    {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Get the value of bairro
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     */
    public function setBairro(string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of numero
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     */
    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of telefone1
     */
    public function getTelefone1()
    {

        return $this->telefone1;
    }

    /**
     * Set the value of telefone1
     */
    public function setTelefone1(string $telefone1): self
    {
        $telefone1 = trim($telefone1);
        $tamanhoValido = v::phone()->validate($telefone1);
        if (!$tamanhoValido) {
            throw new Exception('O tamanho do campo telefone 01 é inválido');
        }
        $this->telefone1 = $telefone1;

        return $this;
    }

    /**
     * Get the value of telefone2
     */
    public function getTelefone2()
    {
        return $this->telefone2;
    }

    /**
     * Set the value of telefone2
     */
    public function setTelefone2(string $telefone2): self
    {
        $telefone2 = trim($telefone2);
        $tamanhoValido = v::phone()->validate($telefone2);
        if (!$tamanhoValido) {
            throw new Exception('O tamanho do campo telefone 02 é inválido');
        }
        $this->telefone2 = $telefone2;

        return $this;
    }

    /**
     * Get the value of site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set the value of site
     */
    public function setSite($site): self
    {
        $site = trim($site);
        $this->site = $site;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $email = trim($email);
        $tamanhoValido = v::email()->validate($email);
        if (!$tamanhoValido) {
            throw new Exception('O tamanho do campo email é inválido');
        }
        $this->email = $email;

        return $this;
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
     * Get the value of cnpj
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set the value of cnpj
     */
    public function setCnpj(string $cnpj): self
    {
        $cnpj = trim($cnpj);
        $tamanhoValido = v::cnpj()->validate($cnpj);
        if (!$tamanhoValido) {
            throw new Exception('O tamanho do campo cnpj é inválido');
        }
        $this->cnpj = $cnpj;

        return $this;
    }
}
