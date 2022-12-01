<div class="rodape-site py-4 mt-3">
  <div class="container">
    <div class="pgto-social row text-center">
      <div class="col-auto me-auto">
        <strong><i class="fa-regular fa-credit-card"></i> ACEITAMOS</strong>
        <div class="mt-2 pt-2 border-top border-dark">
          <i class="fa-brands fs-3 pe-2 fa-cc-visa "></i>
          <i class="fa-brands fs-3 pe-2 fa-cc-mastercard"></i>
          <i class="fa-brands fs-3 pe-2 fa-cc-apple-pay"></i>
          <i class="fa-brands fs-3 pe-2 fa-cc-amex"></i>
          <i class="fa-brands fs-3 pe-2 fa-pix"></i>
        </div>
      </div>
      <civ class="col-auto">
        <strong><i class="fa-solid fa-circle-nodes"></i> Siga nossas Redes</strong>
        <div class="mt-2 pt-2 border-top border-dark">
          <a href="#"><i class="fa-brands fs-3 pe-2 fa-facebook"></i></a>
          <a href="#"><i class="fa-brands fs-3 pe-2 fa-twitter"></i></i></a>
          <a href="#"><i class="fa-brands fs-3 pe-2 fa-instagram"></i></i></a>
          <a href="#"><i class="fa-brands fs-3 pe-2 fa-tiktok"></i></i></a>
          <a href="#"><i class="fa-brands fs-3 pe-2 fa-youtube"></i></i></a>

        </div>
      </civ>
    </div>
    <div class="info-matriz row mt-5 text-center">
      <div>
        <div>
          Preços e condições exclusivos para o <?= $site??'' ?> (exceto alimentos e bebidas), podendo sofrer alterações sem prévia notificação.
        </div>
        <div>
          <?= $nomefantasia??'' ?> |
          <?= $site??'' ?> |
          <?= $rua??'' ?>, <?= $bairro??'' ?>, Nrº <?= $numero??'' ?> |
          <?= $cidade??'' ?>, <?= $estado??'' ?> CEP: <?= $cep??'' ?> |
          CNPJ: <?= $cnpj??'' ?> |
          Telefone: <?= $telefone1??'' ?> - <?= $telefone2??'' ?> 
        </div>
        <div>
          Observação: Ao utilizar o copom de desconto, certifique-se que o mesmo esteja no período de validade.
        </div>
      </div>
    </div>
  </div>
</div>