<?php
	require_once('header.php');
?>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="js/modernizr.custom.js"></script>
<main>
	<div class="container dashboard">
		<div class="row">
			<div class="col-sm-4">
				<div class="card default" id="desempenho-geral">
				  <div class="card-header">
				    Tabela Cartoleirão Trabalho Seguro - TS
				  </div>
				  <div class="card-body">
				    <table class="table table-borderless table-cts">
					  <thead>
					    <tr>
					      <th scope="col">#</th>					      
					      <th scope="col">Time</th>
					      <th scope="col">Pontos</th>
					      <th scope="col">Variação</th>					      
					    </tr>
					  </thead>
					  <tbody>					    					    
					  </tbody>
					</table>
				    <a href="tabela-cts.php" class="btn btn-default btn-sm">Visualizar tabela completa</a>
				  </div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card default">
				  <div class="card-header">
				    Copas <span>(Mata Mata)</span>
				  </div>
				  <div class="card-body">
				    <h6>Copa Kempes VI <span class="badge badge-success">Em andamento</span></h6>
				    <h6>Copa Segunda Pele III <span class="badge badge-success">Em andamento</span></h6>
				    <h6>Copa Beer II <span class="badge badge-warning">Aguardando Inicio</span></h6>
				    <h6>Copa Kempes Vii <span class="badge badge-warning">Aguardando Inicio</span></h6>
				    <h6>Copa Segunda Pele IV <span class="badge badge-danger">Encerrado</span></h6>		   
				    <a href="list-copas.php" class="btn btn-default btn-sm">Acompanhar todas as copas</a>
				  </div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header">
				    	Patrocinadores
				  	</div>
				  	<div class="card-body">
				    	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				  			<div class="carousel-inner">
				    			<div class="carousel-item active">
				      				<a href="https://www.trabalhosegurots.com.br/" target="_blank"><img src="img/patrocinio/pp-ts.png" class="d-block w-100" alt="Trabalho Seguro Treinamentos e Serviços"></a>
				    			</div>
							    <div class="carousel-item">
							      <a href="#" target="_blank"><img src="img/patrocinio/rt-corretora.png" class="d-block w-100" alt="RT Corretora de Seguros"></a>
							    </div>					    
				  			</div>
				  			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    		<span class="sr-only">Previous</span>
				  			</a>
				  			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
							    <span class="carousel-control-next-icon" aria-hidden="true"></span>
							    <span class="sr-only">Next</span>
				  			</a>
						</div>				   
				  	</div>
				</div>
			</div>			
		</div><!-- row -->
		<div class="row">
			<div class="col-sm-4 to-compare">
				<div class="card">
				  <div class="card-header">
				    Campare seu time com um adversário
				  </div>
				  <div class="card-body">
				    <img src="img/comparartimes.png">
				    <a href="comparar.php" class="btn btn-default btn-sm">Comparar Times</a>
				  </div>
				</div>
				<div class="card to-compare">
					<div class="card-header">
						Minhas Competições					
					</div><!-- card-header -->
					<div class="card-body">
						<span class="my-competition">Liga Cartoleirão - Trabalho Seguro TS</span>
						<div class="progress">
						  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<span class="my-competition">Copa Kempes</span>
						<div class="progress">
						  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<span class="my-competition">Copa Segunda Pele</span>
						<div class="progress">
						  <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<a href="" class="btn btn-default btn-sm">Ver todos os torneios</a>
					</div><!-- card-body-->							
				</div><!-- card -->
			</div>
			<div class="col-sm-8 to-compare">
				<div id="eventos" class="card">
				  <div class="card-header">
				    Proximos jogos
				  </div>
				  <div class="card-body">
				  	<div id="calendar"></div>
					<div id="popover-content" style="display: none;"></div>
				  </div>
				</div>
			</div>
		</div><!-- row -->
	</div>
</main>

<!-- modal resumo da rodada -->
<?php if ($_SESSION["mercado"] == "1") : ?>
<div class="modal" id="modal-info" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-overview">
        <h5 class="modal-title">Resumo da 9º Rodada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-sm-6 modal-best">
	        	<h5 class="headline">Maior Pontuador</h5>
	        	<div class="col-sm-12 best">
	        		<img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_100/escudo/f3/44/10/00012b1938-2bb5-4c2c-88aa-cc023e770bf320180323114410" alt="">
	        		<p class="text-success">Hasdrubal FC <br />
	        		<span class="modal-pts">115.69</span> <span class="pts">pts</span></p>	        		
	        	</div>	        	
	        </div><!-- col-sm-6 -->
	        <div class="col-sm-6 modal-best">
	        	<h5 class="headline">Menor Pontuador</h5>
	        	<div class="col-sm-12 best">
	        		<img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_100/escudo/f3/44/10/00012b1938-2bb5-4c2c-88aa-cc023e770bf320180323114410" alt="">
	        		<p class="text-danger">Hasdrubal FC <br />
	        		<span class="modal-pts">15.69</span> <span class="pts">pts</span></p>	        		
	        	</div>	        	
	        </div><!-- col-sm-6 -->
        </div>
        <hr>
        <div class="row">
        	<div class="col-sm-6 modal-best">
	        	<h5 class="headline">Melhor Jogadro</h5>
	        	<div class="col-sm-12 best">
	        		<img src="https://s.glbimg.com/es/sde/f/2018/03/20/c125fa08820e1bbf4a2640e7108b05d2_80x80.png" alt="">
	        		<p class="text-success">Rodriguinho <br />
	        		<span class="modal-pts">35.69</span> <span class="pts">pts</span></p>	        		
	        	</div>	        	
	        </div><!-- col-sm-6 -->
	        <div class="col-sm-6 modal-best">
	        	<h5 class="headline">Pior Jogador</h5>
	        	<div class="col-sm-12 best">
	        		<img src="https://s.glbimg.com/es/sde/f/2018/06/26/a77b90cda4d9d26c34f44befcf3a4f6d_80x80.png" alt="">
	        		<p class="text-danger">Danilo Avelar <br />
	        		<span class="modal-pts">-5.69</span> <span class="pts">pts</span></p>	        		
	        	</div>	        	
	        </div><!-- col-sm-6 -->
        </div>
      </div>
      <div class="modal-footer">
      	<div class="row sponsorship">
      		<div class="col-sm-3">
      			<img src="img/patrocinio/logo-ts.png" alt="">
      		</div>
      		<div class="col-sm-9">
      			<h5 class="headline">Trabalho Seguro Treinamentos e Serviços</h5>
      			<p>Waner Luis Gomide <br />
      			(19) 99888-51741 / (19) 4101-0288 <br />
      			<a href="http://www.trabalhosegurots.com.br" target="_blank" class="modal-pts">www.trabalhosegurots.com.br</a></p>
      		</div>
      		<div class="col-sm-12 modal-btn">
      			<button type="button" class="btn btn-exit" data-dismiss="modal">Fechar</button> 
      		</div>
      	</div><!-- row -->               
      </div>
    </div>
  </div>
</div>
<?php endif; ?>		 
<?php
	require_once('footer.php');
?>
