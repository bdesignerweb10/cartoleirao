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
				      	<a href="" title="Deletar Patrocinador"><i class="fas fa-trash-alt icon-delete"></i></a>
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
</main>
<?php 
	require_once('footer.php'); 
?>