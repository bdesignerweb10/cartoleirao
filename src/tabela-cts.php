<?php
	require_once('header.php');
?>
<main>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card card-table-cts" id="desempenho-liga">
				  <div class="card-header headline">
				    Tabela Liga Cartoleirão Trabalho Seguro - TS
				  </div>
				  <div class="card-body">
				  	<div class="table-responsive">
					    <table class="table table-hover table-cartoleirao">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Escudo</th>
						      <th scope="col">Clube <i class="fas fa-sort"></i></th>
						      <th scope="col">Pontos no Campeonato <i class="fas fa-sort"></i></th>
						      <th scope="col">Pontos na última rodada <i class="fas fa-sort"></i></th>	
						      <th scope="col">Variação <i class="fas fa-sort"></i></th>
						    </tr>
						  </thead>
						  <tbody>					    
						  </tbody>
						</table>
					</div><!--table-responsive-->						
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
				  			<span class="badge badge-warning"><i class="far fa-bookmark"></i></span> Meu Clube
				  		</li>
				  		<li class="nav-item">
				  			<span class="badge badge-primary"><i class="fas fa-award"></i></span> Maior pontuador em uma única rodada
				  		</li>
				  	</ul>
				  </div><!-- card-footer -->
				</div>
				<button type="button" class="btn btn-cartola" data-toggle="modal" data-target="#exampleModalScrollable">
				  Scouts do Cartola FC
				</button>
			</div>		
		</div>
	</div>
</main>

<!-- Modal Scouts do Cartola FC -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header modal-overview">
        <h5 class="modal-title" id="exampleModalLabel">Entenda os scouts do Cartola FC</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-jogos">		  
		  <tbody>
		    <tr>
		      <th scope="row">Ação</th>
		      <th scope="row">Pontos</th>		      
		    </tr>
		    <tr>
		      <th scope="row">Roubada de bola (RB)</th>
		      <td class="text-success">+ 1,5 pontos</td>		      
		    </tr>
		    <tr>
		      <th scope="row">Falta sofrida (FS)</th>
		      <td class="text-success">+ 0,5 ponto</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Finalização na trave (FT)</th>
		      <td class="text-success">+ 3,0 pontos</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Finalização defendida (FD)</th>
		      <td class="text-success">+ 1,2 pontos</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Finalização para fora (FF)</th>
		      <td class="text-success">+ 0,8 ponto</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Gol (G)</th>
		      <td class="text-success">+ 8 pontos</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Assistência (A)</th>
		      <td class="text-success">+ 5,0 pontos</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Falta cometida (FC)</th>
		      <td class="text-danger">- 0,5 ponto</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Gol contra (GC)</th>
		      <td class="text-danger">- 5,0 pontos</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Cartão amarelo (CA)</th>
		      <td class="text-danger">- 2,0 pontos</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Cartão vermelho (CV)</th>
		      <td class="text-danger">- 5,0 pontos</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Passe errado (PE)</th>
		      <td class="text-danger">- 0,3 ponto</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Impedimento (I)</th>
		      <td class="text-danger">- 0,5 ponto</td>	      
		    </tr>
		    <tr>
		      <th scope="row">Penalti perdido (PP)</th>
		      <td class="text-danger">- 4,0 pontos</td>	      
		    </tr>
		    <tr>				    	
				<th colspan="2" class="text-info">Pontuação exclusiva para goleiros, zagueiros e laterais</strong></th>
			</tr>
			<tr>
		      <th scope="row">Ação</th>
		      <th scope="row">Pontos</th>		      
		    </tr>
		    <tr>
		      <th scope="row">Jogo sem sofrer gol (SG)</th>
		      <td class="text-success">+ 5,0 pontos</td>		      
		    </tr>
		    <tr>				    	
				<th colspan="2" class="text-info">Pontuações exclusivas para goleiros</th>
			</tr>
			<tr>
		      <th scope="row">Ação</th>
		      <th scope="row">Pontos</th>		      
		    </tr>
		    <tr>
		      <th scope="row">Defesa difícil (DD)</th>
		      <td class="text-success">+ 3,0 pontos</td>		      
		    </tr>
		    <tr>
		      <th scope="row">Defesa de penalti (DP)</th>
		      <td class="text-success">+ 7,0 pontos</td>		      
		    </tr>
		    <tr>
		      <th scope="row">Gol sofrido (GS)</th>
		      <td class="text-danger">- 2,0 pontos</td>		      
		    </tr>
		  </tbody>
		</table>
      </div>
      <div class="modal-footer modal-btn">
        <button type="button" class="btn btn-exit" data-dismiss="modal">Fechar</button>       
      </div>
    </div>
  </div>
</div>
<?php
	require_once('footer.php');
?>