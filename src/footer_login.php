		<div id="alert" class="modal modal-default modal-danger fade" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-2x fa-times-circle-o"></i></h5>
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
		
		
		<script src="js/main.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/app.js" type="text/javascript" charset="utf-8"></script>		
		<script src='js/moment.min.js' type="text/javascript" charset="utf-8"></script>
		<script src='js/fullcalendar.min.js' type="text/javascript" charset="utf-8"></script>	
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
		<?php if($conn) $conn->close(); ob_end_flush(); ob_clean(); ?>
	</body>
</html>