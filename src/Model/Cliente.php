<?php
namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;
use Petshop\Core\Exception;
use Respect\Validation\Validator as v;

#[Entidade(name: 'clientes')]
class Cliente extends DAO
{
  #[Campo(label: 'Cód. Cliente', pk: true, nn: true, auto: true)]
  protected $idCliente;

  #[Campo(label: 'Tipo (PF/PJ)', nn: true)]
  protected $tipo;

  #[Campo(label: 'Documento', nn: true)]
  protected $cpfCnpj;

  #[Campo(label: 'Nome do cliente', nn: true, order:true)]
  protected $nome;

  #[Campo(label: 'E-mail do cliente', nn: true)]
  protected $email;

  #[Campo(label: 'Senha do cliente', nn: true)]
  protected $senha;

  #[Campo(label: 'Dt. Criação', nn: true, auto: true)]
  protected $created_at;

  #[Campo(label: 'Dt. Alteração', nn: true, auto: true)]
  protected $updated_at;


  public function getIdCliente()
  {
    return $this->idCliente;
  }

  public function getTipo()
  {
    return $this->tipo;
  }

  public function setTipo(string $tipo): self
  {
    $tipo = strtoupper(trim($tipo));
    if (!in_array($tipo, ['F', 'J'])) {
      throw new Exception('O tipo de pessoa não está definido corretamente (F/J)');
    }

    $this->tipo = $tipo;
    return $this;
  }

  public function getCpfCnpj()
  {
    return $this->cpfCnpj;
  }

  public function setCpfCnpj(string $cpfCnpj): self
  {
    if (!in_array($this->tipo, ['F', 'J'])) {
      throw new Exception('O tipo de pessoa (F/J)precisa ser definido antes do documento');
    }
    if ($this->tipo == 'F' ) {
      $docValido = v::cpf()->validate($cpfCnpj);
    } else {
      $docValido = v::cnpj()->validate($cpfCnpj);
    }
    
    if (!$docValido) {
      throw new Exception('Documento informado é inválido');
    }
    
    $this->cpfCnpj = $cpfCnpj;
    return $this;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome(string $nome): self
  {
    $this->nome = $nome;

    return $this;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $email = strtolower($email);

    $emailValido = v::email()->validate($email);
    if (!$emailValido) {
      throw new Exception('O e-mail informado é inválido');
    }
    $this->email = $email;
    return $this;
  }

  public function getSenha()
  {
    return $this->senha;
  }

  public function setSenha(string $senha): self
  {
    if (strlen($senha)<5) {
      throw new Exception('O comprimento da senha é inválido, digite ao menos 5 caracteres');
    }
    $hashdaSenha = hash_hmac('md5', $senha, SALT_SENHA);
    $senha = password_hash($hashdaSenha, PASSWORD_DEFAULT);
    $this->senha = $senha;
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
}