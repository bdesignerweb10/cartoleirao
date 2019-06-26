<?php 
	require_once('header.php'); 
?>
<main class="maintable">
	<div class="container">
		<div class="card spacing">
			  <div class="card-header">
			    Gerenciamento de Recados			    
			  </div>
			  <div class="row btn-action">		
				  <div class="col-sm-8"></div>
				  <div class="col-sm-4">
				  	<button type="button" class="btn btns btn-lg btn-success" id="btn-add-recados"><i class="fas fa-plus"></i> Novo Recado</button>
				  </div><!-- col-sm-4 -->	
			  </div><!-- row -->	  
			  <div class="card-body">
			    <table class="table tbl-users table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Título</th>
				      <th scope="col">Data</th>
				      <th scope="col">Ativo</th>				      
				      <th scope="col">Opções</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Jogo Corinthians x Santos</td>
				      <td>17/04/2019</td>				      
				      <td><i class="fas fa-check icon-ok"></i></td>				      
				      <td>
				      	<a href="#" title="Editar informações do recado"><i class="fas fa-edit icon-edit"></i></a>				      	
				      	<a href="" title="Deletar recado" data-toggle="modal" data-target="#remove"><i class="fas fa-trash-alt icon-delete"></i></a>
				      </td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Jogo São Paulo x Bahia</td>
				      <td>19/06/2019</td>				      
				      <td><i class="fas fa-times icon-disabled"></i></td>				      
				      <td>
				      	<a href="#" title="Editar informações do recado"><i class="fas fa-edit icon-edit"></i></a>				      	
				      	<a href="" title="Deletar recado"><i class="fas fa-trash-alt icon-delete"></i></a>
				      </td>
				    </tr>				    
				  </tbody>
				</table>
			</div>
		</div>
	</div><!-- container -->

	<!-- Modal Delete -->
	<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-danger">
	        <h5 class="modal-title" id="exampleModalLabel">Dados Excluidos!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Os dados foram excluidos com sucesso!</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>      
	      </div>
	    </div>
	  </div>
	</div>
</main>


<main class="mainform">
	<div class="container">
		<div class="card spacing">
			<div class="card-header">
				Gerenciamento de recados			    
			</div>
			<div class="row btn-action">		
				<div class="col-sm-8"></div>
				<div class="col-sm-4">
					<button type="button" class="btn btns btn-lg btn-secondary" id="btn-voltar-recados"><i class="fas fa-arrow-left"></i> Voltar</button>
				</div><!-- col-sm-4 -->	
			</div><!-- row -->	  
			<div class="card-body">
				<form>
					<div class="form-row">
					    <div class="form-group col-md-1">
					      <label for="message-id">ID</label>
					      <input type="number" class="form-control" name="message-id" id="message-id" disabled>
					    </div>
					    <div class="form-group col-md-4">
					      <label for="club-cart">Título do recado</label>
					      <input type="text" class="form-control" name="message-title" id="message-title" placeholder="Informe o titulo do recado">
					    </div>				    				    
					    					    
					    <div class="form-group col-md-2">
					      <label for="inputState">Recado ativo?</label>
					      <select id="inputState" class="form-control">					        
					        <option class="text-success">Sim</option>
					        <option class="text-danger">Não</option>
					      </select>
					    </div>
						<div class="form-group col-md-1">
					      <label for="camp-nome"><span class="badge badge-success">Sim</span><!--<span class="badge badge-danger">Não</span>--></label>
					    </div>				
					    <div class="form-group col-md-12">
						  <label for="message">Mensagem</label>
						  <textarea class="form-control" rows="5" id="message"></textarea>
						</div>    
			       	</div><!-- form-row -->
				</form>
				<div class="row btn-action-2">
					<div class="col-sm-8"></div>
					  	<div class="col-sm-4">
					  		<button type="submit" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#createclub"><i class="far fa-save"></i> Salvar Recado</button>
					  	</div>					  	
				  	</div>
				</div>			
		</div><!-- card -->		
	</div><!-- container -->

	<!-- Modal Criação do usuário via painel -->
	<div class="modal fade" id="createclub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Clube criado com sucesso!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>O Clube Hasdrubal FC foi criado e associado ao seu presidente com sucesso!</p>
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