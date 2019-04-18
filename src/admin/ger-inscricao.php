<?php 
	require_once('header.php'); 
?>
<main>
	<div class="container">
		<div class="card spacing">
			  <div class="card-header">
			    Gerenciamento de Inscrição da liga - Nome da Liga -			    
			  </div>
			  <div class="row btn-action">		
				  <!--<div class="col-sm-7"></div>
				  <div class="col-sm-5">
				  	<button type="button" class="btn btns btn-lg btn-success"><i class="fas fa-plus"></i> Adicionar Clube no Campeonato</button>
				  </div><!-- col-sm-4 -->	
			  </div><!-- row -->	  
			  <div class="card-body">
			    <table class="table tbl-users table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Clube</th>
				      <th scope="col">Presidente</th>
				      <th scope="col">Status</th>
				      <th scope="col">Financeiro</th>				      
				      <th scope="col">Opções</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Hasdrubal FC</td>
				      <td>Bruno Gomes da Silva</td>
				      <td><i class="fas fa-check icon-ok"></i></td>
				      <td>OK</td>				      
				      <td>
				      	<a href="#" title="Ativar Clube, sem pagamento" data-toggle="modal" data-target="#ativasempag"><i class="fab fa-creative-commons-nc icon-warning"></i></a>				      	
				      	<a href="" title="Ativar clube, e confirmar pagamento" data-toggle="modal" data-target="#ativacompag"><i class="far fa-money-bill-alt icon-ok"></i></a>
				      	<a href="" title="Desativar clube do campeonato" data-toggle="modal" data-target="#disabled"><i class="fas fa-ban icon-disabled"></i></a>
				      </td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Boleanos</td>
				      <td>Pedro Pilz</td>
				      <td><i class="fas fa-times icon-disabled"></i></td>
				      <td>Pendente</td>
				      <td>
				      	<a href="#" title="Ativar Clube, sem pagamento" data-toggle="modal" data-target="#ativasempag"><i class="fab fa-creative-commons-nc icon-warning"></i></a>				      	
				      	<a href="" title="Ativar clube, e confirmar pagamento" data-toggle="modal" data-target="#ativacompag"><i class="far fa-money-bill-alt icon-ok"></i></a>
				      	<a href="" title="Desativar clube do campeonato" data-toggle="modal" data-target="#disabled"><i class="fas fa-ban icon-disabled"></i></a>
				      </td>
				    </tr>	
				    <tr>
				      <th scope="row">3</th>
				      <td>Palestrino 84 FC</td>
				      <td>João Pizzirani</td>
				      <td><i class="fas fa-check icon-warning"></i></td>
				      <td>Pendente</td>
				      <td>
				      	<a href="#" title="Ativar Clube, sem pagamento" data-toggle="modal" data-target="#ativasempag"><i class="fab fa-creative-commons-nc icon-warning"></i></a>				      	
				      	<a href="" title="Ativar clube, e confirmar pagamento" data-toggle="modal" data-target="#ativacompag"><i class="far fa-money-bill-alt icon-ok"></i></a>
				      	<a href="" title="Desativar clube do campeonato" data-toggle="modal" data-target="#disabled"><i class="fas fa-ban icon-disabled"></i></a>
				      </td>
				    </tr>			    
				  </tbody>
				</table>
				<div class="col-sm-12 legend">
					<p><i class="fas fa-check icon-ok"></i> Clube Ativo e Pagamento Confirmado</p>
					<p><i class="fas fa-check icon-warning"></i> Clube Ativo e Aguardando Pagamento</p>
					<p><i class="fas fa-times icon-disabled"></i> Clube desativado</p>
				</div>
			</div>
		</div>
	</div><!-- container -->

	<!-- Modal Ativa time, pagamento pendente -->
	<div class="modal fade" id="ativasempag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-warning">
	        <h5 class="modal-title" id="exampleModalLabel">Clube Ativado, Pagamento Pendente</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>O Clube {Nome do clube} foi ativado, mas não efetuou o pagamento.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>      
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Ativa time, pagamento confirmado -->
	<div class="modal fade" id="ativacompag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Clube Ativado, Pagamento Confirmado</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>O Clube {Nome do clube} foi ativado, e o pagamento foi confirmado.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>      
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Desativa Clube do Campeonato -->
	<div class="modal fade" id="disabled" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-danger">
	        <h5 class="modal-title" id="exampleModalLabel">Clube foi desativado</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>O Clube {Nome do clube} foi desativado e não participará do campeonato.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>      
	      </div>
	    </div>
	  </div>
	</div>
</main>
<?php 
	require_once('footer.php'); 
?>