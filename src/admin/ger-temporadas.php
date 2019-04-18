<?php 
	require_once('header.php'); 
?>
<main class="maintable">
	<div class="container">
		<div class="card spacing">
			<div class="card-header">
				Gerenciamento de temporadas			    
			</div>
			<div class="row btn-action">
				<div class="col-sm-4">
				</div><!-- col-sm-4 -->						
				<div class="col-sm-4">
					<button type="button" class="btn btns btn-lg btn-danger"><i class="far fa-calendar-times"></i> Encerrar Temporada</button>
				</div><!-- col-sm-4 -->				
				<div class="col-sm-4">
					<button type="button" class="btn btns btn-lg btn-success"><i class="fas fa-plus"></i> Nova Temporada</button>
				</div><!-- col-sm-4 -->	
			</div><!-- row -->	  
			<div class="card-body">
				<table class="table tbl-users table-hover">
					<thead>
						<tr>
					      <th scope="col">#</th>
					      <th scope="col">Ano da Temporada</th>
					      <th scope="col">Temporada Atual?</th>				      
					      <th scope="col">Opções</th>
					    </tr>
					</thead>
					<tbody>
						<tr>
					      <th scope="row">1</th>
					      <td>2019</td>				      
					      <td><i class="fas fa-check icon-ok"></i></td>				      
					      <td>
					      	<a href="#" title="Editar informações da temporada"><i class="fas fa-edit icon-edit"></i></a>				      	
					      	<a href="" title="Deletar temporada" data-toggle="modal" data-target="#remove"><i class="fas fa-trash-alt icon-delete"></i></a>
					      </td>
					    </tr>
					    <tr>
					      <th scope="row">2</th>
					      <td>2018</td>				      
					      <td><i class="fas fa-times icon-disabled"></i></td>				      
					      <td>
					      	<a href="#" title="Editar informações da temporada"><i class="fas fa-edit icon-edit"></i></a>				      	
					      	<a href="" title="Deletar temporada"><i class="fas fa-trash-alt icon-delete"></i></a>
					      </td>
					    </tr>
					    <tr>
					      <th scope="row">3</th>
					      <td>2017</td>				      
					      <td><i class="fas fa-times icon-disabled"></i></td>				      
					      <td>
					      	<a href="#" title="Editar informações da temporada"><i class="fas fa-edit icon-edit"></i></a>				      	
					      	<a href="" title="Deletar temporada"><i class="fas fa-trash-alt icon-delete"></i></a>
					      </td>
					    </tr>
					</tbody>
				</table>
			</div>			
		</div><!-- card -->
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
				Gerenciamento de temporadas			    
			</div>
			<div class="row btn-action">		
				<div class="col-sm-8"></div>
				<div class="col-sm-4">
					<button type="button" class="btn btns btn-lg btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</button>
				</div><!-- col-sm-4 -->	
			</div><!-- row -->	  
			<div class="card-body">
			</div>			
		</div><!-- card -->
		<div class="row">
			<div class="card spacing" style="width: 20%; margin-left: 15px;">
			  <div class="card-body">
			    <h5 class="card-title">Ano da Temporada</h5>
			    <form>
				  <div class="form-group">
				    <label for="temp-id">ID</label>
				    <input type="number" class="form-control" name="temp-id" id="temp-id" disabled>
				  </div>
				  <div class="form-group">
				    <label for="temp-ano">Ano da temporada</label>
				    <input type="number" class="form-control" name="temp-ano" id="temp-ano" placeholder="Ano da temporada">
				  </div>
				  <button type="submit" class="btn btn-lg btns btn-primary" style="width: 100%;" >Continuar <i class="fas fa-arrow-right"></i></button>
				</form>
			  </div>
			</div>

			<div class="card spacing" style="width: 76%; margin-left: 20px;">
			  <div class="card-body">
			    <h5 class="card-title">Rodadas da Temporada</h5>
			    <div class="form-check spacing">
				  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
				  <label class="form-check-label" for="inlineCheckbox3">Selecionar todas as Rodada</label>
				</div>
				
				<div class="row">
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #1</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #1</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #2</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #3</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #4</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #5</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #6</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #7</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #8</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #9</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #10</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #11</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #12</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #13</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #14</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #15</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #16</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #17</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #18</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #19</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #20</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #21</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #22</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #23</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #24</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #25</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #26</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #27</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #28</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #29</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #30</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #31</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #32</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #33</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #34</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #35</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #36</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #37</label>
						</div>
					</div><!-- col-sm-3-->
					<div class="col-sm-3">
					    <div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
						  <label class="form-check-label" for="inlineCheckbox1">Rodada #38</label>
						</div>
					</div><!-- col-sm-3-->					
				</div><!-- row -->
				<div class="row btns">
					<div class="col-sm-7"></div>
					<div class="col-sm-5">	
						<button type="submit" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#cria-temp"><i class="far fa-save"></i> Finalizar</button>
					</div>		
				</div>				
			  </div>
			</div>
		</div><!-- row -->
	</div><!-- container -->

	<!-- Modal Criar temporada -->
	<div class="modal fade" id="cria-temp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Temporada Criada!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>A temporada 2019 foi criada com sucesso!</p>
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