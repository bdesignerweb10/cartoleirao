<?php
	require_once('header.php');
?> <main><div class="container"><div class="row subscription"><div class="col-sm-8"><div class="card"><div class="card-body"><form class="needs-validation" novalidate><div class="form-row"><div class="col-md-6 mb-3"><label for="clube">Nome do Time</label> <input type="text" class="form-control form-control-lg" name="clube" id="clube" placeholder="Informe o nome do time" required><div class="valid-feedback">Muito Bom!</div></div><div class="col-md-6 mb-3"><label for="nome">Nome do Cartoleiro</label> <input type="text" class="form-control form-control-lg" name="nome" id="nome" placeholder="Informe o seu nome" required><div class="valid-feedback">Muito Bom!</div></div></div><div class="form-row"><div class="col-md-8 mb-3"><label for="email">E-mail</label> <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Informe seu e-mail" required><div class="valid-feedback">Muito Bom!</div></div><div class="col-md-4 mb-3"><label for="telefone">Telefone</label> <input type="text" class="form-control form-control-lg" name="telefone" id="telefone" placeholder="Informe o telefone" required><div class="valid-feedback">Muito Bom!</div></div></div><p>O valor da inscrição é de <strong>R$50,00</strong> (Cinquenta reais)</p><div class="form-group"><div class="form-check"><input class="form-check-input" type="checkbox" value="" id="invalidCheck" required> <label class="form-check-label" for="invalidCheck">Eu declaro que li e aceito o <a href="regulamentos.php"><span>regulamento</span></a> da Liga Cartoleirão - Trabalho Seguro TS e das ligas Mata Mata</label><div class="invalid-feedback">Aceite os termos antes de se inscrever!</div></div></div><div class="form-row"><div class="col-md-12 mb-3 btn-subscription"><button class="btn btn-lg btn-cartola" type="submit">Realizar Inscrição</button></div></div></form></div></div></div><!-- col-sm-8 --><div class="col-sm-4"><div class="card bg-subscription"><div class="card-body"><h5 class="card-title">Olá Cartoleiro!</h5><p class="card-text">Seja bem-vindo a Liga Cartoleirão - Trabalho Seguro TS.</p><p class="card-text">Após realizar sua inscrição é necessário realizar o pagamento com o tesoureiro da Liga (Bruno Gomes) para que sua inscrição seja efetivada.</p><p class="card-text">Formas de Pagamento:</p><p class="card-text">- Em mãos, com o tesoureiro<br>- Transferência Bancária<br>- PicPay</p><p class="card-text">Já leu o nosso regulamento?</p><p class="card-text"><a href="regulamentos.php">Acesse o Regulamento e leia todas as regras para não ficar com dúvidas!</a></p><p class="card-text">Críticas ou sugestões, entre em contato:</p><p class="card-text">- (19) 99897-0090<br>- contato@cartoleirao.com.br</p><p class="card-text">Desejamos a todos um bom divertimento.</p><p class="card-text">Equipe Cartoleirão - Trabalho Seguro TS</p></div></div></div></div><!-- row --></div><!-- container --></main><script>// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();</script> <?php
	require_once('footer.php');
?>