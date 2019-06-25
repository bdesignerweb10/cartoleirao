<?php
	require_once('header.php');
?>
<main>
	<div class="container">
		<div class="row scouts">			
			<div class="col-sm-4">
				<div class="col-sm-12">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="salva_scout1" name="salva_scout1" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
								Salvar time para consultar scouts
						</label>
					</div>
    			</div><!-- col-sm-12-->
    			<input type="text" class="form-control form-control-lg busca-time" id="scout1" aria-describedby="scout1" placeholder="Informe o nome do Time">
				<div class="col-sm-12 scout-club">
					<div class="card">
					  <img src="" class="card-img-top img-scouts">
					  <h5 class="headline info-clube nome"></h5>
					  <!--<p>Bruno Gomes</p>-->
					  <div class="divider"></div>					  
					  <div class="card-body">					  						  	
					  	<h5 class="headline">Pontuação <br /><span class="dados-pont"></span></h5>	
					  	<h5 class="headline">Patrimônio <br /><span class="dados-patri"></span></h5>
					  </div>
					  <table class="table">					  
					  <tbody>
					    <!--<tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>G</td>
					      <td>Cassio</td>
					      <td class="text-success">15.63</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>L</td>
					      <td>Danilo Avelar</td>
					      <td class="text-success">15.63</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>Z</td>
					      <td>Manoel</td>
					      <td class="text-success">15.63</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>Z</td>
					      <td>Henrique</td>
					      <td class="text-danger">-3.63</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>L</td>
					      <td>Fagner</td>
					      <td class="text-success">15.63</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>M</td>
					      <td>Ralf</td>
					      <td class="text-success">15.63</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>M</td>
					      <td>Junior Urso</td>
					      <td class="text-dark">0.00</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>M</td>
					      <td>Sornoza</td>
					      <td class="text-success">15.63</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>A</td>
					      <td>Clayson</td>
					      <td class="text-success">15.63</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>A</td>
					      <td>Vagner Love <img src="img/capitan.png" style="width: 20px;"></td>
					      <td class="text-success"><strong>15.63</strong></td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>A</td>
					      <td>Gustavo</td>
					      <td class="text-success">15.63</td>
					    </tr>
					    <tr>
					      <td><img src="https://s.glbimg.com/es/sde/f/equipes/2018/03/10/corinthians.svg" width="30" height="30"></td>
					      <td>T</td>
					      <td>Fábio Carile</td>
					      <td class="text-success">15.63</td>
					    </tr>-->
					  </tbody>
					</table>
					</div>					
				</div>
			</div>

			<div class="col-sm-4">
				<div class="col-sm-12">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="salva_scout2" name="salva_scout2" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
							Salvar time para consultar scouts
						</label>
					</div>      				
    			</div>
    			<input type="text" class="form-control form-control-lg busca-time" id="scout2" aria-describedby="scout3" placeholder="Informe o nome do time">
			</div>

			<div class="col-sm-4">
				<div class="col-sm-12">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="salva_scout3" name="salva_scout3" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
							Salvar time para consultar scouts
						</label>
					</div>      				
    			</div>
    			<input type="text" class="form-control form-control-lg busca-time" id="scout3" aria-describedby="scout3" placeholder="Informe o nome do time">
			</div>
		</div><!-- row -->
	</div><!-- container -->
</main>
<?php
	require_once('footer.php');
?>