<?php 
	require_once('header.php');
	$anos = $conn->query("SELECT id, descricao FROM tbl_anos ORDER BY descricao DESC") or trigger_error($conn->error); 
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
					<button type="button" class="btn btns btn-lg btn-danger" id="btn-fechar-temporada"><i class="far fa-calendar-times"></i> Encerrar Temporada</button>
				</div><!-- col-sm-4 -->				
				<div class="col-sm-4">
					<button type="button" class="btn btns btn-lg btn-success" id="btn-add-temporadas"><i class="fas fa-plus"></i> Nova Temporada</button>
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
						<?php 
			        	if($anos && $anos->num_rows > 0) {
				        	while($dados = $anos->fetch_object()) {

								$rodadas = $conn->query("SELECT COUNT(id_anos) AS count FROM tbl_temporadas WHERE id_anos = " . $dados->id) 
													or trigger_error($conn->error);

								$qtd_rodadas = 0;

								if ($rodadas && $rodadas->num_rows > 0) {
						        	while($rod = $rodadas->fetch_object()) {
										$qtd_rodadas = $rod->count;
						        	}
						        }
				        		echo "<tr>
      									<th scope='row'>$dados->id</th>
						                <td>$dados->descricao</td>
						                <td class='center'>" . ($dados->id == $_SESSION["temporada_atual"] ? "<i class='fas fa-check icon-ok' alt='Temporada Atual' title='Temporada é a atual'></i>" : "&nbsp;") . "</td>
						                
						                <td>";

						                $fake_id = $dados->id * $_SESSION["fake_id"];

				                if($dados->descricao < $_SESSION["temp_atual"] || ($dados->id == $_SESSION["temporada_atual"] && $_SESSION["temporada"] == 1)) {
				                	echo "<i class='fas fa-edit icon-edit disabled' alt='Edição da temporada $dados->id desabilitada' title='Edição da temporada $dados->id desabilitada'></i><i class='fas fa-trash-alt icon-delete' alt='Remoção da temporada $dados->id desabilitada' title='Remoção da temporada $dados->id desabilitada'></i>";
				                }
				                else {
				                	echo "<a href='#' class='btn-edit-temporadas' data-temporada='$fake_id' alt='Editar temporada $dados->id' title='Editar temporada $dados->id'>
				                			<i class='fas fa-edit icon-edit'></i>
			                			  </a>";

			                		if($dados->descricao > $_SESSION["temp_atual"]) {
			                			echo "<a href='#' class='btn-del-temporadas' data-temporada='$fake_id' alt='Remover temporada $dados->id' title='Remover temporada $dados->id'>
			                					<i class='fas fa-trash-alt icon-delete'></i>
		                					  </a>";
			                		}
			                		else {
			                			echo "<i class='fas fa-trash-alt icon-delete' alt='Remoção da temporada $dados->id desabilitada' title='Remoção da temporada $dados->id desabilitada'></i>";
			                		}
				                }
						        echo "</td></tr>";
							}
			        	}
			        	else {
			        		echo "<tr>
					                <td colspan='5' class='center'>Não há dados a serem exibidos para a listagem.</td>
				                </tr>";
			        	}
						?>					    
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
					<button type="button" class="btn btns btn-lg btn-secondary" id="btn-voltar-temporadas"><i class="fas fa-arrow-left"></i> Voltar</button>
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