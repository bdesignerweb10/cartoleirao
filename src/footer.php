		<div id="alert" class="modal modal-default modal-danger fade" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h5 class="modal-title" id="exampleModalLabel">Ops! Algo deu errado!</h5>
					</div>
					<div class="modal-body">
						<h3 class="modal-title" id="alert-title"></h3>
						<p class="modal-message" id="alert-content"></p>
					</div>		
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
					</div>
				</div>
			</div>
		</div>		
		<div id="loading-modal" class="modal" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Aguarde! Processando seus dados...</h5>
					</div>
					<div class="modal-body">
						<p id="alert-content" style="text-align: center;">
						<img src="img/loading.gif" border="0"><br />
						Sua requisição foi enviada e está sendo processada pelo nosso sistema! Aguarde alguns instantes....
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<ul class="footer-menu">
							<li class="footer-title">Acesso Rápido</li>					
							<li><a href="tabela-cts.php" class="footer-link">Tabela Cartoleirão - TS</a></li>
							<li><a href="brasileirao.php" class="footer-link">Tabela Brasileirão</a></li>
							<li><a href="clubes-liga.php" class="footer-link">Clubes da liga</a></li>
							<li><a href="destaques-rodada.php" class="footer-link">Destaques da rodada</a></li>
							<li><a href="mensal.php" class="footer-link">Pontuação Mensal</a></li>
							<li><a href="" class="footer-link">Gráfico de desempenho</a></li>
						</ul>
					</div>
					<div class="col-sm-4">
						<ul class="footer-menu">
							<li class="footer-title">Cartola FC</li>	
							<li><a href="https://globoesporte.globo.com/cartola-fc/" target="_blank"  class="footer-link">Site Cartola FC</a></li>				
							<li><a href="https://play.google.com/store/apps/details?id=br.com.mobits.cartolafc" class="footer-link" target="_blank">APP - Cartola FC (Oficial)</a></li>
							<li><a href="https://play.google.com/store/apps/details?id=br.com.parciais.parciais" target="_blank" class="footer-link">APP - Parciais</a></li>
							<li><a href="https://play.google.com/store/apps/details?id=com.cartola.premiere.league" target="_blank" class="footer-link">APP - Cartoleiro Premiere</a></li>							
						</ul>
					</div>
					<div class="col-sm-4">
						<ul class="footer-menu">
							<li class="footer-title">Patrocinadores</li>
							<li><a href="https://www.trabalhosegurots.com.br/" class="footer-link" target="_blank">Trabalho Seguro Treinamentos e Serviços</a></li>	
							<li><a href="" target="_blank"  class="footer-link">RT Corretora de Seguros</a></li>						
							<li><a href="" class="footer-link btn btn-footer btn-sm" data-toggle="modal" data-target="#modalpatrocionador">Seja Um Patrocinador</a></li>
						</ul>
					</div>
				</div>				
			</div><!-- container -->
		</footer>
		<div class="footer-end">
    	<div class="container">	    	    	
    		<p class="text-white">Todos os direitos reservados &copy; <?php echo date(Y); ?></p>
    	</div><!-- container -->
    </div><!-- footer end -->
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="js/main.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/app.js" type="text/javascript" charset="utf-8"></script>		
		<script src='js/moment.min.js' type="text/javascript" charset="utf-8"></script>
		<script src='js/fullcalendar.min.js' type="text/javascript" charset="utf-8"></script>		
		<script src='js/pt-br.js' type="text/javascript" charset="utf-8"></script>	
		<script src="js/textext.core.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/textext.plugin.autocomplete.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/textext.plugin.ajax.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
		<script src="js/jquery.mask.js"></script>		

		<!-- Modal patrocinador -->
		<div class="modal fade" id="modalpatrocionador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header modal-overview">
		        <h5 class="modal-title" id="exampleModalLabel">Deseja ser um de nossos patrocinadores?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p>Informe os seus dados abaixo que entraremos em contato, para encontrar a melhor solução para sua empresa.</p>
		        <form>
				  <div class="form-row modal-sponsor">
				    <div class="col-6">
				      <input type="text" class="form-control" placeholder="Informe seu nome">
				    </div>				    
				    <div class="col-6">
				      <input type="number" class="form-control" placeholder="Informe seu telefone">
				    </div>
				    <div class="col-12">
				      <input type="email" class="form-control" placeholder="Informe seu e-mail">
				    </div>
				    <div class="col-12">
				      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
				    </div>
				  </div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
		        <button type="button" class="btn btn-primary">Enviar</button>
		      </div>
		    </div>
		  </div>
		</div>

		<script>
			$(document).ready(function() {
		    	$('#modal-info').modal('show');
			})
		</script>
		<script>
		$(document).on("scroll",function(){
		    if($(document).scrollTop()>200){ 		        	
		        $("#nav-header").removeClass("nav-header").addClass("nav-header-2");
		        $("#header").removeClass("header-menu").addClass("header-menu-2");		        	        
		    } else{
		    	$("#nav-header").removeClass("nav-header-2").addClass("nav-header");
		        $("#header").removeClass("header-menu-2").addClass("header-menu");
		    }
		});
		</script>
		<script>
 			$(function() {
				$('[data-toggle="tooltip"]').tooltip();
			});
 		</script>
		<?php if($conn) $conn->close(); ob_end_flush(); ob_clean(); ?>
	</body>
</html>