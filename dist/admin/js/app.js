$(function() {

	$('html, body').on('click', function(e) {
		if (e.target == document.documentElement) {
			$("html").removeClass("open-sidebar");
		}
	});

	$(".js-open-sidebar").on("click", function(){
		$("html").addClass("open-sidebar");
	});

	$("#logout").on("click", function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "../acts/acts.logout.php",
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
						window.location.href = "./";
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						if(retorno.errno == "12010") {
							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.href = 'provisoria';
							});
						}
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});

	// BEGIN LOGIN (login.php)

	$("#form-login").submit(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=login",
			data: $("#form-login").serialize(),
			success: function(data)
			{
			    try {
			        var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('#loading').modal('hide');

					if(retorno.succeed) {
						window.location.href = 'home';
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						if(retorno.errno == "21010") {
							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.href = '../provisoria';
							});
						}
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});

	$('#btn-login').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=login",
			data: $("#form-login").serialize(),
			success: function(data)
			{
			    try {
			        var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('#loading').modal('hide');

					if(retorno.succeed) {
						window.location.href = 'home';
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						if(retorno.errno == "21010") {
							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.href = '../provisoria';
							});
						}
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});

	$('#btn-esqueceu-senha').click(function(e) {
		e.preventDefault();

		$('.mainlogin').hide();
		$('.mainform').show();
	});

	$('#btn-recuperar-senha').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=reset",
			data: $("#form-recuperar").serialize(),
			success: function(data)
			{
			    try {
			        var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
			        
					$('#loading').modal('hide');

					if(retorno.succeed) {
						$('#alert-title').html("Solicitação enviada com sucesso!");
						$('#alert-content').html("Sua requisição para resetar sua senha foi realizada com sucesso. Aguarde o e-mail com as informações! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});

	// END LOGIN (login.php)

	// BEGIN TEMPORADAS (temporadas.php)

    $('#btn-voltar-temporadas').click(function(e) {
		e.preventDefault();

    	$('#headline-temporada').html('');

    	$('#id').val('');
    	$('#descricao').prop("readonly", null);
    	$('#descricao').val('');
    	$('#passo-ano').prop("disabled", null);
    	$('#box-rodada').hide();

    	$('#sel-content').html('');
    	$('#passo-rodada').prop("disabled", null);
    	$("#voltar-ano").prop("disabled", null);
    	$('#box-confirmacao').hide();

    	$('#resumo-temporada').html('');
    	$('#resumo-rodadas').html('');

		$('.mainform').hide();
		$('.maintable').show();
    });	

    $('#btn-add-temporadas').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

    	$('#headline-temporada').html('Cadastro de nova temporada');

    	$('#id').val('');

    	$('#passo-confirmacao').data('act', 'add');
    	$('#passo-confirmacao').data('temporada', null);
    });	

    $('.btn-edit-temporadas').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$('.maintable').hide();
		$('.mainform').show();

    	var temporada = $(this).data('temporada');

		$.ajax({
			type: "POST",
			url: "acts/acts.temporadas.php?act=showupd&idano=" + temporada,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
				    	$('#passo-confirmacao').data('act', 'edit');
				    	$('#passo-confirmacao').data('temporada', temporada);

	    				$('#headline-temporada').html('Editando a temporada ' + retorno.descricao);
				    	
				    	$('#id').val(retorno.id);
						$('#descricao').val(retorno.descricao);
						$('#descricao').prop("readonly", "readonly");
				    	$('#passo-ano').prop("disabled", "disabled");

	    				$("#voltar-ano").prop("disabled", "disabled");
				    	$('#passo-rodada').prop("disabled", null);
						$('#box-rodada').show();

						$('#sel-content').append('<div class="col-12"><div class="form-check" style="margin-bottom:20px;"><label class="form-check-label"><input type="checkbox" class="form-check-input sel-todos" />&nbsp;&nbsp;&nbsp;Selecionar todos</label></div></div>');

						$.each(retorno.list, function(i, item) {
							$('#sel-content').append('<div class="col-6"><label class="form-check-label"><input type="checkbox" id="rodada[' + item.id + ']" name="rodada[' + item.id + ']" class="form-check-input sel-rodadas" value="' + item.id + '" ' + (item.has_temporada ? 'checked' : '') + ' />&nbsp;&nbsp;&nbsp;Rodada #' + item.descricao + '</label></div>');
						});
					}
					else {
	    				$('#headline-temporada').html('');

	    				$('#id').val('');
				    	$('#descricao').prop("readonly", null);
				    	$('#descricao').val('');
				    	$('#passo-ano').prop("disabled", null);
				    	$('#box-rodada').hide();

				    	$('#sel-content').html('');
				    	$('#passo-rodada').prop("disabled", null);
				    	$("#voltar-ano").prop("disabled", null);
				    	$('#box-confirmacao').hide();
				    	
				    	$('#resumo-temporada').html('');
				    	$('#resumo-rodadas').html('');

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('.btn-del-temporadas').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var temporada = $(this).data('temporada');

		$.ajax({
			type: "POST",
			url: "acts/acts.temporadas.php?act=del&idano=" + temporada,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Registro removido com sucesso!");
						$('#alert-content').html("A remoção do registro foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('#passo-ano').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.temporadas.php?act=selrod",
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#sel-content').append('<div class="col-12"><div class="form-check" style="margin-bottom:20px;"><label class="form-check-label"><input type="checkbox" class="form-check-input sel-todos" />&nbsp;&nbsp;&nbsp;Selecionar todos</label></div></div>');

						$.each(retorno.list, function(i, item) {
							$('#sel-content').append('<div class="col-6"><label class="form-check-label"><input type="checkbox" id="rodada[' + item.id + ']" name="rodada[' + item.id + ']" class="form-check-input sel-rodadas" value="' + item.id + '" ' + (item.has_temporada ? 'checked' : '') + ' />&nbsp;&nbsp;&nbsp;Rodada #' + item.descricao + '</label></div>');
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});

    	$('#descricao').prop("readonly", "readonly");
    	$(this).prop("disabled", "disabled");
    	$('#box-rodada').show();
    });	

	$('body').on('click', '.sel-todos', function() {
		$(".sel-rodadas").prop('checked', $(".sel-todos").is(':checked'));
	});

    $('#voltar-ano').click(function(e) {
    	e.preventDefault();

    	$('#sel-content').html('');
    	$('#descricao').prop("readonly", null);
    	$('#passo-ano').prop("disabled", null);
    	$('#box-rodada').hide();
    });	

    $('#passo-rodada').click(function(e) {
    	e.preventDefault();

    	$('#resumo-temporada').html("Temporada: " + $('#descricao').val());
    	$('#resumo-rodadas').html("Total rodadas: " + $('.sel-rodadas:checked').length);

    	$(".sel-todos").prop("disabled", "disabled");
		var cloned_check = $("#sel-content").clone();
    	$(".sel-rodadas").prop("disabled", "disabled");
    	cloned_check.appendTo("#box-rodada").addClass('check-duplicated');

    	$("#voltar-ano").prop("disabled", "disabled");
    	$(this).prop("disabled", "disabled");
    	$('#box-confirmacao').show();
    });	

    $('#voltar-rodada').click(function(e) {
    	e.preventDefault();

    	$(".sel-todos").prop("disabled", null);
    	$(".sel-rodadas").prop("disabled", null);
    	$(".check-duplicated").remove();
    	$("#voltar-ano").prop("disabled", null);
    	$("#passo-rodada").prop("disabled", null);
    	$('#box-confirmacao').hide();
    });	

    $('#passo-confirmacao').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var act = $('#passo-confirmacao').data('act');
    	var temporada = $('#passo-confirmacao').data('temporada');

		$.ajax({
			type: "POST",
			url: "acts/acts.temporadas.php?act=" + act + "&idano=" + temporada,
			data: $("#form-temporadas").serialize(),
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Registro " + (act == 'add' ? "adicionado" : "editado") + " com sucesso!");
						$('#alert-content').html("A " + (act == 'add' ? "adição" : "edição") + " do registro foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    // END TEMPORADAS (temporadas.php)

	// BEGIN COMPETICOES (competicoes.php)

    $('#btn-voltar-competicoes').click(function(e) {
		e.preventDefault();

    	$('#btn-salvar-competicao').data('id', null);
    	$('#btn-salvar-competicao').data('act', null);
    	$('#headline-competicao').html('');
		$('.headline-form').html('');

    	$('#id').val('');
    	$('#descricao').val('');
    	$('#valor').val('');
    	$('#capa').val('');
    	$('#outro_valor').val('');
    	$('#informacoes').val('');
    	$('#is_default').bootstrapToggle('off');
		$('#ch_outro_valor').bootstrapToggle('off');
    	$('#box-capa').hide();
    	$('#img-capa').attr('src', '');
    	$('#img-capa').attr('alt', '');
    	$('#img-capa').attr('title', '');

		$('.mainform').hide();
		$('.maintable').show();
    });	

    $('#btn-add-competicoes').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

    	$('#btn-salvar-competicao').data('id', null);
    	$('#btn-salvar-competicao').data('act', 'add');
    	$('#headline-competicao').html('Cadastrar nova competição');
		$('.headline-form').html('Insira as informações da nova competição');

    	$('#id').val('');
    	$('#descricao').val('');
    	$('#valor').val('');
    	$('#capa').val('');
    	$('#outro_valor').val('');
    	$('#informacoes').val('');
    	$('#is_default').bootstrapToggle('off');
		$('#ch_outro_valor').bootstrapToggle('off');
    	$('#box-capa').hide();
    	$('#img-capa').attr('src', '');
    	$('#img-capa').attr('alt', '');
    	$('#img-capa').attr('title', '');
    });	

    $('.btn-edit-competicoes').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.competicoes.php?act=showupd&idcompeticao=" + id,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

	    				$('#btn-salvar-competicao').data('id', id);
    					$('#btn-salvar-competicao').data('act', 'edit');
				    	$('#headline-ger-times').html('Editar a competição ' + retorno.descricao);
						$('.headline-form').html('Edite as informações da competição!');

				    	$('#id').val(retorno.id);
				    	$('#descricao').val(retorno.descricao);
				    	$('#informacoes').val(retorno.informacoes);
				    	$('#is_default').bootstrapToggle(retorno.is_default == 1 ? 'on' : 'off');
				    	if(retorno.valor == 0) {
				    		$('#ch_outro_valor').bootstrapToggle('on');
				    		$('#outro_valor').val(retorno.outro_valor);
				    	} else {
				    		$('#valor').val(retorno.valor);
				    		$('#ch_outro_valor').bootstrapToggle('off');
				    	}

				    	if(retorno.capa.length > 0) {
							var response = jQuery.ajax({
								url: "../img/competicao/" + retorno.capa,
								type: 'HEAD',
								async: false
							}).status;

	    					if(response == "200") {
		    					$('#box-capa').show();
						    	$('#img-capa').attr('src', "../img/competicao/" + retorno.capa);
						    	$('#img-capa').attr('alt', retorno.descricao);
						    	$('#img-capa').attr('title', retorno.descricao);
	    					}
				    	}
				    	else {
	    					$('#box-capa').hide();
				    	}
				    	
				    	$('#ano_fundacao').val(retorno.ano_fundacao);
					}
					else {
				    	$('#btn-salvar-competicao').data('id', null);
				    	$('#btn-salvar-competicao').data('act', null);
				    	$('#headline-competicao').html('');
						$('.headline-form').html('');

				    	$('#id').val('');
				    	$('#descricao').val('');
				    	$('#valor').val('');
				    	$('#capa').val('');
				    	$('#outro_valor').val('');
				    	$('#informacoes').val('');
				    	$('#is_default').bootstrapToggle('off');
		    			$('#ch_outro_valor').bootstrapToggle('off');
				    	$('#box-capa').hide();
				    	$('#img-capa').attr('src', '');
				    	$('#img-capa').attr('alt', '');
				    	$('#img-capa').attr('title', '');

						$('.mainform').hide();
						$('.maintable').show();

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('.btn-del-competicoes').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.competicoes.php?act=del&idcompeticao=" + id,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Você desativou a competição!");
						$('#alert-content').html("A competição selecionada foi removida com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('#ch_outro_valor').on('change', function () {
    	if($(this).is(':checked')) {
    		$('#outro_valor').show();
    		$('#valor-monetario').hide();
    	}
    	else {
    		$('#outro_valor').hide();
    		$('#valor-monetario').show();
    	}
    });

    $('#btn-salvar-competicao').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		var formData = new FormData();
		formData.append('descricao', $('#descricao').val());
		formData.append('valor', $('#valor').val());
		if($('#is_default').is(':checked'))
			formData.append('is_default', $('#is_default').val());
		if($('#ch_outro_valor').is(':checked')) {
			formData.append('ch_outro_valor', $('#ch_outro_valor').val());
			formData.append('outro_valor', $('#outro_valor').val());
		}
		formData.append('capa', $('#capa')[0].files[0]);
		formData.append('informacoes', $('#informacoes').val());

    	var id = $(this).data('id');
    	var act = $(this).data('act');

    	if(act == "edit") {
    		var url = "acts/acts.competicoes.php?act=" + act + "&idcompeticao=" + id;
    	}
    	else {
    		var url = "acts/acts.competicoes.php?act=" + act;
    	}

		$.ajax({
			type: "POST",
			url: url,
			data : formData,
			processData: false,
			contentType: false,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
					if(retorno.succeed) {
						$('#alert-title').html($('#descricao').val() + (act == 'add' ? " adicionado " : " editado ") + "com sucesso!");
						$('#alert-content').html("A " + (act == 'add' ? " adição " : " edição ") + " de " + $('#descricao').val() + " foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    // END COMPETICOES (competicoes.php)

	// BEGIN TIMES TEMPORADAS (times_temporadas.php)

	$('.btn-times-temporada').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var temporada = $(this).data('temporada');

		$.ajax({
			type: "POST",
			url: "acts/acts.times_temporadas.php?act=getanotemp&idano=" + temporada,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.maintemporada').show();

						$('#headline-time-temporada').html('Gerenciando times inscritos na temporada ' + retorno.descricao);

						if(retorno.list.length > 0) {
							$.each(retorno.list, function(i, item) {

								var botao_ativar = (item.pode_ativar == 1 ? "<a href='#' class='btn-ativar-inscricao' data-time='" + item.id_time +  "' data-temporada='" + temporada + "' alt='Inscrever " + item.time +  " na temporada' title='Inscrever " + item.time +  " na temporada'><i class='fa fa-rocket fa-2x edit'></i></a>" : "<i class='fa fa-rocket fa-2x edit-disabled' alt='Não é possível inscrever " + item.time +  " na temporada' title='Não é possível inscrever " + item.time +  " na temporada'></i>");
								var botao_inativar = (item.pode_desativar == 1 ? "<a href='#' class='btn-desativar-inscricao' data-time='" + item.id_time +  "' data-temporada='" + temporada + "' alt='Remover " + item.time +  " da temporada' title='Remover " + item.time +  " da temporada'><i class='fa fa-trash fa-2x del'></i></a>" : "<i class='fa fa-trash fa-2x del-disabled' alt='Não é possível remover " + item.time +  " da temporada' title='Não é possível remover " + item.time +  " da temporada'></i>");

								$('#lista-times-temporada').append("<tr>" +
							                							"<th scope='row' class='center'>" + item.id +  "</th>" +
							                							"<td>" + item.time + "</td>" +
							                							"<td>" + item.presidente + "</td>" +
							                							"<td class='center'>" + item.posicao_liga + " º</td>" +
							                							"<td class='center'>" + parseFloat(item.pontuacao).toFixed(2) + " pts.</td>" +
							                							"<td class='center'>" + (item.ativo == 1 ? "<i class='fa fa-check fa-2x add' alt='Time ativo' title='Time está ativo'></i>" : "<i class='fa fa-times fa-2x del' alt='Time inativo' title='Time ainda não está ativo'></i>") + "</td>" +
							                							"<td class='center'>" + (item.ativo == 1 ? botao_inativar : botao_ativar) + "</td>" +
						                							"</tr>");
							});
						}
						else {
							$('#lista-times-temporada').append("<tr><td colspan='7' class='center'>Não há dados a serem exibidos para a listagem.</td></tr>");
						}
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#headline-time-temporada').html('');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});

	$('body').on('click', '.btn-ativar-inscricao', function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var time = $(this).data('time');
    	var temporada = $(this).data('temporada');

		$.ajax({
			type: "POST",
			url: "acts/acts.times_temporadas.php?act=ativar&idtime=" + time + "&idano=" + temporada,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Você finalizou a inscrição do time!");
						$('#alert-content').html("O time foi inscrito com sucesso na temporada! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

	$('body').on('click', '.btn-desativar-inscricao', function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var time = $(this).data('time');
    	var temporada = $(this).data('temporada');

		$.ajax({
			type: "POST",
			url: "acts/acts.times_temporadas.php?act=desativar&idtime=" + time + "&idano=" + temporada,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Você removeu o time da temporada!");
						$('#alert-content').html("O time selecionado foi removido da temporada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('#btn-voltar-lista-temporadas').click(function(e) {
		e.preventDefault();
    	
		$('.maintable').show();
		$('.maintemporada').hide();

		$('#headline-time-temporada').html('');
		$('#lista-times-temporada').html('');
    });	

    // END TIMES TEMPORADAS (times_temporadas.php)

	// BEGIN GERENCIAR TIMES (gerenciar_times.php)
	
    $('#btn-voltar-times').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-time').data('id', null);
    	$('#headline-ger-times').html('');
		$('.headline-form').html('');
    });	

    $('.btn-edit-time').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.gerenciar_times.php?act=showupd&idtime=" + id,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

	    				$('#btn-salvar-time').data('id', id);
				    	$('#headline-ger-times').html('Editar o time ' + retorno.dados.nome_time);
						$('.headline-form').html('Edite as informações do time!');
				    	
				    	$('#id').val(retorno.dados.id);
				    	$('#nome_time').val(retorno.dados.nome_time);
				    	$('#nome_presidente').val(retorno.dados.nome_presidente);
				    	$('#email').val(retorno.dados.email);
				    	$('#telefone').val(retorno.dados.telefone);
				    	$('#historia').val(retorno.dados.historia);
				    	$('#ano_fundacao').val(retorno.dados.ano_fundacao);
					}
					else {
						$('.maintable').show();
						$('.mainform').hide();
	    				
	    				$('#btn-salvar-time').data('id', null);
				    	$('#headline-ger-times').html('');
						$('.headline-form').html('');
				    	
				    	$('#id').val('');
				    	$('#nome_time').val('');
				    	$('#nome_presidente').val('');
				    	$('#email').val('');
				    	$('#telefone').val('');
				    	$('#historia').val('');
				    	$('#ano_fundacao').val('');

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('.btn-desativar-time').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.gerenciar_times.php?act=desativar&idtime=" + id,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Você desativou o time!");
						$('#alert-content').html("O time selecionado foi desativado com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('#btn-salvar-time').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.gerenciar_times.php?act=edit&idtime=" + id,
			data: $("#form-temporadas").serialize(),
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html($('#nome_time').val() + " alterado com sucesso!");
						$('#alert-content').html("A alteração de " + $('#nome_time').val() + " foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    // END GERENCIAR TIMES (gerenciar_times.php)

	// BEGIN PONTUACAO (pontuacoes.php)

    $('.btn-salvar-pontuacoes').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.pontuacoes.php?act=updpont",
			data: $("#form-pontuacoes").serialize(),
    		timeout: 0,
			success: function(data)
			{
			    try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Pontuações lançadas com sucesso!");
						$('#alert-content').html("As pontuações dos times na rodada foram atualizadas com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    // END PONTUACAO (pontuacoes.php)

	// BEGIN CONFIGURAÇÕES (configuracoes.php)

    $('#btn-abrir-temporada').click(function(e) {
    	e.preventDefault();

		$('#confirm-title').html("ATENÇÃO!!");
		$('#confirm-content').html("Você irá ABRIR a temporada e o sistema estará pronto para ser usado!<br /><br />Esse processo é IRREVERSÍVEL!");
		$('#confirm').modal('show');

    	$('#btn-confirm-modal').click(function(e) {
			$('#confirm').modal('hide');
			
			$('#loading').modal({
				keyboard: false
			});

			$.ajax({
				type: "POST",
				url: "acts/acts.configuracoes.php?act=abrirtemporada",
    			timeout: 0,
				success: function(data)
				{
				    try {
						$('#loading').modal('hide');

						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('#alert-title').html("Temporada aberta com sucesso!");
							$('#alert-content').html("A temporada foi aberta com sucesso! Que começem os jogos!<br /><br />Ao fechar esta mensagem a página será recarregada.");
							$('#alert-content').append("<br /><br />" + retorno.msg);
							$('#alert').modal('show');

							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.reload();
							})
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');
						}
				    }
				    catch (e) {
						$('#loading').modal('hide');
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');
				    };
				}
	    	});
	    });	
    });	

    $('#btn-fechar-temporada').click(function(e) {
    	e.preventDefault();

		$('#confirm-title').html("ATENÇÃO!!");
		$('#confirm-content').html("Você irá ENCERRAR a temporada e a temporada será alterada para do próximo ano!<br /><br />Esse processo é IRREVERSÍVEL!");
		$('#confirm').modal('show');

    	$('#btn-confirm-modal').click(function(e) {
			$('#confirm').modal('hide');

			$('#loading').modal({
				keyboard: false
			});

			$.ajax({
				type: "POST",
				url: "acts/acts.configuracoes.php?act=fechartemporada",
    			timeout: 0,
				success: function(data)
				{
				    try {
						$('#loading').modal('hide');

						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('#alert-title').html("Temporada encerrada com sucesso!");
							$('#alert-content').html("A temporada foi encerrada com sucesso! Seja bem vindo a temporada " + retorno.rodada + " e até ano que vem!<br /><br />Ao fechar esta mensagem a página será recarregada.");
							$('#alert').modal('show');

							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.reload();
							});
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');
						}
				    }
				    catch (e) {
						$('#loading').modal('hide');
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');
				    };
				}
			});
    	});
    });	

    $('#btn-abrir-mercado').click(function(e) {
    	e.preventDefault();

		$('#confirm-title').html("ATENÇÃO!!");
		$('#confirm-content').html("Você irá ABRIR o mercado e a rodada atual será alterada!<br /><br />Esse processo é IRREVERSÍVEL!");
		$('#confirm').modal('show');

    	$('#btn-confirm-modal').click(function(e) {
			$('#confirm').modal('hide');

			$('#loading').modal({
				keyboard: false
			});

			$.ajax({
				type: "POST",
				url: "acts/acts.configuracoes.php?act=abrirmercado",
    			timeout: 0,
				success: function(data)
				{
				    try {
						$('#loading').modal('hide');

						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('#alert-title').html("Mercado aberto com sucesso!");
							$('#alert-content').html("O mercado foi aberto com sucesso! Você está na rodada " + retorno.rodada + "!<br /><br />Ao fechar esta mensagem a página será recarregada.");
							$('#alert').modal('show');

							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.reload();
							})
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');
						}
				    }
				    catch (e) {
						$('#loading').modal('hide');
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');
				    };
				}
			});
    	});
    });	

    $('#btn-fechar-mercado').click(function(e) {
    	e.preventDefault();

		$('#confirm-title').html("ATENÇÃO!!");
		$('#confirm-content').html("Você irá FECHAR o mercado! Aproveite para lançar e conferir as pontuações!<br /><br />Esse processo é IRREVERSÍVEL!");
		$('#confirm').modal('show');

    	$('#btn-confirm-modal').click(function(e) {
			$('#confirm').modal('hide');

			$('#loading').modal({
				keyboard: false
			});

			$.ajax({
				type: "POST",
				url: "acts/acts.configuracoes.php?act=fecharmercado",
    			timeout: 0,
				success: function(data)
				{
				    try {
						$('#loading').modal('hide');

						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('#alert-title').html("Mercado fechado com sucesso!");
							$('#alert-content').html("O mercado foi fechado com sucesso! Não se esqueça de lançar e conferir a pontuação de todos os times!<br /><br />Ao fechar esta mensagem a página será recarregada.");
							$('#alert').modal('show');

							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.reload();
							})
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');
						}
				    }
				    catch (e) {
						$('#loading').modal('hide');
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');
				    };
				}
			});
		});
    });	

    $('#btn-abrir-inscricao').click(function(e) {
    	e.preventDefault();

		$('#confirm-title').html("ATENÇÃO!!");
		$('#confirm-content').html("Você irá ABRIR AS INSCRIÇÕES e a temporada será alterada para do próximo ano!<br /><br />Esse processo é IRREVERSÍVEL!");
		$('#confirm').modal('show');

    	$('#btn-confirm-modal').click(function(e) {
			$('#confirm').modal('hide');

			$('#loading').modal({
				keyboard: false
			});

			$.ajax({
				type: "POST",
				url: "acts/acts.configuracoes.php?act=abririnscricoes",
    			timeout: 0,
				success: function(data)
				{
				    try {
						$('#loading').modal('hide');

						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('#alert-title').html("Inscrições abertas com sucesso!");
							$('#alert-content').html("As inscrições para a nova temporada foram abertas com sucesso! <br /><br />Ao fechar esta mensagem a página será recarregada.");
							$('#alert').modal('show');

							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.reload();
							})
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');
						}
				    }
				    catch (e) {
						$('#loading').modal('hide');
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');
				    };
				}
			});
		});
    });	

    $('#btn-dados-config').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.configuracoes.php?act=upddados",
			data: $("#form-config").serialize(),
    		timeout: 0,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Dados alterados com sucesso!");
						$('#alert-content').html("As configurações foram alteradas com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    // END CONFIGURAÇÕES (configuracoes.php)

	// BEGIN EVENTOS (eventos.php)

	$.datetimepicker.setLocale('pt-BR');
	$('#data_evento').datetimepicker({
		startDate: '+'+getTodayDate(),
 		minDate: '-'+getTodayDate(),
 		mask: true,
 		step: 30,
		format: 'd/m/Y H:i'
	});

    $('#btn-voltar-eventos').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-evento').data('id', null);
    	$('#btn-salvar-evento').data('act', null);
    	$('#headline-ger-eventos').html('');
		$('.headline-form').html('');

    	$('#id').val('');
    	$('#titulo').val('');
    	$('#data_evento').val('');
    	$('#local').val('');
    	$('#descricao').val('');
    	$('#ativo').bootstrapToggle('off');
    	$('#lista-participantes-evento').html('');
    });	

    $('#btn-add-eventos').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-evento').data('id', null);
    	$('#btn-salvar-evento').data('act', 'add');
    	$('#headline-ger-times').html('Cadastrar novo evento');
		$('.headline-form').html('Insira as informações do novo evento!');

    	$('#id').val('');
    	$('#titulo').val('');
    	$('#data_evento').val('');
    	$('#local').val('');
    	$('#descricao').val('');
    	$('#ativo').bootstrapToggle('off');
		$('#lista-participantes-evento').html('');
    });	

    $('.btn-edit-eventos').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.eventos.php?act=showupd&idevento=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-evento').data('act', 'edit');
				    	$('#btn-salvar-evento').data('id', id);
	    				$('#headline-temporada').html('Editando o evento ' + retorno.dados.titulo);
						$('.headline-form').html('Edite as informações do evento!');

						var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#titulo').val(retorno.dados.titulo);
				    	$('#data_evento').val(d.toDatePickerFormat());
				    	$('#local').val(retorno.dados.local);
				    	$('#descricao').val(retorno.dados.descricao);
				    	$('#ativo').bootstrapToggle(retorno.dados.ativo == 1 ? 'on' : 'off');

				    	if(retorno.list.length > 0) {
							$.each(retorno.list, function(i, item) {
								$('#lista-participantes-evento').append("<tr>" +
							                							"<td>" + item.time + "</td>" +
							                							"<td>" + item.presidente + "</td>" +
							                							"<td class='center'><a href='#' class='btn-del-presenca-evento' data-id='" + item.id_time + "' data-evento='" + id + "' alt='Remover " + item.time + " do evento' title='Remover " + item.time + " do evento'><i class='fa fa-trash fa-2x del'></i></a></td>" +
						                							"</tr>");
							});
						}
						else {
							$('#lista-participantes-evento').append("<tr><td colspan='3' class='center'>Não há dados a serem exibidos para a listagem.</td></tr>");
						}
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-evento').data('id', null);
				    	$('#btn-salvar-evento').data('act', null);
				    	$('#headline-ger-eventos').html('');
						$('.headline-form').html('');

				    	$('#id').val('');
				    	$('#titulo').val('');
				    	$('#data_evento').val('');
				    	$('#local').val('');
				    	$('#descricao').val('');
				    	$('#ativo').bootstrapToggle('off');
				    	$('#lista-participantes-evento').html('');

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('.btn-del-eventos').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.eventos.php?act=del&idevento=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Evento removido com sucesso!");
						$('#alert-content').html("A remoção do evento foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('#btn-salvar-evento').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');
    	var act = $(this).data('act');

    	if(act == "edit") {
    		var url = "acts/acts.eventos.php?act=" + act + "&idevento=" + id;
    	}
    	else {
    		var url = "acts/acts.eventos.php?act=" + act;
    	}

		$.ajax({
			type: "POST",
			url: url,
			data: $("#form-eventos").serialize(),
			success: function(data)
			{
				console.log('data', data);
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
					if(retorno.succeed) {
						$('#alert-title').html($('#titulo').val() + (act == 'add' ? " adicionado " : " editado ") + "com sucesso!");
						$('#alert-content').html("A " + (act == 'add' ? " adição " : " edição ") + " de " + $('#titulo').val() + " foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('body').on('click', '.btn-del-presenca-evento', function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');
    	var evento = $(this).data('evento');

		$.ajax({
			type: "POST",
			url: "acts/acts.eventos.php?act=delp&idtime=" + id + "&idevento=" + evento,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Você removeu o time do evento!");
						$('#alert-content').html("O time selecionado foi removido do evento com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    // END EVENTOS (eventos.php)

	// BEGIN USUÁRIOS (usuarios.php)

    $('.btn-voltar-usuarios').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.mainadd').hide();
		$('.maintable').show();

    	$('#headline-add-usuarios').html('');
		$('.headline-form').html('');
    	$('#headline-edit-usuarios').html('');
		$('.headline-form-edit').html('');

    	$('#id').val('');
    	$('#time-usuario').html('');
    	$('#user').val('');
    	$('#password').val('');
    	$('#nivel').val('');

    	$('#usuario').val('');
    	$('#senha').val('');
    });	

    $('#btn-add-usuarios').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').hide();
		$('.mainadd').show();

    	$('#headline-add-usuarios').html('Cadastrar novo usuário administrador');
		$('.headline-form-add').html('Insira as informações do novo admin!');
    	$('#headline-edit-usuarios').html('');
		$('.headline-form-edit').html('');

    	$('#usuario').val('');
    	$('#senha').val('');
    });	

    $('#btn-incluir-usuario').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.usuarios.php?act=add",
			data: $("#form-usuarios-add").serialize(),
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html($('#usuario').val() + " adicionado com sucesso!");
						$('#alert-content').html("A inclusão de <b>" + $('#usuario').val() + "</b> foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-edit-usuarios').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.usuarios.php?act=showupd&idusuario=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainadd').hide();
						$('.mainform').show();

				    	$('#btn-editar-usuario').data('id', id);
				    	$('#btn-desativar-usuario').data('id', id);
	    				$('#headline-edit-usuarios').html('Editando o usuário ' + retorno.dados.usuario);
						$('.headline-form-edit').html('Edite as informações do usuário!');

				    	$('#id').val(retorno.dados.id);
				    	$('#time-usuario').html(retorno.dados.time);
				    	$('#user').val(retorno.dados.usuario);
				    	$('#password').val(retorno.dados.senha);
				    	$('#nivel').val(retorno.dados.nivel);
					}
					else {
						$('.mainadd').hide();
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-editar-usuario').data('id', null);
				    	$('#btn-desativar-usuario').data('id', null);
	    				$('#headline-edit-usuarios').html('');
						$('.headline-form-edit').html('');

				    	$('#id').val('');
				    	$('#time-usuario').html('');
				    	$('#user').val('');
				    	$('#password').val('');
				    	$('#nivel').val('');

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('.btn-del-usuarios').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.usuarios.php?act=del&idusuario=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Usuário removido com sucesso!");
						$('#alert-content').html("A remoção do usuário foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('#btn-editar-usuario').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});
		
    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.usuarios.php?act=edit&idusuario=" + id,
			data: $("#form-usuarios-edit").serialize(),
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html($('#user').val() + " alterado com sucesso!");
						$('#alert-content').html("A alteração de <b>" + $('#user').val() + "</b> foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('.btn-resetar-senha').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});
		
    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.usuarios.php?act=reset&idusuario=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Senha do usuário resetada com sucesso!");
						$('#alert-content').html("A senha do usuário foi resetada com sucesso!");
						$('#alert').modal('show');
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('#btn-desativar-usuario').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});
		
    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.usuarios.php?act=deactivate&idusuario=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Usuário desativado com sucesso!");
						$('#alert-content').html("O usuário foi desativado com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    // END USUÁRIOS (usuarios.php)

	// BEGIN MATA-MATA (mata_mata.php)

	$('#btn-voltar-mata-mata').click(function(e) {
		e.preventDefault();

    	$('#headline-mata-mata').html('');

    	$('#id').val('');
    	$('#descricao').prop("readonly", false);
    	$('#descricao').val('');
    	$('#total_times').prop("readonly", false);
    	$('#total_times').val('4');
    	$('#rodada_inicio').prop("readonly", false);
    	$('#passo-mata-mata').prop("disabled", false);

    	$('#sel-time-content').html('');
    	$('#voltar-mata-mata').prop("disabled", false);
    	$('#passo-mata-mata').prop("disabled", false);
    	$('#box-times').hide();

		$('#chaves-confronto').html('');
    	$('#box-confrontos').hide();

		$('.mainform').hide();
		$('.maintable').show();
    });	

    $('#btn-add-mata-mata').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

    	$('#headline-mata-mata').html('Cadastro de novo mata-mata');

    	$('#id').val('');

    	$('#passo-confrontos').data('act', 'add');
    	$('#passo-confrontos').data('id', null);
    });	

    $('.btn-edit-matamata').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$('.maintable').hide();
		$('.mainform').show();

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.mata_mata.php?act=showupd&idmatamata=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
				    	$('#passo-confrontos').data('act', 'edit');
				    	$('#passo-confrontos').data('id', id);

	    				$('#headline-temporada').html('Editando a temporada ' + retorno.descricao);
				    	
				    	$('#id').val(retorno.id);
						$('#descricao').val(retorno.descricao);
						$('#descricao').prop("readonly", true);

				    	$('#total_times').val(retorno.total_times);
				    	$('#total_times').prop("disabled", true);

				    	$('#rodada_inicio').val(retorno.rodada_inicio);
				    	$('#rodada_inicio').prop("disabled", true);

				    	$('#passo-mata-mata').prop("disabled", true);

				    	$.each(retorno.times, function(i, item) {
							$('#sel-time-content').append('<div class="col-6"><label class="form-check-label" for="time[' + item.id + ']"><input type="checkbox" id="time[' + item.id + ']" name="time[' + item.id + ']" class="form-check-input sel-times" value="' + item.id + '" ' + (item.has_time ? 'checked' : '') + ' />&nbsp;&nbsp;&nbsp;' + item.descricao + '</label></div>');
						});
			    		$(".sel-times").prop("disabled", true);
				    	$("#voltar-mata-mata").prop("disabled", true);
				    	$("#passo-times").prop("disabled", true);
				    	$('#box-times').show();
						
				    	var chaves = retorno.total_times / 2;

				    	var options = "<option value='' selected>Selecione...</option>";

				    	$("#sel-time-content input[type='checkbox']:checked").each(function(){
				    		options += "<option value='" + $(this).val() + "'>" + $("label[for='" + $(this).attr('id') + "']").text().split('   ')[1] + "</option>";
						});

				    	for(var i = 1; i <= chaves; i++) {
				    		$('#chaves-confronto').append("<div class='row'><div class='col-12'><div class='card'><div class='card-header'>Chave " + i + "</div><div class='card-block'><div class='form-group'><select class='form-control form-control-lg' id='chave[" + i + "][1]' name='chave[" + i + "][1]' aria-describedby='chave[" + i + "][1]' required>" + options + "</select></div><div class='form-group'><label for='chave[" + i + "][2]' class='label-versus'>x</label><select class='form-control form-control-lg' id='chave[" + i + "][2]' name='chave[" + i + "][2]' aria-describedby='chave[" + i + "][2]' required>" + options + "</select></div></div></div></div></div>");
				    	}

				    	$.each(retorno.chaves, function(i, item) {
				    		$('#chave\\['+item.chave+'\\]\\[1\\]').val(item.confrontos[0].time1);
				    		$('#chave\\['+item.chave+'\\]\\[2\\]').val(item.confrontos[1].time2);
				    	});

				    	$('#box-confrontos').show();
					}
					else {
				    	$('#headline-mata-mata').html('');

				    	$('#id').val('');
				    	$('#descricao').prop("readonly", null);
				    	$('#descricao').val('');
				    	$('#total_times').prop("readonly", null);
				    	$('#total_times').val('4');
				    	$('#rodada_inicio').prop("readonly", null);
				    	$('#passo-mata-mata').prop("disabled", null);

				    	$('#sel-time-content').html('');
				    	$('#voltar-mata-mata').prop("disabled", null);
				    	$('#passo-mata-mata').prop("disabled", null);
				    	$('#box-times').hide();

			    		$('#chaves-confronto').html('');
				    	$('#box-confrontos').hide();

						$('.mainform').hide();
						$('.maintable').show();

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('.btn-del-matamata').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.mata_mata.php?act=del&idmatamata=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Mata-mata removido com sucesso!");
						$('#alert-content').html("A remoção do mata-mata foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });	

    $('#passo-mata-mata').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.mata_mata.php?act=seltimes",
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$.each(retorno.list, function(i, item) {
							$('#sel-time-content').append('<div class="col-6"><label class="form-check-label" for="time[' + item.id + ']"><input type="checkbox" id="time[' + item.id + ']" name="time[' + item.id + ']" class="form-check-input sel-times" value="' + item.id + '" ' + (item.has_time ? 'checked' : '') + ' />&nbsp;&nbsp;&nbsp;' + item.descricao + '</label></div>');
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});

    	$('#descricao').prop("readonly", true);
    	$('#total_times').prop("disabled", true);
    	$('#rodada_inicio').prop("disabled", true);
    	$(this).prop("disabled", true);
    	$('#box-times').show();
    });

    $('#voltar-mata-mata').click(function(e) {
    	e.preventDefault();

    	$('#descricao').prop("readonly", false);
		$('#total_times').prop("disabled", false);
    	$('#rodada_inicio').prop("disabled", false);
    	$('#sel-time-content').html('');
    	$('#passo-mata-mata').prop("disabled", false);
    	$('#box-times').hide();
    });	

	$('body').on('click', '.sel-times', function(e) {
		if(($('.sel-times:checked').length) > $('#total_times').val()) {
    		e.preventDefault();

			$('#alert-title').html("Quantidade de times selecionados diverge do total de times do mata-mata");
			$('#alert-content').html("O mata-mata está configurado para " + $('#total_times').val() + " times. O total de times já foi selecionado.");
			$('#alert').modal('show');
		}
	});

    $('#passo-times').click(function(e) {
    	e.preventDefault();

    	if($('#total_times').val() != $('.sel-times:checked').length) {
			$('#alert-title').html("Quantidade de times selecionados diverge do total de times do mata-mata");
			$('#alert-content').html("O mata-mata está configurado para " + $('#total_times').val() + " times e foram selecionados " + $('.sel-times:checked').length + " times.");
			$('#alert').modal('show');
    	}
    	else {
	    	var chaves = $('#total_times').val() / 2;

	    	var options = "<option value='' selected>Selecione...</option>";

	    	$("#sel-time-content input[type='checkbox']:checked").each(function(){
	    		options += "<option value='" + $(this).val() + "'>" + $("label[for='" + $(this).attr('id') + "']").text().split('   ')[1] + "</option>";
			});

	    	for(var i = 1; i <= chaves; i++) {
	    		$('#chaves-confronto').append("<div class='row'><div class='col-12'><div class='card'><div class='card-header'>Chave " + i + "</div><div class='card-block'><div class='form-group'><select class='form-control form-control-lg' id='chave[" + i + "][1]' name='chave[" + i + "][1]' aria-describedby='chave[" + i + "][1]' required>" + options + "</select></div><div class='form-group'><label for='chave[" + i + "][2]' class='label-versus'>x</label><select class='form-control form-control-lg' id='chave[" + i + "][2]' name='chave[" + i + "][2]' aria-describedby='chave[" + i + "][2]' required>" + options + "</select></div></div></div></div></div>");
	    	}

    		$(".sel-times").prop("disabled", true);
	    	$("#voltar-mata-mata").prop("disabled", true);
	    	$(this).prop("disabled", true);
	    	$('#box-confrontos').show();
    	}
    });	

    $('#voltar-times').click(function(e) {
    	e.preventDefault();

    	$(".sel-times").prop("disabled", null);
    	$("#voltar-mata-mata").prop("disabled", null);
    	$("#passo-times").prop("disabled", null);
    	$('#chaves-confronto').html('');
    	$('#box-confrontos').hide();
    });	

    $('#passo-confrontos').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var act = $(this).data('act');
    	var id = $(this).data('id');
    	
    	$('#total_times').prop("disabled", false);
		$('#rodada_inicio').prop("disabled", false);

		$.ajax({
			type: "POST",
			url: "acts/acts.mata_mata.php?act=" + act + "&idmatamata=" + id,
			data: $("#form-mata-mata").serialize(),
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Registro " + (act == 'add' ? "adicionado" : "editado") + " com sucesso!");
						$('#alert-content').html("A " + (act == 'add' ? "adição" : "edição") + " do registro foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

	    				$('#total_times').prop("disabled", true);
	    				$('#rodada_inicio').prop("disabled", true);

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

	    				$('#total_times').prop("disabled", true);
	    				$('#rodada_inicio').prop("disabled", true);
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });
	
	// END MATA-MATA (mata_mata.php)
});

Date.prototype.toDatetimeLocal =
  function toDatetimeLocal() {
    var
      date = this,
      ten = function (i) {
        return (i < 10 ? '0' : '') + i;
      },
      YYYY = date.getFullYear(),
      MM = ten(date.getMonth() + 1),
      DD = ten(date.getDate()),
      HH = ten(date.getHours()),
      II = ten(date.getMinutes()),
      SS = ten(date.getSeconds())
    ;
    return YYYY + '-' + MM + '-' + DD + 'T' +
             HH + ':' + II + ':' + SS;
  };

Date.prototype.toDatePickerFormat =
  function toDatePickerFormat() {
    var
      date = this,
      ten = function (i) {
        return (i < 10 ? '0' : '') + i;
      },
      YYYY = date.getFullYear(),
      MM = ten(date.getMonth() + 1),
      DD = ten(date.getDate()),
      HH = ten(date.getHours()),
      II = ten(date.getMinutes())
    ;
    return DD + '/' + MM + '/' + YYYY + ' ' + HH + ':' + II;
  };

Date.prototype.fromDatetimeLocal = (function (BST) {
  // BST should not be present as UTC time
  return new Date(BST).toISOString().slice(0, 16) === BST ?
    // if it is, it needs to be removed
    function () {
      return new Date(
        this.getTime() +
        (this.getTimezoneOffset() * 60000)
      ).toISOString();
    } :
    // otherwise can just be equivalent of toISOString
    Date.prototype.toISOString;
}('2006-06-06T06:06'));

function getTodayDate() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	var h = today.getHours() < 10 ? "0" + today.getHours() : today.getHours();
	var i = today.getMinutes() < 10 ? "0" + today.getMinutes() : today.getMinutes();

	if(dd<10) {
	    dd = '0'+dd
	} 

	if(mm<10) {
	    mm = '0'+mm
	} 

	return dd + '/' + mm + '/' + yyyy + ' ' + h + ':' + i;
}

/*!
 * Validator v0.11.9 for Bootstrap 3, by @1000hz
 * Copyright 2017 Cina Saffary
 * Licensed under http://opensource.org/licenses/MIT
 *
 * https://github.com/1000hz/bootstrap-validator
 */

+function(a){"use strict";function b(b){return b.is('[type="checkbox"]')?b.prop("checked"):b.is('[type="radio"]')?!!a('[name="'+b.attr("name")+'"]:checked').length:b.is("select[multiple]")?(b.val()||[]).length:b.val()}function c(b){return this.each(function(){var c=a(this),e=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b),f=c.data("bs.validator");(f||"destroy"!=b)&&(f||c.data("bs.validator",f=new d(this,e)),"string"==typeof b&&f[b]())})}var d=function(c,e){this.options=e,this.validators=a.extend({},d.VALIDATORS,e.custom),this.$element=a(c),this.$btn=a('button[type="submit"], input[type="submit"]').filter('[form="'+this.$element.attr("id")+'"]').add(this.$element.find('input[type="submit"], button[type="submit"]')),this.update(),this.$element.on("input.bs.validator change.bs.validator focusout.bs.validator",a.proxy(this.onInput,this)),this.$element.on("submit.bs.validator",a.proxy(this.onSubmit,this)),this.$element.on("reset.bs.validator",a.proxy(this.reset,this)),this.$element.find("[data-match]").each(function(){var c=a(this),d=c.attr("data-match");a(d).on("input.bs.validator",function(){b(c)&&c.trigger("input.bs.validator")})}),this.$inputs.filter(function(){return b(a(this))&&!a(this).closest(".has-error").length}).trigger("focusout"),this.$element.attr("novalidate",!0)};d.VERSION="0.11.9",d.INPUT_SELECTOR=':input:not([type="hidden"], [type="submit"], [type="reset"], button)',d.FOCUS_OFFSET=20,d.DEFAULTS={delay:500,html:!1,disable:!0,focus:!0,custom:{},errors:{match:"Does not match",minlength:"Not long enough"},feedback:{success:"glyphicon-ok",error:"glyphicon-remove"}},d.VALIDATORS={"native":function(a){var b=a[0];return b.checkValidity?!b.checkValidity()&&!b.validity.valid&&(b.validationMessage||"error!"):void 0},match:function(b){var c=b.attr("data-match");return b.val()!==a(c).val()&&d.DEFAULTS.errors.match},minlength:function(a){var b=a.attr("data-minlength");return a.val().length<b&&d.DEFAULTS.errors.minlength}},d.prototype.update=function(){var b=this;return this.$inputs=this.$element.find(d.INPUT_SELECTOR).add(this.$element.find('[data-validate="true"]')).not(this.$element.find('[data-validate="false"]').each(function(){b.clearErrors(a(this))})),this.toggleSubmit(),this},d.prototype.onInput=function(b){var c=this,d=a(b.target),e="focusout"!==b.type;this.$inputs.is(d)&&this.validateInput(d,e).done(function(){c.toggleSubmit()})},d.prototype.validateInput=function(c,d){var e=(b(c),c.data("bs.validator.errors"));c.is('[type="radio"]')&&(c=this.$element.find('input[name="'+c.attr("name")+'"]'));var f=a.Event("validate.bs.validator",{relatedTarget:c[0]});if(this.$element.trigger(f),!f.isDefaultPrevented()){var g=this;return this.runValidators(c).done(function(b){c.data("bs.validator.errors",b),b.length?d?g.defer(c,g.showErrors):g.showErrors(c):g.clearErrors(c),e&&b.toString()===e.toString()||(f=b.length?a.Event("invalid.bs.validator",{relatedTarget:c[0],detail:b}):a.Event("valid.bs.validator",{relatedTarget:c[0],detail:e}),g.$element.trigger(f)),g.toggleSubmit(),g.$element.trigger(a.Event("validated.bs.validator",{relatedTarget:c[0]}))})}},d.prototype.runValidators=function(c){function d(a){return c.attr("data-"+a+"-error")}function e(){var a=c[0].validity;return a.typeMismatch?c.attr("data-type-error"):a.patternMismatch?c.attr("data-pattern-error"):a.stepMismatch?c.attr("data-step-error"):a.rangeOverflow?c.attr("data-max-error"):a.rangeUnderflow?c.attr("data-min-error"):a.valueMissing?c.attr("data-required-error"):null}function f(){return c.attr("data-error")}function g(a){return d(a)||e()||f()}var h=[],i=a.Deferred();return c.data("bs.validator.deferred")&&c.data("bs.validator.deferred").reject(),c.data("bs.validator.deferred",i),a.each(this.validators,a.proxy(function(a,d){var e=null;!b(c)&&!c.attr("required")||void 0===c.attr("data-"+a)&&"native"!=a||!(e=d.call(this,c))||(e=g(a)||e,!~h.indexOf(e)&&h.push(e))},this)),!h.length&&b(c)&&c.attr("data-remote")?this.defer(c,function(){var d={};d[c.attr("name")]=b(c),a.get(c.attr("data-remote"),d).fail(function(a,b,c){h.push(g("remote")||c)}).always(function(){i.resolve(h)})}):i.resolve(h),i.promise()},d.prototype.validate=function(){var b=this;return a.when(this.$inputs.map(function(){return b.validateInput(a(this),!1)})).then(function(){b.toggleSubmit(),b.focusError()}),this},d.prototype.focusError=function(){if(this.options.focus){var b=this.$element.find(".has-error :input:first");0!==b.length&&(a("html, body").animate({scrollTop:b.offset().top-d.FOCUS_OFFSET},250),b.focus())}},d.prototype.showErrors=function(b){var c=this.options.html?"html":"text",d=b.data("bs.validator.errors"),e=b.closest(".form-group"),f=e.find(".help-block.with-errors"),g=e.find(".form-control-feedback");d.length&&(d=a("<ul/>").addClass("list-unstyled").append(a.map(d,function(b){return a("<li/>")[c](b)})),void 0===f.data("bs.validator.originalContent")&&f.data("bs.validator.originalContent",f.html()),f.empty().append(d),e.addClass("has-error has-danger"),e.hasClass("has-feedback")&&g.removeClass(this.options.feedback.success)&&g.addClass(this.options.feedback.error)&&e.removeClass("has-success"))},d.prototype.clearErrors=function(a){var c=a.closest(".form-group"),d=c.find(".help-block.with-errors"),e=c.find(".form-control-feedback");d.html(d.data("bs.validator.originalContent")),c.removeClass("has-error has-danger has-success"),c.hasClass("has-feedback")&&e.removeClass(this.options.feedback.error)&&e.removeClass(this.options.feedback.success)&&b(a)&&e.addClass(this.options.feedback.success)&&c.addClass("has-success")},d.prototype.hasErrors=function(){function b(){return!!(a(this).data("bs.validator.errors")||[]).length}return!!this.$inputs.filter(b).length},d.prototype.isIncomplete=function(){function c(){var c=b(a(this));return!("string"==typeof c?a.trim(c):c)}return!!this.$inputs.filter("[required]").filter(c).length},d.prototype.onSubmit=function(a){this.validate(),(this.isIncomplete()||this.hasErrors())&&a.preventDefault()},d.prototype.toggleSubmit=function(){this.options.disable&&this.$btn.toggleClass("disabled",this.isIncomplete()||this.hasErrors())},d.prototype.defer=function(b,c){return c=a.proxy(c,this,b),this.options.delay?(window.clearTimeout(b.data("bs.validator.timeout")),void b.data("bs.validator.timeout",window.setTimeout(c,this.options.delay))):c()},d.prototype.reset=function(){return this.$element.find(".form-control-feedback").removeClass(this.options.feedback.error).removeClass(this.options.feedback.success),this.$inputs.removeData(["bs.validator.errors","bs.validator.deferred"]).each(function(){var b=a(this),c=b.data("bs.validator.timeout");window.clearTimeout(c)&&b.removeData("bs.validator.timeout")}),this.$element.find(".help-block.with-errors").each(function(){var b=a(this),c=b.data("bs.validator.originalContent");b.removeData("bs.validator.originalContent").html(c)}),this.$btn.removeClass("disabled"),this.$element.find(".has-error, .has-danger, .has-success").removeClass("has-error has-danger has-success"),this},d.prototype.destroy=function(){return this.reset(),this.$element.removeAttr("novalidate").removeData("bs.validator").off(".bs.validator"),this.$inputs.off(".bs.validator"),this.options=null,this.validators=null,this.$element=null,this.$btn=null,this.$inputs=null,this};var e=a.fn.validator;a.fn.validator=c,a.fn.validator.Constructor=d,a.fn.validator.noConflict=function(){return a.fn.validator=e,this},a(window).on("load",function(){a('form[data-toggle="validator"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery);