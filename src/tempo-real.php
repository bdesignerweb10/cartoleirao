<?php
	require_once('header.php');
?>
<main id="maintable">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card card-table-cts" id="tempo-real">
				  <div class="card-header headline">
				    Tabela Liga Cartoleirão Trabalho Seguro - TS (Tempo Real)
				  </div>
				  <div class="card-body">
				    <table class="table table-hover table-cartoleirao liga-csc">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Escudo</th>
					      <th scope="col">Clube <i class="fas fa-sort"></i></th>
					      <th scope="col">Pontos na rodada <i class="fas fa-sort"></i></th>
					      <th scope="col">Total Parcial <i class="fas fa-sort"></i></th>
					      <th scope="col">Variação <i class="fas fa-sort"></i></th>
					    </tr>
					  </thead>
					  <tbody>					    					    
					  </tbody>
					</table>					
				  </div>
				  <div class="card-footer">
				  	<ul class="nav legend">
				  		<li class="nav-item">
				  			<span class="badge badge-success"><i class="fas fa-trophy"></i></span> Zona de Premiação
				  		</li>
				  		<li class="nav-item">
				  			<span class="badge badge-danger"><i class="fas fa-poop"></i></span> Zona de Rebaixamento
				  		</li>
				  		<li class="nav-item">
				  			<span class="badge badge-warning"><i class="far fa-bookmark"></i></span> Meu Clube
				  		</li>
				  		<li class="nav-item">
				  			<span class="badge badge-primary"><i class="fas fa-award"></i></span> Maior pontuador em uma única rodada
				  		</li>
				  	</ul>
				  </div>
				</div>
			</div>		
		</div>
	</div>
</main>
<main id="mainscout">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card card-table-cts">
					<div class="card-header headline">
			    		<div class="row">
							<div class="col-sm-4">
								<h2 class="headline">Sua escalação</h2>
							</div>
							<div class="col-sm-4">				
								<p class="headline">Esquema Tático: <span class="text-warning">4-3-3</span></p>
							</div>
							<div class="col-sm-4">
								<h2 class="headline">Pontuação Parcial: <span class="text-success parc-pont">132.38 pts</span></h2>
							</div>
						</div>
			  		</div>
			  		<div class="card-body">
					    <table class="table table-hover tbl-club">						  
						  <tbody>
						    <tr>
						      <td><img class="shield-club" src="https://s.glbimg.com/es/sde/f/equipes/2014/04/14/corinthians_60x60.png">
							  <br /> COR
						      </td>
						      <td>
						      	<div class="row">
									<div class="col-sm-2">
										<img src="https://s.glbimg.com/es/sde/f/2019/03/18/d5cd825ae9a3b7963ead1566162c7d54_140x140.png">
									</div>
									<div class="col-sm-3">
										<span>Fagner</span><br />Lateral
									</div>
									<div class="col-sm-5">
										<i class="far fa-futbol"></i>
						      			<i class="far fa-futbol"></i>
						      			<img class="shoes" src="img/assistencia.svg">	
						      			<img class="shoes" src="img/assistencia.svg">	
									</div>
								</div>								
						      </td>
						      <td></td>
						      <td><span class="text-success temp-pont">13.00</span></td>					      
						    </tr>					    
						    <tr>
						      <td><img class="shield-club" src="https://s.glbimg.com/es/sde/f/equipes/2014/04/14/corinthians_60x60.png">
							  <br /> COR
						      </td>
						      <td>
						      	<div class="row">
									<div class="col-sm-2">
										<img src="https://s.glbimg.com/es/sde/f/2019/03/18/d5cd825ae9a3b7963ead1566162c7d54_140x140.png">
									</div>
									<div class="col-sm-3">
										<span>Fagner</span><br />Lateral
									</div>
									<div class="col-sm-5">
										<i class="far fa-futbol"></i>						      				
									</div>
								</div>								
						      </td>
						      <td></td>
						      <td><span class="text-success temp-pont">13.00</span></td>					      
						    </tr>	
						    <tr>
						      <td><img class="shield-club" src="https://s.glbimg.com/es/sde/f/equipes/2014/04/14/corinthians_60x60.png">
							  <br /> COR
						      </td>
						      <td>
						      	<div class="row">
									<div class="col-sm-2">
										<img src="https://s.glbimg.com/es/sde/f/2019/03/18/d5cd825ae9a3b7963ead1566162c7d54_140x140.png">
									</div>
									<div class="col-sm-3">
										<span>Fagner</span><br />Lateral
									</div>
									<div class="col-sm-5">
											
									</div>
								</div>								
						      </td>
						      <td></td>
						      <td><span class="text-danger temp-pont">-5.63</span></td>					      
						    </tr>				    
						  </tbody>
						</table>					
			  		</div><!-- card-body -->
				</div>
			</div><!--colsm-12-->
		</div><!-- row-->			  
	</div><!-- container-->			
</main>
<?php
	require_once('footer.php');
?>