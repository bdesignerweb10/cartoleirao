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
				      	<a href="" title="Desabilitar clube"><i class="fas fa-minus-circle icon-delete"></i></a>			      	
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
</main>
<?php 
	require_once('footer.php'); 
?>