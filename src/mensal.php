<?php
	require_once('header.php');
?>
<main>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<form>
			  <div class="form-row">		    
			    <div class="form-group col-md-12">
			      <label for="inputState">Selecione o mês desejado</label>
			      <select id="inputState" class="form-control">
			        <option selected>Abril - Mês Atual</option>
			        <option>Maio</option>
			        <option>Junho</option>
			        <option>Julho</option>
			        <option>Agosto</option>
			      </select>
			    </div>
			  </div>
			</form>
			</div><!-- col-sm-12 -->
			<div class="col-sm-12">
				<div class="card card-table-cts">
				  <div class="card-header headline">
				    Tabela Liga Cartoleirão Trabalho Seguro - TS
				  </div>
				  <div class="card-body">
				    <table class="table table-hover table-cartoleira">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Clube <i class="fas fa-sort"></i></th>
					      <th scope="col">Pontos na última rodada <i class="fas fa-sort"></i></th>
					      <th scope="col">Pontos no Campeonato <i class="fas fa-sort"></i></th>
					      <th scope="col">Variação <i class="fas fa-sort"></i></th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <th scope="row" class="text-success">1</th>
					      <td>Hasdrubal FC</td>
					      <td>86.93</td>
					      <td>1569.63</td>
					      <td>+5</td>
					    </tr>
					    <tr>
					      <th scope="row" class="text-success">2</th>
					      <td>Hasdrubal FC</td>
					      <td>86.93</td>
					      <td>1569.63</td>
					      <td>+2</td>
					    </tr>
					    <tr>
					      <th scope="row" class="text-success">3 </th>
					      <td><i class="fas fa-award text-primary"></i> Hasdrubal FC</td>
					      <td>86.93</td>
					      <td>1569.63</td>
					      <td>-5</td>
					    </tr>
					    <tr>
					      <th scope="row" class="text-success">4</th>
					      <td>Hasdrubal FC</td>
					      <td>86.93</td>
					      <td>1569.63</td>
					      <td>-5</td>
					    </tr>
					    <tr>
					      <th scope="row" class="text-success">5</th>
					      <td>Hasdrubal FC</td>
					      <td>86.93</td>
					      <td>1569.63</td>
					      <td>-5</td>
					    </tr>
					    <tr class="badge-dark">
					      <th scope="row" class="text-success">6</th>
					      <td>Hasdrubal FC</td>
					      <td>86.93</td>
					      <td>1569.63</td>
					      <td>-5</td>
					    </tr>
					    <tr>
					      <th scope="row" class="text-danger">7</th>
					      <td>Hasdrubal FC</td>
					      <td>86.93</td>
					      <td>1569.63</td>
					      <td>-5</td>
					    </tr>
					    <tr>
					      <th scope="row" class="text-danger">8</th>
					      <td>Hasdrubal FC</td>
					      <td>86.93</td>
					      <td>1569.63</td>
					      <td>-5</td>
					    </tr>
					  </tbody>
					</table>					
				  </div><!-- card-body -->
				  <div class="card-footer">
				  	<ul class="nav legend">
				  		<li class="nav-item">
				  			<span class="badge badge-success"><i class="fas fa-trophy"></i></span> Zona de Premiação
				  		</li>
				  		<li class="nav-item">
				  			<span class="badge badge-danger"><i class="fas fa-poop"></i></span> Zona de Rebaixamento
				  		</li>
				  		<li class="nav-item">
				  			<span class="badge badge-dark"><i class="far fa-bookmark"></i></span> Meu Clube
				  		</li>
				  		<li class="nav-item">
				  			<span class="badge badge-primary"><i class="fas fa-award"></i></span> Maior pontuador em uma única rodada
				  		</li>
				  	</ul>
				  </div><!-- card-footer -->
				</div>
			</div>		
		</div>
	</div>
</main>
<?php
	require_once('footer.php');
?>