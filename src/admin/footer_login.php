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
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="../js/main.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/app.js" type="text/javascript" charset="utf-8"></script>		
		<script src='js/moment.min.js' type="text/javascript" charset="utf-8"></script>
		<script src='js/fullcalendar.min.js' type="text/javascript" charset="utf-8"></script>	
		<script src="js/textext.core.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/textext.plugin.autocomplete.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/textext.plugin.ajax.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
		<script src="js/jquery.mask.js"></script>
		<?php if($conn) $conn->close(); ob_end_flush(); ob_clean(); ?>
	</body>
</html>