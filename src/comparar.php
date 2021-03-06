<?php
	require_once('header.php');
?>
<main>
	<div class="container">
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-6 compare">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="salva_comparacao1" name="salva_comparacao1" data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger">
								Salvar time para consultar comparação
					</label>
				</div>					
      			<input type="text" class="form-control form-control-lg busca-time" id="comparacao1" aria-describedby="comparacao1" placeholder="Informe o nome do Time">
			</div><!-- col-sm-6 -->
			<div class="col-sm-6">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="salva_comparacao2" name="salva_comparacao2" data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger">
								Salvar time para consultar comparação
					</label>
				</div>				
      			<input type="text" class="form-control form-control-lg busca-time" id="comparacao2" aria-describedby="comparacao2" placeholder="Informe o nome do Time">
			</div><!-- col-sm-6 -->			
			<div class="col-sm-12">
				<table class="table table-cartoleirao to-compare table-medias table-estatisticas">
				  <thead>
				    <tr>
				      <th scope="col" class="dados_time1 shield-club"></th>
				      <th><span>X</span></th>				      
				      <!--<th scope="col"><img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_100/escudo/f3/44/10/00012b1938-2bb5-4c2c-88aa-cc023e770bf320180323114410" width="30"><span>X</span><img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_100/escudo/61/37/30/0066ff5ea7-d108-46b4-a302-61221738186120180322123730" width="30"></th>-->
				      <th scope="col" class="dados_time2 shield-club"></th>				      
				    </tr>
				  </thead>
				  <tbody>
				  	<tr>				      
				      <td class="posicao_time1"></td>
				      <th>Posição</th>
				      <td class="posicao_time2"></td>
				    </tr>
				    <tr>				      
				      <td class="pontos_time1"></td>
				      <th>Pontos</th>
				      <td class="pontos_time2"></td>
				    </tr>
				    <tr>
				      <td class="media_time1"></td>
				      <th>Média de Pontos</th>
				      <td class="media_time2"></td>
				    </tr>
				    <tr>
				      <td class="patrimonio_time1"></td>
				      <th>Patrimônio</th>
				      <td class="patrimonio_time2"></td>
				    </tr>
				    <tr>
				      <td class="maior_time1"></td>
				      <th>Maior Pontuação</th>
				      <td class="maior_time2"></td>
				    </tr>
				    <tr>
				      <td class="menor_time1"></td>
				      <th>Menor Pontuação</th>
				      <td class="menor_time2"></td>
				    </tr>
				    <tr>
				      <td class="ultima_time1"></td>
				      <th>Última Pontuação</th>
				      <td class="ultima_time2"></td>
				    </tr>
				    <tr class="table-sub">
				      <th scope="col"></th>	
				      <th scope="col">Média de pontos por posição</th>	
				      <th scope="col"></th>				      				      
				    </tr>
				    <tr>
				      <td class="med_g_time1"></td>
				      <th>Goleiro</th>
				      <td class="med_g_time2"></td>
				    </tr>
				    <tr>
				      <td class="med_l_time1"></td>
				      <th>Lateral</th>
				      <td class="med_l_time2"></td>
				    </tr>
				    <tr>
				      <td class="med_z_time1"></td>
				      <th>Zagueiro</th>
				      <td class="med_z_time2"></td>
				    </tr>
				    <tr>
				      <td class="med_m_time1"></td>
				      <th>Meia</th>
				      <td class="med_m_time2"></td>
				    </tr>
				    <tr>
				      <td class="med_a_time1"></td>
				      <th>Atacante</th>
				      <td class="med_a_time2"></td>
				    </tr>
				    <tr>
				      <td class="med_t_time1"></td>
				      <th>Técnico</th>
				      <td class="med_t_time2"></td>
				    </tr>
				  </tbody>
				</table>
			</div><!-- col-sm-12
		</div><!-- row -->
	</div><!-- container -->
</main>
<?php
	require_once('footer.php');
?>
