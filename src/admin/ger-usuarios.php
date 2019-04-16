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
				      	<a href="" title="Resetar senha do úsuário"><i class="fas fa-eraser icon-reset"></i></a>
				      	<a href="" title="Deletar o usuário"><i class="fas fa-trash-alt icon-delete"></i></a>
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
</main>
<?php 
	require_once('footer.php'); 
?>