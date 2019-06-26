<?php 
	require_once('header.php'); 
?>
<main>
	<div class="container">		
		<div class="row">
			<div class="col-sm-3">
				<div class="card spacing text-white bg-success mb-3" style="max-width: 18rem;">
				  <div class="card-header">Temporada <?php echo $_SESSION["temp_atual"]; ?></div>
				  <div class="card-body">
				  	<p class="card-text"><span>Status da temporada</span></p>
				    <h5 class="card-title"><?php echo ($_SESSION["temporada"] == 1 ? "Temp. Aberta" : ($_SESSION["temporada"] == 2 ? "Insc. Abertas" : "Temp. Fechada")); ?></h5>				    
				  </div>
				</div>
			</div><!-- col-sm-3-->			
			<div class="col-sm-3">
						
				<div class="card spacing text-white <?php echo ($_SESSION["mercado"] == 1 ? "bg-warning" : "bg-danger")?> mb-3" style="max-width: 18rem;">
				  <div class="card-header"><?php echo $_SESSION["rod_atual"]; ?>º Rodada</div>
				  <div class="card-body">
				  	<p class="card-text"><span>Status do mercado</span></p>
				    <h5 class="card-title"><?php echo ($_SESSION["mercado"] == 1 ? "Merc. Aberto" : "Merc. Fechado")?></h5>				    
				  </div>
				</div>
			</div><!-- col-sm-3-->
			<div class="col-sm-3">
				<div class="card spacing text-white bg-info mb-3" style="max-width: 18rem;">
				  <div class="card-header">Inscrições</div>
				  <div class="card-body">
				  	<p class="card-text"><span>Inscrição copa Kempes</span></p>
				    <h5 class="card-title">Insc. Aberta</h5>				    
				  </div>
				</div>
			</div><!-- col-sm-3-->
			<div class="col-sm-3">
				<div class="card spacing text-white bg-secondary mb-3" style="max-width: 18rem;">
				  <div class="card-header">Recados</div>
				  <div class="card-body">
				  	<p class="card-text"><span>Jogo Corinthians x Santos</span></p>
				    <h5 class="card-title">Ativo</h5>				    
				  </div>
				</div>
			</div><!-- col-sm-3-->
		</div><!-- row -->
	</div><!-- container -->
</main>
<?php 
	require_once('footer.php'); 
?>