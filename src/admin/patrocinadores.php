<?php 
	require_once('header.php'); 
?>
<main>
	<div class="container">
		<div class="card spacing">
			  <div class="card-header">
			    Gerenciamento de Patrocinador			    
			  </div>
			  <div class="row btn-action">		
				  <div class="col-sm-8"></div>
				  <div class="col-sm-4">
				  	<button type="button" class="btn btns btn-lg btn-success"><i class="fas fa-plus"></i> Novo Patrocinador</button>
				  </div><!-- col-sm-4 -->	
			  </div><!-- row -->	  
			  <div class="card-body">
			    <table class="table tbl-users table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Empresa</th>
				      <th scope="col">Responsavél</th>
				      <th scope="col">Patrocina a:</th>
				      <th scope="col">Ativo</th>				      
				      <th scope="col">Opções</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Trabalho Seguro TS</td>
				      <td>Waner</td>				      
				      <td>liga Cartoleirão Trabalho Seguro - TS</td>
				      <td><i class="fas fa-check icon-ok"></i></td>				      
				      <td>
				      	<a href="#" title="Editar informações do patrocinador"><i class="fas fa-edit icon-edit"></i></a>				      	
				      	<a href="" title="Deletar Patrocinador" data-toggle="modal" data-target="#remove"><i class="fas fa-trash-alt icon-delete"></i></a>
				      </td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>RT Corretora de Seguros</td>
				      <td>Ricardo Sanchez</td>
				      <td>Copa Kempes VI</td>				      
				      <td><i class="fas fa-times icon-disabled"></i></td>				      
				      <td>
				      	<a href="#" title="Editar informações do patrocinador"><i class="fas fa-edit icon-edit"></i></a>				      	
				      	<a href="" title="Deletar Patrocinador"><i class="fas fa-trash-alt icon-delete"></i></a>
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


<main>
	<div class="container">
		<div class="card spacing">
			<div class="card-header">
				Gerenciamento de Patrocinador			    
			</div>
			<div class="row btn-action">		
				<div class="col-sm-8"></div>
				<div class="col-sm-4">
					<button type="button" class="btn btns btn-lg btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</button>
				</div><!-- col-sm-4 -->	
			</div><!-- row -->	  
			<div class="card-body">
				<form>
					<div class="form-row">
					    <div class="form-group col-md-1">
					      <label for="sponsor-id">ID</label>
					      <input type="number" class="form-control" name="sponsor-id" id="sponsor-id" disabled>
					    </div>
					    <div class="form-group col-md-6">
					      <label for="sponsor-name">Nome da Empresa</label>
					      <input type="text" class="form-control" name="sponsor-name" id="sponsor-name" placeholder="Informe o nome da empresa">
					    </div>	
					    <div class="form-group col-md-5">
					      <label for="president">Nome do Responsável</label>
					      <input type="text" class="form-control" name="president" id="president" placeholder="Informe o nome do responsável pela empresa">
					    </div>			    				    
					    					    
					    <div class="form-group col-md-2">
					      <label for="inputState">Empresa ativa?</label>
					      <select id="inputState" class="form-control">					        
					        <option class="text-success">Sim</option>
					        <option class="text-danger">Não</option>
					      </select>
					    </div>
						<div class="form-group col-md-1">
					      <label for="camp-nome"><span class="badge badge-success">Sim</span><!--<span class="badge badge-danger">Não</span>--></label>
					    </div>				
					    <div class="form-group col-md-4">
					      <label for="inputState">Patrocina a Liga:</label>
					      <select id="inputState" class="form-control">					        
					        <option>Cartoleirão Trabalho Seguro - TS</option>
					        <option>Copa Kempes VI</option>
					      </select>
					    </div>						   
			       	</div><!-- form-row -->
				</form>
				<div class="row btn-action-2">
					<div class="col-sm-8"></div>
					  	<div class="col-sm-4">
					  		<button type="submit" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#createclub"><i class="far fa-save"></i> Salvar Patrocinador</button>
					  	</div>					  	
				  	</div>
				</div>			
		</div><!-- card -->		
	</div><!-- container -->

	<!-- Modal Salvar Patrocinador -->
	<div class="modal fade" id="createclub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Patrocinador inserido com sucesso!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>O Novo Patrocinador foi inserido e associado ao campeonato que ele patrocina.</p>
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