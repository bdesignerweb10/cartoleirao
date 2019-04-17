<?php 
	require_once('header.php'); 
?>
<main>
	<div class="container">
		<div class="card spacing">
			  <div class="card-header">
			    Gerenciamento de usuários			    
			  </div>
			  <div class="row btn-action">		
				  <div class="col-sm-8"></div>
				  <div class="col-sm-4">
				  	<button type="button" class="btn btns btn-lg btn-success"><i class="fas fa-plus"></i> Novo Usuário</button>
				  </div><!-- col-sm-4 -->	
			  </div><!-- row -->	  
			  <div class="card-body">
			    <table class="table tbl-users table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Usuário</th>
				      <th scope="col">Nome do Usuário</th>
				      <th scope="col">Nível</th>
				      <th scope="col">Status</th>
				      <th scope="col">Tentativas</th>
				      <th scope="col">Opções</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>brunonew17@gmail.com</td>
				      <td>Bruno Gomes da Silva</td>
				      <td>Administrador</td>
				      <td><i class="fas fa-check icon-ok"></i></td>
				      <td>1</td>
				      <td>
				      	<a href="#" title="Editar informações do usuário"><i class="fas fa-edit icon-edit"></i></a>
				      	<a href="" title="Resetar senha do úsuário" data-toggle="modal" data-target="#reset"><i class="fas fa-eraser icon-reset"></i></a>
				      	<a href="" title="Deletar o usuário" data-toggle="modal" data-target="#remove"><i class="fas fa-trash-alt icon-delete"></i></a>
				      </td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>phmpilz@gmail.com</td>
				      <td>Pedro Henrique Massa Pilz</td>
				      <td>Operador</td>
				      <td><i class="fas fa-times icon-disabled"></i></td>
				      <td>1</td>
				      <td>
				      	<a href="#" title="Editar informações do usuário"><i class="fas fa-edit icon-edit"></i></a>
				      	<a href="" title="Resetar senha do úsuário"><i class="fas fa-eraser icon-reset"></i></a>
				      	<a href="" title="Deletar o usuário"><i class="fas fa-trash-alt icon-delete"></i></a>
				      </td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>jpizzirani@gmail.com</td>
				      <td>João Augusto Pizzirani</td>
				      <td>Comum</td>
				      <td><i class="fas fa-times icon-disabled"></i></td>
				      <td>1</td>
				      <td>
				      	<a href="#" title="Editar informações do usuário"><i class="fas fa-edit icon-edit"></i></a>
				      	<a href="" title="Resetar senha do úsuário"><i class="fas fa-eraser icon-reset"></i></a>
				      	<a href="" title="Deletar o usuário"><i class="fas fa-trash-alt icon-delete"></i></a>
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

	<!-- Modal Reset de Senha -->
	<div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header modal-info">
	        <h5 class="modal-title" id="exampleModalLabel">Senha Resetada!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>A Senha foi resetada!</p>
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
				Gerenciamento de usuários			    
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
					      <label for="user-id">ID</label>
					      <input type="number" class="form-control" name="user-id" id="user-id" disabled>
					    </div>
					    <div class="form-group col-md-5">
					      <label for="name-cart">Nome do Cartoleiro</label>
					      <input type="text" class="form-control" name="name-cart" id="name-cart" placeholder="Informe o nome do Cartoleiro">
					    </div>
					    <div class="form-group col-md-6">
					      <label for="email-cart">E-mail Cartoleiro (Usuário)</label>
					      <input type="email" class="form-control" name="email-cart" id="email-cart" placeholder="Informe o e-mail do Cartoleiro">
					    </div>	
					    <div class="form-group col-md-2">
					      <label for="phone-cart">Telefone</label>
					      <input type="text" class="form-control" name="phone-cart" id="phone-cart" placeholder="Informe o telefone do Cartoleiro">
					    </div>				    
					    <div class="form-group col-md-3">
					      <label for="inputState">Nível de Acesso</label>
					      <select id="inputState" class="form-control">
					        <option selected>Selecione o tipo de acesso</option>
					        <option>Administrador</option>
					        <option>Comum</option>
					        <option>Operador</option>
					      </select>
					    </div>
					    <div class="form-group col-md-3">
					      <label for="password-cart">Senha</label>
					      <input type="password" class="form-control" name="password-cart" id="password-cart" placeholder="Informe a senha">
					    </div>
					    <div class="form-group col-md-2">
					      <label for="inputState">Usuário ativo?</label>
					      <select id="inputState" class="form-control">					        
					        <option class="text-success">Sim</option>
					        <option class="text-danger">Não</option>
					      </select>
					    </div>
						<div class="form-group col-md-2">
					      <label for="camp-nome"><span class="badge badge-success">Sim</span><!--<span class="badge badge-danger">Não</span>--></label>
					    </div>					    
			       	</div><!-- form-row -->

				</form>
				<div class="row btn-action-2">
					<div class="col-sm-8"></div>
					  	<div class="col-sm-4">
					  		<button type="submit" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#createuser"><i class="far fa-save"></i> Salvar usuário</button>
					  	</div>					  	
				  	</div>
				</div>			
		</div><!-- card -->		
	</div><!-- container -->

	<!-- Modal Criação do usuário via portal -->
	<div class="modal fade" id="createuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Usuário inserido com sucesso!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>O usuário foi inserido no sistema com sucesso, associe um clube para esse usuário no menu <strong>Usuários/Clubes</strong> - <strong>Gerenciar Clubes</strong></p>
	      </div>
	      <div class="modal-footer">
	      	<a href="ger-clubes.php"><button type="button" class="btn btn-primary">Associar clube ao usuário</button></a>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>	        
	      </div>
	    </div>
	  </div>
	</div>	
</main>
<?php 
	require_once('footer.php'); 
?>