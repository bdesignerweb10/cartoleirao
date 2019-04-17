<?php 
	require_once('header.php'); 
?>
<main>
	<div class="container">
		<div class="card spacing">
			  <div class="card-header">
			    Gerenciamento de clubes			    
			  </div>
			  <div class="row btn-action">		
				  <div class="col-sm-8"></div>
				  <div class="col-sm-4">
				  	<button type="button" class="btn btns btn-lg btn-success"><i class="fas fa-plus"></i> Novo Clube</button>
				  </div><!-- col-sm-4 -->	
			  </div><!-- row -->	  
			  <div class="card-body">
			    <table class="table tbl-users table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Brasão</th>
				      <th scope="col">Clube</th>
				      <th scope="col">Presidente</th>				      
				      <th scope="col">Status</th>
				      <th scope="col">Temporadas</th>
				      <th scope="col">Opções</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td><img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_100/escudo/f3/44/10/00012b1938-2bb5-4c2c-88aa-cc023e770bf320180323114410" width="30"></td>
				      <td>Hasdrubal FC</td>
				      <td>Bruno Gomes da Silva</td>				      
				      <td><i class="fas fa-check icon-ok"></i></td>
				      <td>5</td>
				      <td>
				      	<a href="#" title="Alterar informações do clube"><i class="fas fa-edit icon-edit"></i></a>
				      	<a href="" title="Desabilitar clube" data-toggle="modal" data-target="#disabled"><i class="fas fa-minus-circle icon-delete"></i></a>			      	
				      </td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td><img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_100/escudo/f3/44/10/00012b1938-2bb5-4c2c-88aa-cc023e770bf320180323114410" width="30"></td>
				      <td>Hasdrubal FC</td>
				      <td>Bruno Gomes da Silva</td>				      
				      <td><i class="fas fa-check icon-ok"></i></td>
				      <td>5</td>
				      <td>
				      	<a href="#" title="Alterar informações do clube"><i class="fas fa-edit icon-edit"></i></a>
				      	<a href="" title="Desabilitar clube"><i class="fas fa-minus-circle icon-delete"></i></a>
				      </td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td><img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_100/escudo/f3/44/10/00012b1938-2bb5-4c2c-88aa-cc023e770bf320180323114410" width="30"></td>
				      <td>Hasdrubal FC</td>
				      <td>Bruno Gomes da Silva</td>				      
				      <td><i class="fas fa-check icon-ok"></i></td>
				      <td>5</td>
				      <td>
				      	<a href="#" title="Alterar informações do clube"><i class="fas fa-edit icon-edit"></i></a>
				      	<a href="" title="Desabilitar clube"><i class="fas fa-minus-circle icon-delete"></i></a>	
				      </td>
				    </tr>
				  </tbody>
				</table>
			</div>
		</div>
	</div><!-- container -->

	<!-- Modal Desabilitar Clube -->
	<div class="modal fade" id="disabled" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-disabled">
	        <h5 class="modal-title" id="exampleModalLabel">O Clube foi desabilitado</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>O Clube Hasdrubal FC foi desabilitado, você pode habilitar o clube novamente, há qualquer momento</p>
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
				Gerenciamento de clubes			    
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
					      <label for="club-id">ID</label>
					      <input type="number" class="form-control" name="club-id" id="club-id" disabled>
					    </div>
					    <div class="form-group col-md-4">
					      <label for="club-cart">Nome do Clube (Mesmo do Cartola FC)</label>
					      <input type="text" class="form-control" name="club-cart" id="club-cart" placeholder="Informe o nome do Clube do Cartola FC">
					    </div>					    				    
					    <div class="form-group col-md-4">
					      <label for="inputState">Presidente do Clube</label>
					      <select id="inputState" class="form-control">
					        <option selected>Selecione o presidente do clube</option>
					        <option>Bruno Gomes da Silva</option>
					        <option>Pedro Pilz</option>
					        <option>João Pizzirani</option>
					      </select>
					    </div>					    
					    <div class="form-group col-md-2">
					      <label for="inputState">Clube ativo?</label>
					      <select id="inputState" class="form-control">					        
					        <option class="text-success">Sim</option>
					        <option class="text-danger">Não</option>
					      </select>
					    </div>
						<div class="form-group col-md-1">
					      <label for="camp-nome"><span class="badge badge-success">Sim</span><!--<span class="badge badge-danger">Não</span>--></label>
					    </div>				
					    <div class="form-group col-md-12">
						  <label for="comment">História do Clube</label>
						  <textarea class="form-control" rows="5" id="comment"></textarea>
						</div>    
			       	</div><!-- form-row -->
				</form>
				<div class="row btn-action-2">
					<div class="col-sm-8"></div>
					  	<div class="col-sm-4">
					  		<button type="submit" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#createclub"><i class="far fa-save"></i> Salvar Clube</button>
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