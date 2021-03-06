<?php
	require_once('header.php');
?>
<main>
	<div class="container table-br">
		<div class="row">
			<div class="col-sm-8">
				<h5 class="headline">Tabela</h5>
				<div class="table-responsive">
					<table class="table table-hover">
					  <thead>
					    <tr>
					      <th>#</th>	
					      <th>Clube</th>
					      <th>P</th>
					      <th>J</th>
					      <th>V</th>
					      <th>E</th>
					      <th>D</th>
					      <th>GP</th>
					      <th>GC</th>
						  <th>SG</th>
						  <th>%</th>
					    </tr>
					  </thead>
					  <tbody class="tbl-pos-brasileiro">
					    <tr>
					      <th scope="row" class="media-parcial">1</th>				      
					    </tr>				    
					  </tbody>
					</table>
				</div><!-- table-responsive-->	
				<ul class="nav legend">
			  		<li class="nav-item">
			  			<span class="badge badge-primary"><i class="fas fa-square text-primary"></i></span> Libertadores
			  		</li>
			  		<li class="nav-item">
			  			<span class="badge badge-info"><i class="fas fa-square text-info"></i></span> Pré-Libertadores
			  		</li>
			  		<li class="nav-item">
			  			<span class="badge badge-success"><i class="fas fa-square text-success"></i></span> Sulamericana
			  		</li>
			  		<li class="nav-item">
			  			<span class="badge badge-danger"><i class="fas fa-square text-danger"></i></span> Rebaixados
			  		</li>
			  	</ul>
			</div>
			<div class="col-sm-4" id="confrontos-br">
				<h5 class="headline">Jogos</h5>
				<table class="table table-hover table-jogos">
				  <thead>
				    <tr>
				      <th><a class="voltar-rodada" href="#"><i class="fas fa-chevron-left"></i></a></th>
				      <th class="n-rodada">1º Rodada</th>
				      <th><a class="avancar-rodada" href="#"><i class="fas fa-chevron-right"></i></a></th>
				    </tr>
				  </thead>
				</table>				
			</div>
		</div><!-- row -->
	</div><!-- container -->
</main>
<?php
	require_once('footer.php');
?>