<?php
	require_once('header.php');
	$usu_qry = $conn->query("SELECT t.nome_presidente AS nome, t.email AS email, t.telefone AS telefone, u.usuario AS usuario, u.senha AS senha
						   FROM tbl_usuarios u
					  LEFT JOIN tbl_times t ON t.id = u.times_id
					      WHERE u.id = '" . $_SESSION["usu_id"] . "'") or trigger_error($conn->error);

	if ($usu_qry && $usu_qry->num_rows > 0) {
	    while($usuario = $usu_qry->fetch_object()) {
	        $usu_id = $usuario->id * $_SESSION["fake_id"];
			$usu_nome = $usuario->nome;
			$usu_email = $usuario->email;
			$usu_telefone = $usuario->telefone;
			$usu_usuario = $usuario->usuario;
			$usu_senha = $usuario->senha;
		}	
	}
?> <main><div class="container"><div class="row subscription"><div class="col-sm-8"><div class="card"><div class="card-body"><form class="needs-validation" id="form-meus-dados" data-toggle="validator" action="acts/acts.meus_dados.php" method="POST" novalidate><div class="form-row"><div class="col-md-6 mb-3"><label for="nome">Nome do Cartoleiro</label> <input type="text" class="form-control form-control-lg" name="nome" id="nome" placeholder="Informe seu nome" maxlength="120" value="<?php echo $usu_nome; ?>" required><div class="valid-feedback">Muito Bom!</div></div><div class="col-md-6 mb-3"><label for="telefone">Telefone</label> <input type="text" class="form-control form-control-lg" name="telefone" id="telefone" placeholder="Informe o telefone" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" data-mask-clearifnotmatch="true" maxlength="15" value="<?php echo $usu_telefone; ?>" required><div class="valid-feedback">Muito Bom!</div></div></div><div class="form-row"><div class="col-md-12 mb-3"><label for="email">E-mail</label> <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Informe seu e-mail" maxlength="120" value="<?php echo $usu_email; ?>" required><div class="valid-feedback">Muito Bom!</div></div><div class="col-md-6 mb-3"><label for="senha">Senha</label> <input type="password" class="form-control form-control-lg" name="senha" id="senha" placeholder="Informe sua senha" maxlength="120" value="<?php echo $usu_senha; ?>" required><div class="valid-feedback">Muito Bom!</div></div><div class="col-md-6 mb-3"><label for="senha2">Confirmação da Senha</label> <input type="password" class="form-control form-control-lg" id="senha2" name="senha2" placeholder="Informe sua senha novamente" maxlength="120" value="<?php echo $usu_senha; ?>" required><div class="valid-feedback">Muito Bom!</div></div></div><div class="form-row"><div class="col-md-12 mb-3 btn-subscription"><button class="btn btn-lg btn-cartola" id="btn-salvar-time" type="submit">Atualizar Dados</button></div></div></form></div></div></div><!-- col-sm-8 --><div class="col-sm-4"><div class="card bg-subscription"><div class="card-body"><h5 class="card-title">Atenção Cartoleiro!</h5><p class="card-text">Mantenha sempre seus dados atualizados!</p><p class="card-text">Serão essas as informações que utilizaremos para entrar em contato com você.</p><p class="card-text">Caso tenha alguma dúvida ou problemas, entre em contato:</p><p class="card-text">- (19) 99897-0090 (Bruno Gomes)<br>- contato@cartoleirao.com.br</p><p class="card-text">Equipe Cartoleirão - Trabalho Seguro TS</p></div></div></div></div><!-- row --></div><!-- container --></main><script>// Example starter JavaScript for disabling form submissions if there are invalid fields
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