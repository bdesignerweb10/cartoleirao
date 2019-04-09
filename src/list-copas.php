<?php
	require_once('header.php');
?>
<main>
	<div class="container">
		<div class="row">	
			<div class="col-sm-4 copas">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Copa Kempes VI</h5>
				    <p class="card-text">Copa em andamento</p>
				    <a href="copas.php" class="btn btn-success">Acompanhar Copa</a>
				  </div>
				</div>
			</div><!-- col-sm-4-->
			<div class="col-sm-4 copas">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Segunda Pele III</h5>
				    <p class="card-text">Copa em andamento</p>
				    <a href="#" class="btn btn-success">Acompanhar Copa</a>
				  </div>
				</div>
			</div><!-- col-sm-4-->

			<div class="col-sm-4 copas">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Copa Beer II</h5>
				    <p class="card-text">Previsão de inicio: <span>15º rodada</span></p>
				    <a href="#" class="btn btn-info disabled">Aguarde o ínicio</a>
				  </div>
				</div>
			</div><!-- col-sm-4-->

			<div class="col-sm-4 copas">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Copa Beer II</h5>
				    <p class="card-text">Previsão de inicio: <span>15º rodada</span></p>
				    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#participarcopa">Desejo Participar</a>
				  </div>
				</div>
			</div><!-- col-sm-4-->

			<div class="col-sm-4 copas">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">Copa Kempes VI</h5>
				    <p class="card-text">Copa encerrada</p>
				    <a href="#" class="btn btn-danger">Ver como foi</a>
				  </div>
				</div>
			</div><!-- col-sm-4-->
		</div><!-- row -->
	</div><!-- container -->
</main>

<!-- Modal participar copa -->
<div class="modal fade" id="participarcopa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-overview">
        <h5 class="modal-title" id="exampleModalLabel">Obrigado por se inscrever na copa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Agora falta pouco para você garantir de vez a sua participação, efetue o pagamento e vá em busca da glória!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>        
      </div>
    </div>
  </div>
</div>
<?php
	require_once('footer.php');
?>