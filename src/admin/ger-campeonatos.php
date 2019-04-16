<?php 
	require_once('header.php'); 
?>
<main>
	<div class="container">
		<div class="card spacing">
			  <div class="card-header">
			    Gerenciamento de campeonatos		    
			  </div>
			  <div class="row btn-action">		
				  <div class="col-sm-8"></div>
				  <div class="col-sm-4">
				  	<button type="button" class="btn btns btn-lg btn-success"><i class="fas fa-plus"></i> Novo Campeonato</button>
				  </div><!-- col-sm-4 -->	
			  </div><!-- row -->	  
			  <div class="card-body">
			    <table class="table tbl-users table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Nome do Campeonato</th>
				      <th scope="col">Valor da Inscrição</th>
				      <th scope="col">Liga ou Copa?</th>				      
				      <th scope="col">Opções</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Liga Cartoleirão - Trabalho Seguro TS</td>
				      <td>R$50,00</td>				      
				      <td><i class="fas fa-futbol" title="Liga Clássica"></i></td>				      
				      <td>
				      	<a href="#" title="Editar informações do campeonato"><i class="fas fa-edit icon-edit"></i></a>				      	
				      	<a href="" title="Deletar campeonato"><i class="fas fa-trash-alt icon-delete"></i></a>
				      </td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Copa Kempes VI</td>
				      <td>R$10,00</td>				      
				      <td><i class="fas fa-trophy" title="Torneio Mata Mata"></i></td>				      
				      <td>
				      	<a href="#" title="Editar informações do campeonato"><i class="fas fa-edit icon-edit"></i></a>				      	
				      	<a href="" title="Deletar campeonato"><i class="fas fa-trash-alt icon-delete"></i></a>
				      </td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Copa Beer</td>
				      <td>1 Pack de Heineken</td>				      
				      <td><i class="fas fa-trophy" title="Torneio Mata Mata"></i></td>				      
				      <td>
				      	<a href="#" title="Editar informações do campeonato"><i class="fas fa-edit icon-edit"></i></a>				      	
				      	<a href="" title="Deletar campeonato"><i class="fas fa-trash-alt icon-delete"></i></a>
				      </td>
				    </tr>
				  </tbody>
				</table>
				<div class="col-sm-12 legend">
					<p><i class="fas fa-futbol" title="Liga Clássica"></i> Liga Clássica</p>
					<p><i class="fas fa-trophy" title="Torneio Mata Mata"></i> Mata Mata</p>
				</div>
			  </div>
			</div>
	</div><!-- container -->
</main>
<?php 
	require_once('footer.php'); 
?>