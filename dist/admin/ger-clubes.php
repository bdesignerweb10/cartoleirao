<?php 
	require_once('header.php');
	$timeslist = $conn->query("SELECT t.id AS id, t.nome_time AS time, t.nome_presidente AS presidente, t.escudo_time AS escudo,  
							      t.ativo AS status, COUNT(i.id_anos) AS temporadas
   					         FROM tbl_times t
   				       INNER JOIN tbl_inscricao AS i ON i.id_times = t.id
   				         GROUP BY t.id, t.nome_time, t.nome_presidente, t.escudo_time, t.email, t.ativo
   				         ORDER BY t.id DESC") or trigger_error($conn->error); 
?> <main class="maintable"><div class="container"><div class="card spacing"><div class="card-header">Gerenciamento de clubes</div><div class="row btn-action"><div class="col-sm-8"></div><div class="col-sm-4"><button type="button" class="btn btns btn-lg btn-success"><i class="fas fa-plus"></i> Novo Clube</button></div><!-- col-sm-4 --></div><!-- row --><div class="card-body"><table class="table tbl-users table-hover"><thead><tr><th scope="col">#</th><th scope="col">Brasão</th><th scope="col">Clube</th><th scope="col">Presidente</th><th scope="col">Status</th><th scope="col">Temporadas</th><th scope="col">Opções</th></tr></thead><tbody> <?php 
			        	if($timeslist && $timeslist->num_rows > 0) {
				        	while($time = $timeslist->fetch_object()) {
				                $fake_id = $time->id * $_SESSION["fake_id"];

				                $escudo = "../img/escudos/no-escudo.png";
				                if(file_exists("../img/escudos/$time->escudo"))
				                	$escudo = "../img/escudos/$time->escudo";

				        		echo "<tr>
      									<th scope='row'>$time->id</th>
								        <td><img src='$escudo' class='shield-club'></td>
						                <td>$time->time</td>
						                <td>$time->presidente</td>						                
						                <td>" . ($time->status == 1 ? "<i class='fas fa-check icon-ok' alt='Time ativo' title='Time está ativo'></i>" : "<i class='fas fa-times icon-disabled' alt='Time inativo' title='Time ainda não está ativo'></i>") . "
						                </td>
						                <td>$time->temporadas</td>
						                <td>
						                	<a href='#' class='btn-edit-time' data-id='$fake_id' alt='Editar $time->time' title='Editar dados de $time->time'>
				                				<i class='fas fa-edit icon-edit'></i>
			                			  	</a>";

                			  	if($time->status == 1) {
		                			echo "<a href='#' class='btn-desativar-time' data-id='$fake_id' alt='Desativar $time->time' title='Desativar $time->time no sistema'><i class='fas fa-minus-circle icon-delete'></i>";
		                		}
		                		else {
		                			echo "<i class='fas fa-minus-circle icon-delete' alt='Desativar $time->time está desabilitada' title='Função de desativação do $time->time está desabilitada'></i>";
		                		}

								echo "</td></tr>";
							}
			        	}
			        	else {
			        		echo "<tr>
					                <td colspan='7' class='center'>Não há dados a serem exibidos para a listagem.</td>
				                </tr>";
			        	}
						?> </tbody></table></div></div></div><!-- container --><!-- Modal Desabilitar Clube --><div class="modal fade" id="disabled" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header modal-disabled"><h5 class="modal-title" id="exampleModalLabel">O Clube foi desabilitado</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p>O Clube Hasdrubal FC foi desabilitado, você pode habilitar o clube novamente, há qualquer momento</p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button></div></div></div></div></main><main class="mainform"><div class="container"><div class="card spacing"><div class="card-header">Gerenciamento de clubes</div><div class="row btn-action"><div class="col-sm-8"></div><div class="col-sm-4"><button type="button" class="btn btns btn-lg btn-secondary" id="btn-voltar-times"><i class="fas fa-arrow-left"></i> Voltar</button></div><!-- col-sm-4 --></div><!-- row --><div class="card-body"><form><div class="form-row"><div class="form-group col-md-1"><label for="club-id">ID</label> <input type="number" class="form-control" name="club-id" id="club-id" disabled="disabled"></div><div class="form-group col-md-4"><label for="club-cart">Nome do Clube (Mesmo do Cartola FC)</label> <input type="text" class="form-control" name="club-cart" id="club-cart" placeholder="Informe o nome do Clube do Cartola FC"></div><div class="form-group col-md-4"><label for="inputState">Presidente do Clube</label> <select id="inputState" class="form-control"><option selected="selected">Selecione o presidente do clube</option><option>Bruno Gomes da Silva</option><option>Pedro Pilz</option><option>João Pizzirani</option></select></div><div class="form-group col-md-2"><label for="inputState">Clube ativo?</label> <select id="inputState" class="form-control"><option class="text-success">Sim</option><option class="text-danger">Não</option></select></div><div class="form-group col-md-1"><label for="camp-nome"><span class="badge badge-success">Sim</span><!--<span class="badge badge-danger">Não</span>--></label></div><div class="form-group col-md-12"><label for="comment">História do Clube</label> <textarea class="form-control" rows="5" id="comment"></textarea></div></div><!-- form-row --></form><div class="row btn-action-2"><div class="col-sm-8"></div><div class="col-sm-4"><button type="submit" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#createclub"><i class="far fa-save"></i> Salvar Clube</button></div></div></div></div><!-- card --></div><!-- container --><!-- Modal Criação do usuário via painel --><div class="modal fade" id="createclub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Clube criado com sucesso!</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p>O Clube Hasdrubal FC foi criado e associado ao seu presidente com sucesso!</p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button></div></div></div></div></main> <?php 
	require_once('footer.php'); 
?>