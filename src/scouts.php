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
							<input type="checkbox" id="salva_scout1" name="salva_scout1" data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger">
								Salvar time para consultar scouts
						</label>
					</div>					
      				<input type="text" class="form-control form-control-lgbusca-time" id="scout1" aria-describedby="scout1" placeholder="Informe o nome do Time">
    			</div><!-- col-sm-12-->
				<div class="col-sm-12 scout-club">
					<div class="card">
					  <img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_100/escudo/f3/44/10/00012b1938-2bb5-4c2c-88aa-cc023e770bf320180323114410" class="card-img-top" alt="nome_time">
					  <h5 class="headline">Hasdrubal FC</h5>
					  <p>Bruno Gomes</p>
					  <div class="divider"></div>					  
					  <div class="card-body">					  						  	
					  	<h5 class="headline">Pontuação <br /><span>103.69 pts</span></h5>	
					  	<h5 class="headline">Patrimônio <br /><span>C$ 159.63</span></h5>
					  </div>
					  <table class="table">					  
					  <tbody>
					    <tr>
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
					    </tr>
					  </tbody>
					</table>

					</div>					
				</div>
			</div>

			<div class="col-sm-4">
				<div class="col-sm-12">
					<div class="btn-scouts">
						<button type="button" class="btn active">Sim</button> Salvar time para consultar scouts
					</div>
      				<input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Informe o nome do Time">
    			</div>
			</div>

			<div class="col-sm-4">
				<div class="col-sm-12">
					<div class="btn-scouts">
						<button type="button" class="btn btn-danger">Não</button> Salvar time para consultar scouts
					</div>
      				<input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Informe o nome do Time">
    			</div>
			</div>
		</div><!-- row -->
	</div><!-- container -->
</main>
<?php
	require_once('footer.php');
?>