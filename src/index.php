<?php
	require_once('header.php');
?>
<main id="main-clube">
	<div class="container dashboard">
		<div class="row">
			<div class="col-sm-4">
				<div class="card">
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
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <th scope="row">1</th>
					      <td>Hasdrubal</td>
					      <td>1265.63</td>					      
					    </tr>
					    <tr>
					      <th scope="row">2</th>
					      <td>Boleanos</td>
					      <td>1263.69</td>					      
					    </tr>					    
					  </tbody>
					</table>
				    <a href="tabela-cts.php" class="btn btn-default btn-sm">Visualizar tabela completa</a>
				  </div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
				  <div class="card-header">
				    Copas <span>(Mata Mata)</span>
				  </div>
				  <div class="card-body">
				    <h6>Copa Kempes VI <span class="badge badge-success">Em andamento</span></h6>
				    <h6>Copa Segunda Pele III <span class="badge badge-success">Em andamento</span></h6>
				    <h6>Copa Beer II <span class="badge badge-warning">Aguardando Inicio</span></h6>
				    <h6>Copa Kempes Vii <span class="badge badge-warning">Aguardando Inicio</span></h6>
				    <h6>Copa Segunda Pele IV <span class="badge badge-danger">Encerrado</span></h6>		   
				    <a href="#" class="btn btn-default btn-sm">Acompanhar tods as copas</a>
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
				      				<img src="img/patrocinio/pp-ts.png" class="d-block w-100" alt="...">
				    			</div>
							    <div class="carousel-item">
							      <img src="img/patrocinio/rt-corretora.png" class="d-block w-100" alt="...">
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
				    <a href="#" class="btn btn-default btn-sm">Comparar Times</a>
				  </div>
				</div>
			</div>
			<div class="col-sm-8 ">
				<div class="card">
				  <div class="card-header">
				    Proximos jogos
				  </div>
				  <div class="card-body">
				  	<div id='calendar'></div>
					<div id='popover-content' style="display: none;"></div>
				  </div>
				</div>
			</div>
		</div><!-- row -->
	</div>
</main>
<?php
	require_once('footer.php');
?>