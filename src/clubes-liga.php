<?php
	require_once('header.php');
?>
<main>
	<div class="container">
		<div class="row select-club">
			<div class="col-sm-8">
				<p>Selecione o clube que deseja conhecer a história</p>
			</div>
			<div class="col-sm-4" id="escudos-container">
				<select class="form-control escudos">
				  <!--<option>Boleanos FC</option>
				  <option>Hasdrubal FC</option>
				  <option>Palestrino 84 FC</option>
				  <option>Não jogo! dou aula!</option>-->
				</select>
			</div>
		</div>
		<div class="row club">			
			<div class="col-sm-4">
				<div class="card" style="width: 18rem;">
				  <img src="" class="card-img-top brasao" alt="...">
				  <div class="card-body">
				  	<h5 class="headline"><strong class="nome nome_time"></strong></h5>
				    <p class="card-text">Presidente: <span class="nome nome_presidente"></span><br />
				    Ano de fundação: <span class="nome ano_fundacao"></span></p>
				    <p>Último Titulo: <span>Copa Kempes - 2017</span></p>
				  </div>
				</div>
			</div><!-- col-sm-4-->
			<div class="col-sm-8">
				<div class="card club-info">
				  <div class="card-header">
				    História de <span class="nome nome_time"></span>
				  </div>
				  <div class="card-body" id="historia">
				    <blockquote class="blockquote mb-0">
				      <p class="text-hitoria"></p>
				      <footer class="blockquote-footer">Presidente do Clube: <cite title="Source Title" class="nome nome_presidente">Bruno Gomes</cite></footer>
				    </blockquote>
				  </div>
				</div>
			</div><!-- col-sm-8-->
			<div class="col-sm-4">
				<div class="card trophy-gallery" style="width: 18rem;">
				  <div class="card-body">
				    <h5 class="card-title">Galeria de Troféus</h5>				    
				    <p class="card-text"><i class="fas fa-trophy"></i> Copa Kempes 2017 <br />
				    <i class="fas fa-trophy"></i> Copa Beer 2016</p>				    
				  </div>
				</div>
			</div><!-- col-sm-4-->
			<div class="col-sm-8">
				<div class="card club-championships">
				  <div class="card-header">
				    Desempenho de <span class="nome nome_time"></span> em outras temporadas
				  </div>
				  <div class="card-body">
				    <blockquote class="blockquote mb-0">
				    	<button type="button" class="btn btn-performance">2015</button>		
				    	<button type="button" class="btn btn-performance">2016</button>	
				    	<button type="button" class="btn btn-performance">2017</button>	
				    	<button type="button" class="btn btn-performance">2018</button>				    	    
				    </blockquote>				    
				  </div>
				  <div class="card-seasons">
				    	<h5 class="headline">Temporada 2015</h5>
				    	<p><i class="fas fa-times disqualified"></i> Liga Cartoleirão Trabalho seguro - TS / <span>13º colocado</span></p>
				    	<p><i class="fas fa-times disqualified"></i> Copa Kempes</p>
				    	<p><i class="fas fa-times disqualified"></i> Copa Beer</p>
				    	<p><i class="fas fa-trophy champion"></i> Copa Segunda Pele</p>
				   </div>
				</div>
			</div><!-- col-sm-8-->
		</div><!-- row -- >
	</div><!-- container -->
</main>
<?php
	require_once('footer.php');
?>