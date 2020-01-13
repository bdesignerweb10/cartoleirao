<?php
	require_once('header.php');
?>
<main>
	<div class="container">
		<div class="row">	
			<div class="col-sm-4 copas" id="mata-mata">
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
				    <p class="card-text">Copa Aguardando Inicio</p>
				    <a href="#" class="btn btn-info disabled">Aguarde o ínicio</a>
				  </div>
				</div>
			</div><!-- col-sm-4-->

			<div class="col-sm-4 copas">
				<div class="card default">
				  <div class="card-body">
				    <h5 class="card-title">Copa Beer II</h5>				    
				    <p class="card-text">Copa Aguardando Inicio</p>
				    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#participarcopa">Desejo Participar</a>	
				    <p><span class="badge badge-warning">15 Times pagos</span>
				    <span class="badge badge-info">Premiação</span></p>			    
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
        <h5 class="modal-title" id="exampleModalLabel">Pré Inscrição Realizada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Olá nome_presidente você acaba de inserir o seu time nome_time na nome_da_copa.</p>
        <p>Efetue o pagamenrto de R$10,00 para confirmar a sua participação!</p>
        <div class="row">
	        <div class="col-sm-6">
	        	Itau
	        </div>
	        <div class="col-sm-6">
	        	PicPay
	        </div>
	    </div><!-- row -->    
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