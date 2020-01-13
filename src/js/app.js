$(function() {
	/*$('html, body').on('click', function(e) {
		if (e.target == document.documentElement) {
			$("html").removeClass("open-sidebar");
		}
	});

	$(".js-open-sidebar").on("click", function(){
		$("html").addClass("open-sidebar");
	});

	$("#regulamento").on("click", function(){
		if(this.checked) {
			$("#btn-inscricao").removeAttr("disabled");
			$("#btn-inscricao").removeClass("disabled");
		}
		else {
			$("#btn-inscricao").attr("disabled");
			$("#btn-inscricao").addClass("disabled");
		}
	});*/

	$("#logout").on("click", function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.logout.php",
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
						window.location.href = "./login.php";
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

	// BEGIN LOGIN (login)

	$("#form-login").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=login",
			data: $("#form-login").serialize(),
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						if(retorno.href.length > 0) {
							window.location.href = retorno.href;
						}
						else {
							window.location.href = './';
						}
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

	$("#btn-login").click(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=login",
			data: $("#form-login").serialize(),
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						if(retorno.href.length > 0) {
							window.location.href = retorno.href;
						}
						else {
							window.location.href = './';
						}
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

	$('#btn-esqueceu-senha').click(function(e) {
		e.preventDefault();

		$('.mainlogin').hide();
		$('.mainform').show();
	});

	$('#btn-recuperar-senha').click(function(e) {
		e.preventDefault();
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=reset",
			data: $("#form-recuperar").serialize(),
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

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
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});

	// END LOGIN (login)

	// BEGIN PROVISORIA (provisoria)

	$("#form-provisoria").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.provisoria.php",
			data: $(this).serialize(),
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Senha alterada com sucesso!");
						$('#alert-content').html('Sua senha foi alterada definitivamente com sucesso! Ao fechar a mensagem você será redirecionado para o site!');
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.href = './';
						});

					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
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

	$("#btn-provisoria").click(function(e) {
		e.preventDefault();
		$("#form-provisoria").submit();
	});

	// END PROVISORIA (provisoria)
	
	// BEGIN INSCRICAO (inscricao)

	if(window.location.pathname.indexOf('inscricao') !== -1) {

	    $('#nome_time').textext({
	        plugins : 'autocomplete ajax',
	        ajax : {
	            url : 'acts/acts.inscricao.php?act=times',
	            dataType : 'json',
	            cacheResults : true
	        }
	    });

		$('#btn-voltar-inscricao').click(function(e) {
			e.preventDefault();

			$('.premain').hide();
			$('.inscmain').show();
		});

		$('body').on('click', '.text-core .text-wrap .text-dropdown .text-list .text-suggestion', function(e) {
			var el = $(this).parent().parent().parent().parent().parent();
			buscaDadosTime(el);
	    });

	    $('#nome_time').on('keyup', function (e) {
		    if (e.keyCode == 13) {
				var el = $(this).parent().parent().parent();
				buscaDadosTime(el);
		    }
	    });
	 
	    function buscaDadosTime(el) {
	    	var nomeTime = el.find('#nome_time').val();

			var formData = new FormData();
			formData.append('nome_time', nomeTime);

			$('#loading-modal').modal({
				keyboard: false
			});

			$.ajax({
				type: "POST",
				url: "acts/acts.inscricao.php?act=dados_time",
				data : formData,
				processData: false,
				contentType: false,
				timeout: 0,
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
					    	$("#nome").val(retorno.nome);
					    	$("#email").val(retorno.email);
					    	$("#telefone").val(retorno.telefone);
					    	$("#id_time").val(retorno.id);

							$('#loading-modal').modal('hide');
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

					    	$("#nome").val("");
					    	$("#email").val("");
					    	$("#telefone").val("");
					    	$("#id_time").val("");

							$('#loading-modal').remove();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

				    	$("#nome").val("");
				    	$("#email").val("");
				    	$("#telefone").val("");
				    	$("#id_time").val("");

						$('#loading-modal').remove();
				    };
				}
			});
	    }

		$(".competicao").on("change", function(e) {
			var valor = parseFloat($("#valor").val().replace("R$", "").replace(",", "."));
			if($(this).is(":checked")) {
				valor = valor + $(this).data('money');
			}
			else {
				valor = valor - $(this).data('money');
			}

			$("#valor").val("R$ " + valor.toString().replace(".", ",") + ",00");
		});

		$("#form-inscricao").submit(function(e) {
			e.preventDefault();

			$('#loading-modal').modal({
				keyboard: false
			});

			$.ajax({
				type: "POST",
				url: "acts/acts.inscricao.php?act=add",
				data: $("#form-inscricao").serialize(),
				success: function(data)
				{
				    try {
						$('#loading-modal').modal('hide');

						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('.inscmain').fadeOut("fast", function() {
								$('#nome').val('');
								$('#email').val('');
								$('#telefone').val('');
								$('#nome_time').val('');
								//$('input[name="forma-pagto"]').prop('checked', false);
								$('.competicao').prop('checked', false);
								$('#regulamento').prop('checked', false);

						    	$("#id_time").val("");
								
								$('.premain').fadeIn("slow");
							});
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');
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
	}

	// END INSCRICAO (inscricao)

	// BEGIN INDEX (index)

	if(window.location.pathname.indexOf('destaques-rodada') === -1 && 
	   window.location.pathname.indexOf('tabela-cts') === -1 &&
	   window.location.pathname.indexOf('mata_mata') === -1 &&
	   window.location.pathname.indexOf('desempenho-grafico') === -1 &&
	   window.location.pathname.indexOf('eventos') === -1 &&
	   window.location.pathname.indexOf('inscricao') === -1 &&
	   window.location.pathname.indexOf('regulamento') === -1 &&
	   window.location.pathname.indexOf('login') === -1 &&
	   window.location.pathname.indexOf('logout') === -1 &&
	   window.location.pathname.indexOf('brasileirao') === -1 &&
	   window.location.pathname.indexOf('scouts') === -1 &&
	   window.location.pathname.indexOf('clubes-liga') === -1 &&
	   window.location.pathname.indexOf('dados_clube') === -1 &&
	   window.location.pathname.indexOf('meus_dados') === -1 &&
	   window.location.pathname.indexOf('provisoria') === -1 &&
	   window.location.pathname.indexOf('tempo-real') === -1 &&
	   window.location.pathname.indexOf('comparar') === -1) {
	   	
		/* Modal de Informações  */
		 /*$('#info').modal({
		 	keyboard: false
		 });*/

		 /* Modal Resumo da Rodada  */
		 $('#res-rodada').modal({
		 	keyboard: false
		 });

		if($('#resumo-temporada').length == 0) {
			// DESTAQUES RODADA
			$('#destaques-rodada').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.index.php?act=destaques-rodada",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						$('#destaques-rodada .card-block tbody').html('');

						if(retorno.succeed) {
							if(retorno.list.length > 0) {
								var c_times = 1;
								$.each(retorno.list, function(i, item) {
									var myTeamClass = "";
									if(item.isMyTeam)
										myTeamClass = "myteam";
									$('#destaques-rodada .card-block tbody').append('<tr class="bg-success '+myTeamClass+'"><th scope="row" class="table-title">' + c_times + 'º</th><td><img src="img/escudos/' + item.escudo + '" class="img-fluid"></td><td>' + item.time + '</td><td>' + item.pontuacao.toFixed(2) + '</td></tr>');
									c_times++;
								});
							}
							else {
								$('#destaques-rodada .card-block tbody').append('<tr class="bg-table"><td colspan="4" class="center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</td></tr>');
							}

							$('#destaques-rodada .card-block').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
							$('#destaques-rodada footer').fadeIn("slow");
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#destaques-rodada .card-block').hide();
							$('#destaques-rodada footer').hide();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#destaques-rodada .card-block').hide();
						$('#destaques-rodada footer').hide();
						$('#loading').remove();
				    };
				}
			});

			// DESEMPENHO POR RODADA (GRAFICO)
			$('#desempenho-rodada').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.index.php?act=desempenho-rodada",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
						$('#desempenho-rodada .card-ody tbody').html('');
						if(retorno.succeed) {
							if(retorno.series.length > 0 && retorno.series[0].data && retorno.series[0].data.length > 0) {
								$('#desempenho-rodada .card-body').append('<canvas id="chart-desempenho-rodada"></canvas>');
								$.each(retorno.series, function(i, item) {
									var color = getRandomColor();
									item["backgroundColor"] = color;
									item["borderColor"] = color;
								});
								var myChart = new Chart($("#chart-desempenho-rodada"), {
							    type: 'line',
							    data: {
							        labels: retorno.labels,
							        datasets: retorno.series
							    },
								options: {
									responsive: true,
									hoverMode: 'label',
									stacked: false,
									scales: {
										xAxes: [
											{
												display: false,
												gridLines: {
													offsetGridLines: false
												},
												ticks: {
													stepSize: 1, 
													callback: function(value, index, values) {
								                        return "Rodada " + value;
								                    }
												}
											}
										],
										yAxes: [
											{
												labelString: 'Posição na Liga',
												ticks: {
													reverse: true,
													stepSize: 1, 
													callback: function(value, index, values) {
								                        return value + "º";
								                    }
												}
											}
										]
									},
									legend: {
										position: 'bottom'
									},
									tooltips: {
									    callbacks: {
									        label: function(tooltipItem, data) {
									            var label = data.datasets[tooltipItem.datasetIndex].label || '';

									            if (label) {
									                label += ' - ';
									            }
									            label += tooltipItem.yLabel + 'º lugar';

											    try {
										            var rodada = tooltipItem.index + 1;
										            var time = data.datasets[tooltipItem.datasetIndex].label;

													var data = $.ajax({
														type: "POST",
														url: "acts/acts.rodada.php?act=pontuacao&rodada=" + rodada + "&time=" + time,
		        										async: false
													}).responseText;

													var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

													if(retorno.succeed)
					            						label += ' - ' + retorno.pontuacao + ' pts.';
											    }
											    catch (e) {
											    	console.log(e);
											    };

									            return label;
									        }
									    }
									}
								}
							});
							}
							else {
								$('#desempenho-rodada .card-block').append('<div class="bg-default center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');
							}

							$('#desempenho-rodada .card-body').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
							$('#desempenho-rodada footer').fadeIn("slow");
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#desempenho-rodada .card-body').hide();
							$('#desempenho-rodada footer').hide();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#desempenho-rodada .card-body').hide();
						$('#desempenho-rodada footer').hide();
						$('#loading').remove();
				    }
				}
			});
					
			// DESEMPENHO GERAL
			$('#desempenho-geral').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.index.php?act=desempenho-geral&limit=2",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						$('#desempenho-geral .card-body tbody').html('');

						if(retorno.succeed) {
							if(retorno.list.length > 0) {
								$.each(retorno.list, function(i, item) {
									var bg = "bg-table";
									if(i < 6) 
										bg = "text-success";

									var myTeamClass = "";
									if(item.isMyTeam)
										myTeamClass = "myteam";
									$('#desempenho-geral .card-body thead').append('<tr class="' + myTeamClass + '"><th scope="row" class="table-title ' + bg + '">' + item.posicao + 'º</th><td>' + item.time + '</td><td>' + item.pontuacao.toFixed(2) + '</td><td>' + item.variacao + '</td></tr>');
								});
							}
							else {
								$('#desempenho-geral .card-body tbody').append('<tr class="bg-table"><td colspan="5" class="center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</td></tr>');
							}

							$('#desempenho-geral .card-body').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
							$('#desempenho-geral footer').fadeIn("slow");
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#desempenho-geral .card-body').hide();
							$('#desempenho-geral footer').hide();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#desempenho-geral .card-body').hide();
						$('#desempenho-geral footer').hide();
						$('#loading').remove();
				    };
				}
			});

			// MATA-MATA EM ANDAMENTO
			$('#mata-mata-andamento').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.index.php?act=mata-mata-andamento",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						$('#mata-mata-andamento .card-block tbody').html('');

						if(retorno.succeed) {
							if(retorno.list.length > 0) {
								$.each(retorno.list, function(i, item) {
									$('#mata-mata-andamento .card-block').append('<div class="' + item.cor_fase + ' text-white"><i class="fa fa-trophy"></i> ' + item.nome + ' - ' + item.fase + '</div>');
								});
							}
							else {
								$('#mata-mata-andamento .card-block').append('<div class="bg-secondary center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');
							}

							$('#mata-mata-andamento .card-block').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
							$('#mata-mata-andamento footer').fadeIn("slow");
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#mata-mata-andamento .card-block').hide();
							$('#mata-mata-andamento footer').hide();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#mata-mata-andamento .card-block').hide();
						$('#mata-mata-andamento footer').hide();
						$('#loading').remove();
				    }
				}
			});

			// EVENTOS CALENDARIO 
			/*$('#eventos').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.index.php?act=eventos",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						$('#eventos .card-body').html('');

						if(retorno.succeed) {
						   	$('#calendar').fullCalendar({
	    						themeSystem: 'bootstrap4',
								defaultView: 'month',
								defaultDate: formatTodayEUDate(),
								eventRender: function(eventObj, $el) {
									$el.popover({
										content: function () {
							                return eventObj.description
							            },
	            						html: true,
										trigger: 'hover',
										placement: 'top',
										container: 'body'
									});
								},
								events: retorno.eventos,
	 							timeFormat: 'H:mm'
							});

							$('#eventos .card-body').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
							$('#eventos footer').fadeIn("slow");
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#eventos .card-body').hide();
							$('#eventos footer').hide();
							$('#loading').remove();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#eventos .card-body').hide();
						$('#eventos footer').hide();
						$('#loading').remove();
				    };
				}
			});*/
			$('#eventos').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.index.php?act=eventos",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						$('#eventos .card-body tbody').html('');

						if(retorno.succeed) {
						   	$('#calendar').fullCalendar({
	    						themeSystem: 'bootstrap4',
								defaultView: 'month',
								defaultDate: formatTodayEUDate(),
								eventRender: function(eventObj, $el) {
									$el.popover({
										content: function () {
							                return eventObj.description
							            },
	            						html: true,
										trigger: 'hover',
										placement: 'top',
										container: 'body'
									});
								},
								events: retorno.eventos,
	 							timeFormat: 'H:mm'
							});

							$('#eventos .card-body').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
							$('#eventos footer').fadeIn("slow");
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#eventos .card-body').hide();
							$('#eventos footer').hide();
							$('#loading').remove();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#eventos .card-block').hide();
						$('#eventos footer').hide();
						$('#loading').remove();
				    };
				}
			});
		} else {
			$('#resumo-temporada').append('<li class="loading-li"><div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div></li>');
			$.ajax({
				type: "POST",
				url: "acts/acts.index.php?act=resumo",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							if(retorno.list.length > 0) {
								var c_times = 1;
								$.each(retorno.list, function(i, item) {
									var desc_pos = "";

									if(c_times == 1) {
										desc_pos = "Campeão da Liga Cartoleirão Trabalho Seguro TS";
									}
									else if(c_times == 2) {
										desc_pos = "Vice Campeão da Liga Cartoleirão Trabalho Seguro TS";
									}
									else {
										desc_pos = c_times + "º Colocado da Liga Cartoleirão Trabalho Seguro TS";
									}

									var desc_pont = "";

									if(item.hasMaxPont) {
										desc_pont = '<p><span>Maior pontuador da liga em uma única rodada</span></p><h3>' + item.max_pont.toFixed(2) + ' <span style="font-size: 10px;">pontos</span></h3>';
									}

									$('#resumo-temporada').append('<li><figure><div class="card-temporada"><img src="img/escudos/' + item.escudo + '" class="temporada-escudo"><h3 class="temporada-clube">' + item.time + '</h3></div><figcaption><p><span>' + desc_pos + '</span></p><h3 class="temporada-pontos">' + item.pontuacao.toFixed(2) + ' <span style="font-size: 10px;">pontos</span></h3>' + desc_pont + '</figcaption></figure></li>');
									c_times++;
								});
							}
							else {
								$('#resumo-temporada').append('<li class="loading-li"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</li>');
							}

							$('#resumo-temporada li').fadeIn("slow", function() {
								$('.loading-li').fadeOut();
								$('.loading-li').remove();
								$('#resumo-temporada li').css('display', "inline-block");
							});
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#resumo-temporada').html("");
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#resumo-temporada').html("");
				    };
				}
			});

			$('#resumo-mata-mata').append('<li class="loading-li"><div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div></li>');
			$.ajax({
				type: "POST",
				url: "acts/acts.index.php?act=res-mata",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							if(retorno.list.length > 0) {
								$.each(retorno.list, function(i, item) {
									var img_taca = "";

									if(item.mata_mata.toLowerCase().indexOf('kempes') > -1) {
										img_taca = "kempes.png";
									}
									else if(item.mata_mata.toLowerCase().indexOf('beer') > -1) {
										img_taca = "copa-beer.png";
									}
									else {
										img_taca = "taca-default.png";
									}

									$('#resumo-mata-mata').append('<li><figure><div class="card-temporada"><img src="img/escudos/' + item.escudo + '" class="temporada-escudo"><h3 class="temporada-clube">' + item.time + '</h3></div><figcaption><img src="img/fimtemporada/' + img_taca + '" class="taca-temp"><p class="temp-torneio"><span>' + item.mata_mata + '</span></p></figcaption></figure></li>');
								});
							}
							else {
								$('#resumo-mata-mata').append('<li class="loading-li"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</li>');
							}

							$('#resumo-mata-mata li').fadeIn("slow", function() {
								$('.loading-li').fadeOut();
								$('.loading-li').remove();
								$('#resumo-mata-mata li').css('display', "inline-block");
							});
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#resumo-mata-mata').html("");
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#resumo-temporada').html("");
				    };
				}
			});

			$('#btn-dados-time').on("click", function(e) {
	    		e.preventDefault();

				$('#loading-modal').modal({
					keyboard: false
				});

	    		$.ajax({
					type: "POST",
					url: "acts/acts.index.php?act=dados-time",
					success: function(data)
					{
						try {
							var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
						
							$('#loading-modal').modal('hide');

							if(retorno.succeed) {

								$('.temp-escudo').attr('src', 'img/escudos/' + retorno.escudo);
								$('.temp-nome').html(retorno.nome_time);
								$('.pont-result').html(retorno.total_pontos.toFixed(2) + '<span>pts</span>');
								$('.media-result').html(retorno.media.toFixed(2) + '<span>média</span>');

								$('.total-g').html(retorno.total_g.toFixed(2));
								$('.total-l').html(retorno.total_l.toFixed(2));
								$('.total-z').html(retorno.total_z.toFixed(2));
								$('.total-m').html(retorno.total_m.toFixed(2));
								$('.total-a').html(retorno.total_a.toFixed(2));
								$('.total-t').html(retorno.total_t.toFixed(2));
								$('.maior-j').html(retorno.maior_j.toFixed(2));
								$('.menor-j').html(retorno.menor_j.toFixed(2));
								$('.maior-c').html(retorno.maior_c.toFixed(2));
								$('.menor-c').html(retorno.menor_c.toFixed(2));

								$('.max-pont').html(retorno.max_pontos.toFixed(2));
								$('.max-rodada').html('Maior pontuação <br />' + retorno.max_rodada + 'º Rodada');
								$('.min-pont').html(retorno.min_pontos.toFixed(2));
								$('.min-rodada').html('Menor pontuação <br />' + retorno.min_rodada + 'º Rodada');
								$('.patrimonio').html('C$' + retorno.patrimonio.toFixed(2));

								$('#main-resumo').fadeOut("fast", function() {
									$('#main-clube').fadeIn("slow");
								});
							}
							else {
								$('#loading-modal').modal('hide');
								$('#alert-title').html(retorno.title);
								$('#alert-content').html(retorno.errno + " - " + retorno.erro);
								$('#alert').modal('show');
								$('#main-resumo').show();
								$('#main-clube').hide();
							}
					    }
					    catch (e) {
							$('#loading-modal').modal('hide');
							$('#alert-title').html("Erro ao fazer parse do JSON!");
							$('#alert-content').html(String(e.stack));
							$('#alert').modal('show');
							$('#main-resumo').show();
							$('#main-clube').hide();
					    }
					}
				});
			});
		}
	}

	// END INDEX (index)

	// BEGIN DESTAQUES (destaques)

	if(window.location.pathname.indexOf('destaques-rodada') !== -1) {

		// DESTAQUES RODADA
		$('#destaques').append('<div class="col-12" id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.destaques.php",
			success: function(data)
			{
			    try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						if(retorno.list.length > 0) {
							var rodada = "";
							var c_times = 0;
							$.each(retorno.list, function(i, item) {
								var myTeamClass = "";
								if(item.isMyTeam)
									myTeamClass = "bg-warning";

								if(rodada != item.rodada) {
									$('#destaques').append('<div class="col-sm-4"><div class="card"><div class="card-header headline">Destaques da ' + item.rodada + 'º rodada</div><div class="card-body"><table class="table table-hover table-cartoleirao"><thead><tr><th scope="col">#</th><th scope="col">Escudo</th><th scope="col">Clube</th><th scope="col">Pontos</th></tr></thead><tbody id="body_' + item.rodada + '">');
									rodada = item.rodada;
									c_times = 0;
								}
								if(c_times < 4){
									$('#body_' + item.rodada).append('<tr class="'+myTeamClass+'"><th class="text-success" scope="row">' + (c_times+1) + 'º</th><td><img src="img/escudos/' + item.escudo + '" class="shield-club"></td><td>' + item.time + '</td><td>' + parseFloat(Math.round(item.pontuacao * 100) / 100).toFixed(2) + '</td></tr>');
								}
								c_times++;
							});
						}
						else {
							$('#destaques').append('<div class="col-12 center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');
						}
						
						$('#loading').fadeOut("fast", function() {
							$('#destaques .col-sm-4').fadeIn("slow");
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#destaques .col-sm-4').hide();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#destaques .col-sm-4').hide();
					$('#loading').remove();
			    };
			}
		});
	}

	// END DESTAQUES (destaques)

	// BEGIN LIGA (liga)

	if(window.location.pathname.indexOf('tabela-cts') !== -1) {
				
		// DESEMPENHO GERAL
		$('#desempenho-liga').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.liga.php",
			success: function(data)
			{
			    try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('#desempenho-liga .card-block tbody').html('');

					if(retorno.succeed) {
						var rebaixamento = retorno.list.length - 4;
						if(retorno.list.length > 0) {
							$.each(retorno.list, function(i, item) {
								var bg = "text-secondary";
								if(i < 6) 
									bg = "text-success";
								if(i > 6 && i >= rebaixamento) 
									bg = "text-danger";

								var myTeamClass = "";
								if(item.isMyTeam)
									myTeamClass = "bg-warning";

								var maxPontImg = "";
								if(item.hasMaxPont)
									maxPontImg = "<i class='fas fa-award text-primary'></i>";
								$('#desempenho-liga .card-body tbody').append('<tr class="' + myTeamClass+'"><th scope="row" class="' + bg + '">' + item.posicao + 'º</th><td><img class="shield-club" src="img/escudos/' + item.escudo + '"></td><td>' + maxPontImg + item.time + '</td><td>' + item.pontuacao.toFixed(2) + '</td><td>' + item.pont_ult_rodada.toFixed(2) + '</td><td>' + item.variacao + '</td></tr>');
							});

							$('.table-cartoleirao').tablesorter({
								dateFormat: 'pt', 
								sortList: [[3,1]], 
						        headers: { 
						            1: { 
						                sorter: false 
						            }, 
						            5: { 
						                sorter: false 
						            } 
						        }
						    });
						}
						else {
							$('#desempenho-liga .card-block tbody').append('<tr class="bg-table"><td colspan="6" class="center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</td></tr>');
						}

						$('#loading').fadeOut("fast", function() {
							$('#desempenho-liga .card-block').fadeIn("slow");
							$('#desempenho-liga footer').fadeIn("slow");
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#desempenho-liga .card-block').hide();
						$('#desempenho-liga footer').hide();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#desempenho-liga .card-block').hide();
					$('#desempenho-liga footer').hide();
					$('#loading').remove();
			    };
			}
		});
	}

	// END LIGA (liga)

	// BEGIN MATA-MATA (mata_mata)

	if(window.location.pathname.indexOf('mata_mata') !== -1) {

		// MATA-MATA
		$('#mata-mata').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.mata_mata.php?act=mata-mata",
			success: function(data)
			{
				try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						if(retorno.list.length > 0) {
							retorno.list.sort(function(a,b) {return (a.ordem > b.ordem) ? 1 : ((b.ordem > a.ordem) ? -1 : 0);} ); 

							var fase = "";
							$.each(retorno.list, function(i, item) {
								if(fase != item.fase) {
									//$('#mata-mata').append('<div class="' + item.cor_fase + ' text-white"><i class="fa fa-trophy"></i> Mata Mata - ' + item.fase + '</div><div class="row" id="body_' + item.cor_fase + '">');
									$('#mata-mata').append('<p class="card-text">' + item.fase + '</p>');
									fase = item.fase;
								}

								$('#body_' + item.cor_fase).append('<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mata-and"><a href="#" class="open-confrontos" data-id="' + item.id + '"><img src="img/' + item.imagem + '" class="rounded img-fluid" alt="Mata Mata ' + item.fase + '"><h2 class="headline">' + item.nome + '</h2></a></div>');
							});
						}
						else {
							$('#mata-mata').append('<div class="col-12 center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');
						}
						
						$('#loading').fadeOut("fast", function() {
							$('#mata-mata .bg-info').fadeIn("slow");
							$('#mata-mata .bg-success').fadeIn("slow");
							$('#mata-mata .bg-danger').fadeIn("slow");
							$('#mata-mata .mata-and').fadeIn("slow");
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#mata-mata .bg-info').hide();
						$('#mata-mata .bg-success').hide();
						$('#mata-mata .bg-danger').hide();
						$('#mata-mata .mata-and').hide();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#mata-mata .bg-info').hide();
					$('#mata-mata .bg-success').hide();
					$('#mata-mata .bg-danger').hide();
					$('#mata-mata .mata-and').hide();
					$('#loading').remove();
			    }
			}
		});

		$('body').on('click', '.open-confrontos', function(e) {
    		e.preventDefault();

			$('#loading-modal').modal({
				keyboard: false
			});

    		var id = $(this).data('id');

    		$.ajax({
				type: "POST",
				url: "acts/acts.mata_mata.php?act=confrontos&idmatamata=" + id,
				success: function(data)
				{
					try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
					
						$('#loading-modal').modal('hide');

						if(retorno.succeed) {
							$('#nome-mata-mata').html(retorno.mata_mata);
							
							if(retorno.list.length > 0) {
								$.each(retorno.list, function(n, nivel) {
									if(nivel.chave == 1) {
										$('#nav-niveis').append('<li class="nav-item"><a class="nav-link' + nivel.active + '" data-toggle="tab" href="#nivel' + nivel.nivel + '">' + nivel.fase + '</a></li>');
										$('#nav-confrontos').append('<div id="nivel' + nivel.nivel + '" class="tab-pane' + nivel.active + '"><h4 class="confrontos">Confrontos</h4><div class="row" id="cards' + nivel.nivel + '" >');
									}

									$.each(nivel.confrontos, function(c, confronto) {
										var desc_chave = 'Chave ' + confronto.chave;
										if(nivel.nivel == 1) {
											if(confronto.chave == 1)
												desc_chave = '<b>Final</b>';
											else
												desc_chave = '3º lugar';
										}
										var pont_time_1 = parseFloat(confronto.pontuacao_time_1);
										var pont_time_2 = parseFloat(confronto.pontuacao_time_2);
										$('#cards' + nivel.nivel).append('<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6"><div class="card"><p class="rodada_anda">' + desc_chave + '</p><div class="card-block confronto"><div class="col-sm-6"><img src="img/escudos/' + confronto.escudo_time_1 + '" class="img-fluid center-block"><p class="clube">' + (pont_time_1 > pont_time_2 ? "<b>" + confronto.time_1 + "</b>" : confronto.time_1) + '</p><p class="pontuacao">' + pont_time_1 + '</p></div><p class="vs">X</p><div class="col-sm-6"><img src="img/escudos/' + confronto.escudo_time_2 + '" class="img-fluid center-block"><p class="clube">' + (pont_time_2 > pont_time_1 ? "<b>" + confronto.time_2 + "</b>" : confronto.time_2) + '</p><p class="pontuacao">' + pont_time_2 + '</p></div></div><p class="chaveamento">Rodada em andamento (Pontuação parcial)</p></div>');
									});
								});

								if($("#nav-niveis a.active").length == 0) {
									$("#nav-niveis a.nav-link").first().click();
								}
							}
							else {
								$('#nao-ha-dados').show();
							}
			
							$('#mainmata').fadeOut("fast", function() {
								$('#mainconfrontos').fadeIn("slow");
							});
						}
						else {
							$('#nome-mata-mata').html('');
							$('#nav-niveis').html('');
							$('#nav-confrontos').html('');
							$('#nao-ha-dados').hide();

							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');
						}
				    }
				    catch (e) {
						$('#nome-mata-mata').html('');
						$('#nav-niveis').html('');
						$('#nav-confrontos').html('');
						$('#nao-ha-dados').hide();

						$('#loading-modal').modal('hide');
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');
				    }
				}
			});
		});

		$('#voltar-mata-mata').click(function(e) {
    		e.preventDefault();

			$('#nome-mata-mata').html('');
			$('#nav-niveis').html('');
			$('#nav-confrontos').html('');
			$('#nao-ha-dados').hide();

			$('#mainconfrontos').fadeOut("fast", function() {
				$('#mainmata').fadeIn("slow");
			});
		});
	}

	// END MATA-MATA (mata_mata)

	// BEGIN RODADA (rodada)

	if(window.location.pathname.indexOf('desempenho-grafico') !== -1) {

		// DESEMPENHO GERAL
		$('#pontrodada').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.rodada.php?act=rodada-rodada",
			success: function(data)
			{
			    try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('#pontrodada .table-responsive tbody').html('');

					if(retorno.succeed) {
						if(retorno.linhas.length > 0) {
							$('#pontrodada .table-responsive thead').append(retorno.cabecalho);
							$.each(retorno.linhas, function(i, item) {
								$('#pontrodada .table-responsive tbody').append(item.linha);
							});
						}
						else {
							$('#pontrodada .table-responsive tbody').append('<tr class="bg-table"><td colspan="42" class="center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</td></tr>');
						}

						$('#loading').fadeOut("fast", function() {
							$('#pontrodada .table-responsive').fadeIn("slow");
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#pontrodada .table-responsive').hide();
						$('#loading').remove();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#pontrodada .table-responsive').hide();
					$('#loading').remove();
			    };
			}
		});

		// DESEMPENHO POR RODADA (GRAFICO)
		$('#grafico-rodada').append('<div id="loading-grafico"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.rodada.php?act=grafico-rodada",
			success: function(data)
			{
			    try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
					$('#grafico-rodada .card-body tbody').html('');
					if(retorno.succeed) {
						if(retorno.series.length > 0 && retorno.series[0].data && retorno.series[0].data.length > 0) {
							$('#grafico-rodada .card-body').append('<canvas id="chart-grafico-rodada"></canvas>');
							$.each(retorno.series, function(i, item) {
								var color = getRandomColor();
								item["backgroundColor"] = color;
								item["borderColor"] = color;
							});
							var myChart = new Chart($("#chart-grafico-rodada"), {
						    type: 'line',
						    data: {
						        labels: retorno.labels,
						        datasets: retorno.series
						    },
							options: {
								responsive: true,
								hoverMode: 'label',
								stacked: false,
								scales: {
									xAxes: [
										{
											display: false,
											gridLines: {
												offsetGridLines: false
											},
											ticks: {
												stepSize: 1, 
												callback: function(value, index, values) {
							                        return "Rodada " + value;
							                    }
											}
										}
									],
									yAxes: [
										{
											labelString: 'Posição na Liga',
											ticks: {
												reverse: true,
												stepSize: 1, 
												callback: function(value, index, values) {
							                        return value + "º";
							                    }
											}
										}
									]
								},
								legend: {
									position: 'bottom'
								},
								tooltips: {
								    callbacks: {
								        label: function(tooltipItem, data) {
								            var label = data.datasets[tooltipItem.datasetIndex].label || '';

								            if (label) {
								                label += ' - ';
								            }
							            	label += tooltipItem.yLabel + 'º lugar';

										    try {
									            var rodada = tooltipItem.index + 1;
									            var time = data.datasets[tooltipItem.datasetIndex].label;

												var data = $.ajax({
													type: "POST",
													url: "acts/acts.rodada.php?act=pontuacao&rodada=" + rodada + "&time=" + time,
	        										async: false
												}).responseText;

												var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
												if(retorno.succeed)
				            						label += ' - ' + retorno.pontuacao + ' pts.';
										    }
										    catch (e) {
										    	console.log(e);
										    };

								            return label;
								        }
								    }
								}
							}
						});
						}
						else {
							$('#grafico-rodada .card-body').append('<div class="bg-default center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');
						}

						$('#grafico-rodada .card-body').fadeIn("slow", function() {
							$('#loading-grafico').fadeOut();
							$('#loading-grafico').remove();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#grafico-rodada .card-body').hide();
						$('#loading-grafico').remove();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#grafico-rodada .card-body').hide();
					$('#loading-grafico').remove();
			    }
			}
		});
	}
	
	// END RODADA (rodada)

	// BEGIN EVENTOS (eventos)

	if(window.location.pathname.indexOf('eventos') !== -1) {

		$('#eventos-container').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.eventos.php?act=listagem-eventos",
			success: function(data)
			{
			    try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						if(retorno.eventos.length > 0) {
							$.each(retorno.eventos, function(i, evento) {
								var data = new Date(evento.data * 1000);
								var acoes = "";
								var selector = "";
								if(new Date() <= data) {
									selector = "#proximos-eventos";
									if(evento.confirmado) {
										acoes = '<a href="#" data-id="' + evento.id + '" class="btn btn-danger btn-remover-presenca"><i class="fa fa-ban"></i> Não vou poder ir mais</a>';
									}
									else {
										acoes = '<a href="#" data-id="' + evento.id + '" class="btn btn-success btn-confirmar-presenca"><i class="fa fa-check"></i> Confirmar Presença</a>';
									}
									acoes += '<span style="margin-left: 30px;"><b>' + evento.participantes + '</b> cartoleiros vão no evento!</span>';
								}
								else {
									selector = "#eventos-passados";
									acoes = '<p style="margin-top: 35px; margin-bottom: 0px;"><b>' + evento.participantes + '</b> cartoleiros foram a esse evento!</p>';
								}

								$(selector).append('<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 eventos-card"><div class="card"><div class="card-block"><h4 class="card-title">' + evento.titulo + '</h4><h6 class="card-subtitle mb-2 text-muted">Data: ' + formatDate(evento.data * 1000) + '</h6><p>Local: ' + evento.local + '</p><p class="card-text">' + evento.descricao + '</p>' + acoes + '</div></div></div>');
							});
						}

						if(retorno.eventos.length == 0) {
							$('#eventos-container').append('<div class="col-12 center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');
						}


						$('#loading').fadeOut("fast", function() {
							if($('#proximos-eventos').children().length > 0) {
								$('#proximos-eventos').fadeIn("slow");
								$('#eventos-container .bg-success').fadeIn("slow");
							}

							if($('#eventos-passados').children().length > 0) {
								$('#eventos-passados').fadeIn("slow");
								$('#eventos-container .bg-info').fadeIn("slow");
							} 

							if($('#proximos-eventos').children().length == 0 && $('#eventos-passados').children().length == 0) {
								$('#eventos-container .bg-success').fadeIn("slow");
								$('#eventos-container .infor').fadeIn("slow");
							}
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#proximos-eventos').hide();
						$('#eventos-passados').hide();
						$('#eventos-container .bg-success').hide();
						$('#eventos-container .bg-info').hide();
						$('#loading').remove();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#proximos-eventos').hide();
					$('#eventos-passados').hide();
					$('#eventos-container .bg-success').hide();
					$('#eventos-container .bg-info').hide();
					$('#loading').remove();
			    };
			}
		});

		$('body').on('click', '.btn-confirmar-presenca', function(e) {
			e.preventDefault();

			$('#loading-modal').modal({
				keyboard: false
			});

    		var id = $(this).data('id');

			$.ajax({
				type: "POST",
				url: "acts/acts.eventos.php?act=confirmar-presenca&idevento=" + id,
				success: function(data)
				{
				    try {
						$('#loading-modal').modal('hide');

						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('#alert-title').html("Presença confirmada com sucesso!");
							$('#alert-content').html("Você confirmou sua presença no evento com sucesso! Ao fechar esta mensagem a página será recarregada.");
							$('#alert').modal('show');

							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.reload();
							});
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

		$('body').on('click', '.btn-remover-presenca', function(e) {
			e.preventDefault();

			$('#loading-modal').modal({
				keyboard: false
			});

    		var id = $(this).data('id');

			$.ajax({
				type: "POST",
				url: "acts/acts.eventos.php?act=remover-presenca&idevento=" + id,
				success: function(data)
				{
				    try {
						$('#loading-modal').modal('hide');

						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('#alert-title').html("Presença removida com sucesso!");
							$('#alert-content').html("Não vai mais, arregão? A patroa não deixou? Fazer o que! Ao fechar esta mensagem a página será recarregada.");
							$('#alert').modal('show');

							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.reload();
							});
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
	}
	
	// END EVENTOS (eventos)

	// BEGIN MEUS DADOS (meus_dados)

	$("#form-meus-dados").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.meus_dados.php",
			data: $("#form-meus-dados").serialize(),
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#nome').val('');
						$('#email').val('');
						$('#telefone').val('');
						$('#senha').val('');
						$('#senha2').val('');

						$('#alert-title').html("Dados alterados com sucesso!");
						$('#alert-content').html("Você alterou seus dados com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#nome').val('');
						$('#email').val('');
						$('#telefone').val('');
						$('#senha').val('');
						$('#senha2').val('');
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#nome').val('');
					$('#email').val('');
					$('#telefone').val('');
					$('#senha').val('');
					$('#senha2').val('');
			    };
			}
		});
	});

	// END MEUS DADOS (meus_dados)

	// BEGIN DADOS CLUBE (dados_clube)

	$("#form-dados-clube").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		var formData = new FormData();
		formData.append('time', $('#time').val());
		formData.append('historia', $('#historia').val());
		formData.append('ano_fundacao', $('#ano_fundacao').val());
		formData.append('brasao', $('#brasao')[0].files[0]);

		$.ajax({
			type: "POST",
			url: "acts/acts.dados_clube.php",
			data : formData,
			processData: false,
			contentType: false,
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#time').val('');
						$('#historia').val('');
						$('#ano_fundacao').val('');
						$('#brasao').val('');

						$('#alert-title').html("Dados alterados com sucesso!");
						$('#alert-content').html("Você alterou os dados do seu clube com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#time').val('');
						$('#historia').val('');
						$('#ano_fundacao').val('');
						$('#brasao').val('');
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#time').val('');
					$('#historia').val('');
					$('#ano_fundacao').val('');
					$('#brasao').val('');
			    };
			}
		});
	});

	// END MEUS DADOS (meus_dados)

	// BEGIN CLUBE (clube)

	if(window.location.pathname.indexOf('clubes-liga') !== -1) {

		// HISTORIA DO CLUBE
		$('#escudos-container').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.clube.php?act=escudos",
			success: function(data)
			{
			    try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('.escudos').html('');

					if(retorno.succeed) {
						if(retorno.list.length > 0) {
							$.each(retorno.list, function(i, item) {
								$('.escudos').append('<option class="btn-historia-clube" value="' + item.id +'">' + item.time + '</option>');
							});

							$('.escudos').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});

    						loadHistoryFromClube(retorno.id_clube_default);
						}
						else {
							$('#escudos-container').append('<div class="col-12 center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');
							
							$('#escudos-container .infor').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
						}
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('.escudos').hide();
						$('#escudos-container .infor').hide();
						$('#loading').remove();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('.escudos').hide();
					$('#escudos-container .infor').hide();
					$('#loading').remove();
			    };
			}
		});

		$('body').on('click', '.btn-historia-clube', function(e) {
			e.preventDefault();
    		loadHistoryFromClube($(this).data('id'));
		});

		function loadHistoryFromClube(idclube) {
			$('#loading-modal').modal({
				keyboard: false
			});
			$.ajax({
				type: "POST",
				url: "acts/acts.clube.php?act=historia&idclube=" + idclube,
				success: function(data)
				{
				    try {
						$('#loading-modal').modal('hide');

						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('.brasao').prop("src", "img/escudos/" + retorno.escudo);
							$('.nome_time').html(retorno.nome_time);
							$('.ano_fundacao').html(retorno.ano_fundacao);
							$('.nome_presidente').html(retorno.nome_presidente);
							$('.text-hitoria').html(retorno.historia);
									
							$('.nav-temporada').html('');
							if(retorno.list_temp.length > 0) {
								$.each(retorno.list_temp, function(t, temp) {
									if(temp.is_actual) {
										$('.nav-temporada').append('<a class="nav-link btn btn-performance disabled" id="pills' + temp.id + '" data-toggle="pill" href="#a' + temp.id + '" role="tab" aria-controls="pills-home" aria-selected="true">' + temp.temporada + '</a>');
									}
									else {
										var role = "";																				
										if(t == 0) {
											role = 'role="tab"';																						
										}
										$('.nav-temporada').append('<a class="nav-link btn btn-performance" id="pills' + temp.id + '" data-toggle="pill" href="#a' + temp.id + '" aria-controls="pills-home" aria-selected="true" data-time-id="' + idclube + '" ' + role + '>' + temp.temporada + '</a>');
										$('.tab-content').append('<div class="tab-pane fade show" id="a' + temp.id + '" role="tabpanel" aria-labelledby="pills' + temp.id + '"></div>');
										//<div class="card-seasons"><h5 class="headline">Temporada ' + temp.temporada + ' </h5><p><i class="fas fa-table text-info"></i> <span>'+ temp +'º colocado</span></p><p><i class="far fa-arrow-alt-circle-up text-success"></i></p><p><i class="far fa-arrow-alt-circle-down text-danger"></i></p><p><i class="fas fa-chart-line text-primary"></i></p></div>
									}
								});
							}
									
							$('.geral-campeonatos').html('');
							if(retorno.list_camps.length > 0) {
								retorno.list_camps.sort(function(a,b) {
								    return b.temporada - a.temporada;
								});

								$.each(retorno.list_camps, function(t, temp) {
									if(temp.tipo == "liga") {
										var status_liga = "";
										if(temp.posicao == 1) {
											status_liga = '<i class="fas fa-medal"></i>';
										} else {
											status_liga = '<h2 class="posicao">' + temp.posicao + 'º</h2>';
										}
										$('.geral-campeonatos').append('<div class="col-sm-4 col-md-4 col-lg-3 col-xl-3">' + status_liga + '<h3 class="nome-torneio">Cartolas sem cartola</h3><p class="ano">' + temp.temporada + '</p></div>');
									}

									if(temp.tipo == "mata_mata") {
										var status_mm = "";
										if(temp.campeao) {
											if(temp.mata_mata.toLowerCase().indexOf("kempes") >= 0) {
												status_mm = '<i class="fas fa-trophy"></i>';
											} else {
												status_mm = '<i class="fas fa-trophy"></i>';
											}
										} else {
											status_mm = '<h2 class="posicao">X</h2>';
										}
										$('.geral-campeonatos').append('<div class="col-sm-4 col-md-4 col-lg-3 col-xl-3">' + status_mm + '<h3 class="nome-torneio">' + temp.mata_mata + '</h3><p class="ano">' + temp.temporada + '</p></div>');
									}
								});
							}

							$('.desempenho-geral').click();
						}
						else {
							$('.brasao').prop("src", "");
							$('.nome_time').html('');
							$('.ano_fundacao').html('');
							$('.nome_presidente').html('');
							$('.text-hitoria').html('');
							$('.nav-temporada').html('');
							$('.geral-campeonatos').html('');

							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');
						}
				    }
				    catch (e) {
						$('.brasao').prop("src", "");
						$('.nome_time').html('');
						$('.ano_fundacao').html('');
						$('.nome_presidente').html('');
						$('.text-hitoria').html('');
						$('.nav-temporada').html('');
						$('.geral-campeonatos').html('');

						$('#loading-modal').modal('hide');
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');
				    };
				}
			});
		}

		$('body').on('click', '.dropdown-item', function(e) {
			e.preventDefault();

			var container = $(this).attr('href');
			var idano = $(this).attr('href').replace('#a', '');
			var idtime = $(this).data('time-id');

			$(container).append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.clube.php?act=paineis&idano=" + idano + "&idtime=" + idtime,
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$(container).html('');

							//<div class="card-seasons"><h5 class="headline">Temporada ' + temp.temporada + ' </h5><p><i class="fas fa-table text-info"></i> <span>'+ temp +'º colocado</span></p><p><i class="far fa-arrow-alt-circle-up text-success"></i></p><p><i class="far fa-arrow-alt-circle-down text-danger"></i></p><p><i class="fas fa-chart-line text-primary"></i></p></div>
							$(container).append('<div class="row painel-' + idano + '"><h5 class="headline">Temporada ' + temp.temporada + ' </h5></div>');
							//$(container).append('<div class="col-12 historia painel-' + idano + '"><div id="container-' + idano + '" class="row"></div><div class="btn btn-lg btn-primary btn-temporada"><a href="#" class="link-temporada" data-id-ano="' + idano + '">Confira sua pontuação detalhada da temporada ' + retorno.temporada + '</a></div></div>');

							if(retorno.list_camps.length > 0) {
								$.each(retorno.list_camps, function(t, temp) {
									if(temp.tipo == "liga") {
										var status_liga = "";
										if(temp.posicao == 1) {
											status_liga = '<i class="fas fa-trophy"></i>';
										} else {
											status_liga = '<p><i class="fas fa-table text-info"></i> <span>'+ temp.posicao +'º colocado</span></p>';
										}
										$('#container-' + idano).append('<div class="col-sm-4 col-md-4 col-lg-3 col-xl-3">' + status_liga + '<h3 class="nome-torneio">Cartoleirão Trabalho Seguro TS</h3><p class="ano">' + temp.temporada + '</p></div>');
									}

									if(temp.tipo == "mata_mata") {
										var status_mm = "";
										if(temp.campeao) {
											if(temp.mata_mata.toLowerCase().indexOf("kempes") >= 0) {
												status_mm = '<img src="img/mata-mata-kempes.png" class="img-fluid center-block">';
											} else {
												status_mm = '<img src="img/mata-mata.png" class="img-fluid center-block">';
											}
										} else {
											status_mm = '<h2 class="posicao">Eliminado</h2>';
										}
										$('#container-' + idano).append('<div class="col-sm-4 col-md-4 col-lg-3 col-xl-3">' + status_mm + '<h3 class="nome-torneio">' + temp.mata_mata + '</h3><p class="ano">' + temp.temporada + '</p></div>');
									}
								});
							}	

							$('#container-' + idano).append('<div class="col-sm-4 col-md-4 col-lg-3 col-xl-3"><h2 class="pontuacao_temp">' + retorno.max_pontos + '</h2><h3 class="nome-torneio">Maior pontuação</h3><p class="ano">' + retorno.temporada + '</p></div>');
							$('#container-' + idano).append('<div class="col-sm-4 col-md-4 col-lg-3 col-xl-3"><h2 class="pontuacao_temp">' + retorno.min_pontos + '</h2><h3 class="nome-torneio">Menor pontuação</h3><p class="ano">' + retorno.temporada + '</p></div>');
							$('#container-' + idano).append('<div class="col-sm-4 col-md-4 col-lg-3 col-xl-3"><h2 class="pontuacao_temp">' + retorno.media + '</h2><h3 class="nome-torneio">Média de pontos</h3><p class="ano">' + retorno.temporada + '</p></div>');

							$('.painel-' + idano).fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');
						
							$('#loading').remove();
							$(container).html('');
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#loading').remove();
						$(container).html('');
				    }
				}
			});
		});

		$('body').on('click', '.link-temporada', function(e) {
			e.preventDefault();

			$('#mainclube').fadeOut("fast", function() {
				$('#maindetold').fadeIn("slow");
			});

			var id = $(this).data('id-ano');

			// DESEMPENHO GERAL
			$('#pontrodada').append('<div id="loading-tab"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.rodada.php?act=rodada-rodada&idano=" + id,
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
						$('.info-ano').html(retorno.temporada);
						$('#pontrodada .table-responsive thead').html('');
						$('#pontrodada .table-responsive tbody').html('');

						if(retorno.succeed) {
							if(retorno.linhas.length > 0) {
								$('#pontrodada .table-responsive thead').append(retorno.cabecalho);
								$.each(retorno.linhas, function(i, item) {
									$('#pontrodada .table-responsive tbody').append(item.linha);
								});
							}
							else {
								$('#pontrodada .table-responsive tbody').append('<tr class="bg-table"><td colspan="42" class="center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</td></tr>');
							}

							$('#loading-tab').fadeOut("fast", function() {
								$('#pontrodada .table-responsive').fadeIn("slow");
							});
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#pontrodada .table-responsive').hide();
							$('#loading-tab').remove();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#pontrodada .table-responsive').hide();
						$('#loading-tab').remove();
				    };
				}
			});

			// DESEMPENHO POR RODADA (GRAFICO)
			$('#grafico-rodada').append('<div id="loading-grafico"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.rodada.php?act=grafico-rodada&idano=" + id,
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
						$('#grafico-rodada .card-body tbody').html('');
						$('#grafico-rodada .card-body .infor').remove();
						$('#chart-grafico-rodada').remove();

						if(retorno.succeed) {
							$('.info-ano').html(retorno.temporada);
							
							if(retorno.series.length > 0 && retorno.series[0].data && retorno.series[0].data.length > 0) {
								$('#grafico-rodada .card-block').append('<canvas id="chart-grafico-rodada"></canvas>');
								$.each(retorno.series, function(i, item) {
									var color = getRandomColor();
									item["backgroundColor"] = color;
									item["borderColor"] = color;
								});
								var myChart = new Chart($("#chart-grafico-rodada"), {
							    type: 'line',
							    data: {
							        labels: retorno.labels,
							        datasets: retorno.series
							    },
								options: {
									responsive: true,
									hoverMode: 'label',
									stacked: false,
									scales: {
										xAxes: [
											{
												display: false,
												gridLines: {
													offsetGridLines: false
												},
												ticks: {
													stepSize: 1, 
													callback: function(value, index, values) {
								                        return "Rodada " + value;
								                    }
												}
											}
										],
										yAxes: [
											{
												labelString: 'Posição na Liga',
												ticks: {
													reverse: true,
													stepSize: 1, 
													callback: function(value, index, values) {
								                        return value + "º";
								                    }
												}
											}
										]
									},
									legend: {
										position: 'bottom'
									},
									tooltips: {
									    callbacks: {
									        label: function(tooltipItem, data) {
									            var label = data.datasets[tooltipItem.datasetIndex].label || '';

									            if (label) {
									                label += ' - ';
									            }
								            	label += tooltipItem.yLabel + 'º lugar';

											    try {
										            var rodada = tooltipItem.index + 1;
										            var time = data.datasets[tooltipItem.datasetIndex].label;

													var data = $.ajax({
														type: "POST",
														url: "acts/acts.rodada.php?act=pontuacao&rodada=" + rodada + "&time=" + time + "&idano=" + id,
		        										async: false
													}).responseText;

													var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
													if(retorno.succeed)
					            						label += ' - ' + retorno.pontuacao + ' pts.';
											    }
											    catch (e) {
											    	console.log(e);
											    };

									            return label;
									        }
									    }
									}
								}
							});
							}
							else {
								$('#grafico-rodada .card-block').append('<div class="bg-default center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');
							}

							$('#grafico-rodada .card-block').fadeIn("slow", function() {
								$('#loading-grafico').fadeOut();
								$('#loading-grafico').remove();
							});
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#grafico-rodada .card-block').hide();
							$('#loading-grafico').remove();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#grafico-rodada .card-block').hide();
						$('#loading-grafico').remove();
				    }
				}
			});
		});

		$('#voltar-desempenho').click(function(e) {
			e.preventDefault();

			$('#maindetold').fadeOut("fast", function() {
				$('#mainclube').fadeIn("slow");

				$('#loading-grafico').fadeOut();
				$('#loading-grafico').remove();
				$('#loading-tab').fadeOut();
				$('#loading-tab').remove();
				$('#pontrodada .table-responsive tbody').html('');
			});
		});
	}

	// END CLUBE (clube)

	// BEGIN BRASILEIRO (brasileirao)

	if(window.location.pathname.indexOf('brasileirao') !== -1) {
		$('.table-responsive').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.brasileiro.php?act=tabela", 
			success: function(data)
			{
			    try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('.escudos').html('');
					$('.tbl-pos-brasileiro').html('');

					if(retorno.succeed) {
						if(retorno.equipes.length > 0) {
							var count = 0;

							$.each(retorno.equipes, function(e, equipe) {
								var class_cor = "";
								if(count < 4) {
									class_cor = "text-primary";
								}
								else if (count >= 4 && count < 6) {
									class_cor = "text-info";
								}
								else if (count >= 6 && count < 12) {
									class_cor = "text-success";
								}
								else if (count >= 13 && count < 16) {
									class_cor = "";
								}
								else if (count >= 16) {
									class_cor = "text-danger";
								}

								$('.tbl-pos-brasileiro').append('<tr><th class="'+class_cor+'">'+(count+1)+'</th><th>'+equipe.clube+'</th><td>'+equipe.pontos+'</td><td>'+equipe.jogos+'</td><td>'+equipe.vitorias+'</td><td>'+equipe.empates+'</td><td>'+equipe.derrotas+'</td><td>'+equipe.gols_pro+'</td><td>'+equipe.gols_contra+'</td><td>'+equipe.saldo_gols+'</td><td>'+equipe.aproveitamento+'%</td></tr>');
								count++;
							});

							$('.table-responsive table').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
						}
						else {
							$('.table-responsive').append('<div class="col-12 center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');

							$('.table-responsive .infor').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
						}
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('.table-responsive .infor').remove();
						$('.table-responsive table').remove();
						$('#loading').remove();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('.table-responsive .infor').remove();
					$('.table-responsive table').remove();
					$('#loading').remove();
			    };
			}
		});

		$('#confrontos-br').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.brasileiro.php?act=confrontos",
			success: function(data)
			{
			    try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('.escudos').html('');

					if(retorno.succeed) {
						loadConfrontosRodada(retorno);
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('.n-rodada').html('');
						$('#confrontos-br .card').remove();
						$('#loading').remove();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('.n-rodada').html('');
					$('#confrontos-br .card').remove();
					$('#loading').remove();

			    };
			}
		});

		$('.voltar-rodada').on('click', function(e) {
			e.preventDefault();

			$('.n-rodada').html('');
			$('#confrontos-br .card').remove();
			$('#confrontos-br').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.brasileiro.php?act=confrontos&rodant",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						$('.escudos').html('');

						if(retorno.succeed) {
							loadConfrontosRodada(retorno);
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('.n-rodada').html('');
							$('#confrontos-br .card').remove();
							$('#loading').remove();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('.n-rodada').html('');
						$('#confrontos-br .card').remove();
						$('#loading').remove();

				    };
				}
			});
		});

		$('.avancar-rodada').on('click', function(e) {
			e.preventDefault();

			$('.n-rodada').html('');
			$('#confrontos-br .card').remove();
			$('#confrontos-br').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			$.ajax({
				type: "POST",
				url: "acts/acts.brasileiro.php?act=confrontos&proxrod",
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						$('.escudos').html('');

						if(retorno.succeed) {
							loadConfrontosRodada(retorno);
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('.n-rodada').html('');
							$('#confrontos-br .card').remove();
							$('#loading').remove();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('.n-rodada').html('');
						$('#confrontos-br .card').remove();
						$('#loading').remove();

				    };
				}
			});
		});

		function loadConfrontosRodada(data) {
			if(data.confrontos.length > 0) {
				$('.n-rodada').html(data.rodada + "ª Rodada");

				data.confrontos.sort(function(a,b) {
				    return a.data - b.data;
				});

				$.each(data.confrontos, function(c, confronto) {
					var fdata = new Date(confronto.data);
					$('#confrontos-br').append('<div class="card"><div class="card-body"><p class="game-info"><strong>' + weekDay(fdata.getDay()) + ' ' + formatBRDate(fdata) + '</strong> ' + confronto.local + ' <strong>' + formatTime(fdata) + '</strong></p><div class="game"><span>' + confronto.m_time + '</span><img src="' + confronto.m_escudo + '" width="30" height="30"><strong>' + confronto.m_placar + '</strong><span class="vs">x</span><strong>' + confronto.v_placar + '</strong><img src="' + confronto.v_escudo + '" width="30" height="30"><span>' + confronto.v_time + '</span></div></div></div>');
				});

				$('#confrontos-br .card').fadeIn("slow", function() {
					$('#loading').fadeOut();
					$('#loading').remove();
				});
			}
			else {
				$('#confrontos-br').append('<div class="col-12 center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</div>');

				$('#confrontos-br .infor').fadeIn("slow", function() {
					$('#loading').fadeOut();
					$('#loading').remove();
				});
			}
		}
	}

	// END BRASILEIRO (brasileiro)

	// BEGIN SCOUTS (scouts)

	if(window.location.pathname.indexOf('scouts') !== -1) {

	    $('#scout1').textext({
	        plugins : 'autocomplete ajax',
	        ajax : {
	            url : 'acts/acts.scouts.php?act=times',
	            dataType : 'json',
	            cacheResults : true
	        }
	    });

	    $('#scout2').textext({
	        plugins : 'autocomplete ajax',
	        ajax : {
	            url : 'acts/acts.scouts.php?act=times',
	            dataType : 'json',
	            cacheResults : true
	        }
	    });

	    $('#scout3').textext({
	        plugins : 'autocomplete ajax',
	        ajax : {
	            url : 'acts/acts.scouts.php?act=times',
	            dataType : 'json',
	            cacheResults : true
	        }
	    });

	    $('#salva_scout1').change(function() {
	    	if($(this).prop('checked')) {
		        setCookie("scout1", $('#scout1').val(), 1);
	    	}
	    	else {
	    		deleteCookie("scout1");
	    	}
	    });

	    $('#salva_scout2').change(function() {
	    	if($(this).prop('checked')) {
		        setCookie("scout2", $('#scout2').val(), 1);
	    	}
	    	else {
	    		deleteCookie("scout2");
	    	}
	    });

	    $('#salva_scout3').change(function() {
	    	if($(this).prop('checked')) {
		        setCookie("scout3", $('#scout3').val(), 1);
	    	}
	    	else {
	    		deleteCookie("scout3");
	    	}
	    });

		if (getCookie("scout1")) {
			$('#scout1').val(getCookie("scout1"));
    		$('#salva_scout1').bootstrapToggle('on');
		}

		if (getCookie("scout2")) {
			$('#scout2').val(getCookie("scout2"));
    		$('#salva_scout2').bootstrapToggle('on');
		}

		if (getCookie("scout3")) {
			$('#scout3').val(getCookie("scout3"));
    		$('#salva_scout3').bootstrapToggle('on');
		} 

		if($('#scout1').val().length > 0) { 
			listaAtletas($('#scout1').parent().parent().parent()); 
		} 

		if($('#scout2').val().length > 0) { 
			listaAtletas($('#scout2').parent().parent().parent()); 
		} 

		if($('#scout3').val().length > 0) { 
			listaAtletas($('#scout3').parent().parent().parent()); 
		}

	    $('body').on('click', '.text-core .text-wrap .text-dropdown .text-list .text-suggestion', function(e) {
	    	listaAtletas($(this).parent().parent().parent().parent().parent()); 
	    });

	    $('.busca-time').on('keyup', function (e) {
		    if (e.keyCode == 13) {
		    	listaAtletas($(this).parent().parent().parent());
		    }
	    });

	    function listaAtletas(el) {
			var formData = new FormData();
			formData.append('scouts', el.find('.busca-time').val());

			el.find('.card').hide();
			$('#loading').remove();
			el.find('.info-clube .nome').html("");
			el.find('.img-scouts').prop("src", "");
			el.find('.dados-pont').html("");
			el.find('.dados-patri').html("");
			el.find('table tbody').html("");
	    	el.append('<div style="margin-top:70px;" id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
			
			$.ajax({
				type: "POST",
				url: "acts/acts.scouts.php?act=pontuacao",
				data : formData,
				processData: false,
				contentType: false,
    			timeout: 0,
				success: function(data)
				{
				    try {
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							el.find('.info-clube .nome').html(retorno.time);
							el.find('.img-scouts').prop("src", "img/escudos/" + retorno.escudo);
							el.find('.dados-pont').html(retorno.pont_total + "pts");
							el.find('.dados-patri').html("C$ " + retorno.patrimonio);
							
							if(retorno.atletas.length > 0) {
								retorno.atletas.sort(function(a,b) {
								    return a.index - b.index;
								});

								$.each(retorno.atletas, function(a, atleta) {
									var capitao = "";
									if(atleta.capitao) {
										capitao = '<img class="capitao" src="img/capitao.png" />';
									}

									el.find('table tbody').append('<tr><td class="logo-time"><img src="'+atleta.escudo+'"></td><td>'+atleta.posicao+'</td><td>'+capitao+atleta.nome+'</td><td class="'+atleta.css_pont+'">'+atleta.pontuacao+'</td></tr>');
								});
							}
							else {
								el.find('table tbody').append('<tr class="bg-table"><td colspan="4" class="center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</td></tr>');
							}

							el.find('.card').fadeIn("slow", function() {
								$('#loading').fadeOut();
								$('#loading').remove();
							});
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							el.find('.info-clube .nome').html("");
							el.find('.img-scouts').prop("src", "");
							el.find('.dados-pont').html("");
							el.find('.dados-patri').html("");
							el.find('table tbody').html("");
							el.find('.card').hide();
							$('#loading').remove();
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						el.find('.info-clube .nome').html("");
						el.find('.img-scouts').prop("src", "");
						el.find('.dados-pont').html("");
						el.find('.dados-patri').html("");
						el.find('table tbody').html("");
						el.find('.card').hide();
						$('#loading').remove();
				    };
				}
			});
	    }

	    self.setInterval(function () {
    		if($('#scout1').val().length > 0) { 
    			listaAtletas($('#scout1').parent().parent().parent()); 
    		} 

    		if($('#scout2').val().length > 0) { 
    			listaAtletas($('#scout2').parent().parent().parent()); 
    		} 

    		if($('#scout3').val().length > 0) { 
    			listaAtletas($('#scout3').parent().parent().parent()); 
    		}
    	}, 20000);
	}

	// END SCOUTS (scouts)

	// BEGIN TEMPO REAL (temporeal)

	if(window.location.pathname.indexOf('tempo-real') !== -1) {
				
		// DESEMPENHO GERAL
		$('#tempo-real').append('<div id="loading"><p style="text-align: center;"><img src="img/loading2.svg" height="150px" border="0"><br />Aguarde! Carregando conteúdo...</p></div>');
		$.ajax({
			type: "POST",
			url: "acts/acts.tempo_real.php?act=listagem",
    		timeout: 0,
			success: function(data)
			{ 
			    try {
					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('#tempo-real .card-body tbody').html('');

					if(retorno.succeed) {
						var rebaixamento = retorno.list.length - 4;
						if(retorno.list.length > 0) {
							retorno.list.sort(function(a,b) {
							    return b.parcial_total - a.parcial_total;
							});

							$.each(retorno.list, function(i, item) {
								var bg = "bg-table";
								if(i < 6) 
									bg = "text-success";
								if(i > 6 && i >= rebaixamento) 
									bg = "text-danger";

								var posatual = i + 1;

								var variacao = "";
								if(item.posicao == 0) {
									variacao = "+" + posatual;
								}
						        else if((item.posicao - posatual) > 0) {
						        	variacao = "+" + (item.posicao - posatual);
						        }
						        else if((item.posicao - posatual) < 0) {
						        	variacao = (item.posicao - posatual);
						        }
						        else {
						        	variacao = "-";
						        }

								var myTeamClass = "";
								if(item.isMyTeam)
									myTeamClass = "bg-warning";
								
								$('#tempo-real .card-body tbody').append('<tr class="'+myTeamClass+'"><th scope="row" class="table-title ' + bg + '">' + posatual + 'º</th><td><img class="shield-club" src="img/escudos/' + item.escudo + '" class="img-fluid"></td><td><a href="#" class="scout-time" data-id="' + item.id + '">' + item.time + '</a></td><td>' + item.parcial.toFixed(2) + '</td><td>' + item.parcial_total.toFixed(2) + '</td><td>' + variacao + '</td></tr>');
							});

							$('.table-cartoleirao').tablesorter({
								dateFormat: 'pt', 
								sortList: [[4,1]], 
						        headers: { 
						            1: { 
						                sorter: false 
						            }, 
						            6: { 
						                sorter: false 
						            } 
						        }
							});
						}
						else {
							$('#tempo-real .card-body tbody').append('<tr class="bg-table"><td colspan="6" class="center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</td></tr>');
						}

						$('#loading').fadeOut("fast", function() {
							$('#tempo-real .card-body').fadeIn("slow");
							$('#tempo-real footer').fadeIn("slow");
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#tempo-real .card-body').hide();
						$('#tempo-real footer').hide();
					}
			    }
			    catch (e) {
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#tempo-real .card-body').hide();
					$('#tempo-real footer').hide();
					$('#loading').remove();
			    };
			}
		});

	    $('body').on('click', '.scout-time', function(e) {
			e.preventDefault();

			$('#loading-modal').modal({
				keyboard: false
			});

			var id = $(this).data("id");

			$('.table-lista-scout tbody').html('');
			$('.comissao-tecnica').html('');
			$('.idx1_2').html('');
			$('.idx3').html('');
			$('.idx4').html('');

			$.ajax({
				type: "POST",
				url: "acts/acts.tempo_real.php?act=scouts&idtime=" + id,
	    		timeout: 0,
				success: function(data)
				{ 
				    try {
						$('#loading-modal').modal('hide');
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							if(retorno.atletas.length > 0) {
								retorno.atletas.sort(function(a,b) {
								    return a.index - b.index;
								});

								$('.table-lista-scout tbody').append('<tr><td class="nome-clube">#</td><th class="nome-clube">'+retorno.time+'</th><td class="pts-tot">'+retorno.pont_total+'</td></tr>');
								
								var countidx12 = 0,
									countidx3 = 0,
									countidx4 = 0;

								$.each(retorno.atletas, function(a, atleta) {
									if(atleta.index == 1 || atleta.index == 2)
										countidx12++;

									if(atleta.index == 3)
										countidx3++;

									if(atleta.index == 4)
										countidx4++;
								});

								var idx12class = "col-sm-2",
								    idx3class = "col-sm-3", 
								    idx4class = "col-sm-3";

							    if(countidx12 == 3)
							    	idx12class = "col-sm-3";
							    if(countidx12 == 5)
							    	idx12class = "col-sm-2";

							    if(countidx3 == 2) 
							    	idx3class = "col-sm-6";
							    if(countidx3 == 3) 
							    	idx3class = "col-sm-3";
							    if(countidx3 == 4) 
							    	idx3class = "col-sm-2";
							    if(countidx3 == 5) 
							    	idx3class = "col-sm-2";

							    if(countidx4 == 1) 
							    	idx4class = "col-sm-12";
							    if(countidx4 == 2) 
							    	idx4class = "col-sm-4";
							    if(countidx4 == 3) 
							    	idx4class = "col-sm-3";

							    var hasLateral = false;

								$.each(retorno.atletas, function(a, atleta) {
									var capitao = "", capitaowrp = "";
									if(atleta.capitao) {
										capitao = '<img class="capitao" src="img/capitao.png" />';
										capitaowrp = '<div class="capitao-wrapper"><img class="capitao" src="img/capitao.png" /></div>';
									}
									
									var escudowrp = '<div class="brasao-wrapper"><img src="'+atleta.escudo+'" /></div>';

									if(atleta.index == 0) {
										$('.comissao-tecnica').append('<div class="clearfix col-sm-2 goleiro">'+capitaowrp+escudowrp+'<div class="cartola-campinho-atleta-foto" style="background: #fff url('+atleta.foto+') no-repeat center center; background-size: contain;"></div></div>');
									}
									if(atleta.index == 1) {
										$('.idx1_2').append('<div class="clearfix '+idx12class+' lat'+a+'">'+capitaowrp+escudowrp+'<div class="cartola-campinho-atleta-foto" style="background: #fff url('+atleta.foto+') no-repeat center center; background-size: contain;"></div></div>');
										hasLateral = true;
									}
									if(atleta.index == 2) {
										var idx = 0;
										if(hasLateral)
											idx = a;
										$('.idx1_2').append('<div class="clearfix '+idx12class+' zag'+idx+'">'+capitaowrp+escudowrp+'<div class="cartola-campinho-atleta-foto" style="background: #fff url('+atleta.foto+') no-repeat center center; background-size: contain;"></div></div>');
									}
									if(atleta.index == 3) {
										$('.idx3').append('<div class="clearfix '+idx3class+'">'+capitaowrp+escudowrp+'<div class="cartola-campinho-atleta-foto" style="background: #fff url('+atleta.foto+') no-repeat center center; background-size: contain;"></div></div>');
									}
									if(atleta.index == 4) {
										$('.idx4').append('<div class="clearfix '+idx4class+'">'+capitaowrp+escudowrp+'<div class="cartola-campinho-atleta-foto" style="background: #fff url('+atleta.foto+') no-repeat center center; background-size: contain;"></div></div>');
									}
									if(atleta.index == 5) {
										$('.comissao-tecnica').append('<div class="col-sm-2 tecnico">'+escudowrp+'<div class="cartola-campinho-atleta-foto" style="background: #fff url('+atleta.foto+') no-repeat center center; background-size: contain;"></div></div>');
									}

									$('.table-lista-scout tbody').append('<tr><td>'+atleta.posicao+'</td><th>'+capitao+atleta.nome+'</th><td class="'+atleta.css_pont+'">'+atleta.pontuacao+'</td></tr>');
								});
							}
							else {
								$('.table-lista-scout tbody').append('<tr class="bg-table"><td colspan="4" class="center infor"><i class="fa fa-thumbs-down fa-2x"></i><br /><br />Não há dados a serem exibidos aqui.</td></tr>');
							}

							$('#maintable').fadeOut("fast", function() {
								$('#mainscout').fadeIn("slow");
							});
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('#maintable').show();
							$('#mainscout').hide();
							$('.table-lista-scout tbody').html('');
							$('.comissao-tecnica').html('');
							$('.idx1_2').html('');
							$('.idx3').html('');
							$('.idx4').html('');
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('#loading-modal').modal('hide');
						$('#maintable').show();
						$('#mainscout').hide();
						$('.table-lista-scout tbody').html('');
						$('.comissao-tecnica').html('');
						$('.idx1_2').html('');
						$('.idx3').html('');
						$('.idx4').html('');
				    };
				}
			});


	    });

	    $('#btn-voltar-listagem').on('click', function (e) {
			e.preventDefault();

			$('#mainscout').fadeOut("fast", function() {
				$('#maintable').fadeIn("slow");
			});

			$('.table-lista-scout tbody').html('');
			$('.comissao-tecnica').html('');
			$('.idx1_2').html('');
			$('.idx3').html('');
			$('.idx4').html('');
	    });

	    self.setInterval(function () {
	    	if($('#maintable').is(":visible")) 
    			window.location.reload();
    	}, 180000);
	}

	// END TEMPO REAL (temporeal)

	// BEGIN SCOUTS (comparacao)

	if(window.location.pathname.indexOf('comparar') !== -1) {

	    $('#comparacao1').textext({
	        plugins : 'autocomplete ajax',
	        ajax : {
	            url : 'acts/acts.comparacao.php?act=times',
	            dataType : 'json',
	            cacheResults : true
	        }
	    });

	    $('#comparacao2').textext({
	        plugins : 'autocomplete ajax',
	        ajax : {
	            url : 'acts/acts.comparacao.php?act=times',
	            dataType : 'json',
	            cacheResults : true
	        }
	    });

	    $('#salva_comparacao1').change(function() {
	    	if($(this).prop('checked')) {
		        setCookie("comparacao1", $('#comparacao1').val(), 1);
	    	}
	    	else {
	    		deleteCookie("comparacao1");
	    	}
	    });

	    $('#salva_comparacao2').change(function() {
	    	if($(this).prop('checked')) {
		        setCookie("comparacao2", $('#comparacao2').val(), 1);
	    	}
	    	else {
	    		deleteCookie("comparacao2");
	    	}
	    });

		if (getCookie("comparacao1")) {
			$('#comparacao1').val(getCookie("comparacao1"));
    		$('#salva_comparacao1').bootstrapToggle('on');
		}

		if (getCookie("comparacao2")) {
			$('#comparacao2').val(getCookie("comparacao2"));
    		$('#salva_comparacao2').bootstrapToggle('on');
		}

		if($('#comparacao1').val().length > 0) { 
			carregaInfos($('#comparacao1').val(), 1); 
		} 

		if($('#comparacao2').val().length > 0) { 
			carregaInfos($('#comparacao2').val(), 2); 
		}

	    $('body').on('click', '.text-core .text-wrap .text-dropdown .text-list .text-suggestion', function(e) {
	    	carregaInfos($(this).parent().parent().parent().find('.busca-time').val(), $(this).parent().parent().parent().find('.busca-time').attr('id').replace('comparacao', '')); 
	    });

	    $('.busca-time').on('keyup', function (e) {
		    if (e.keyCode == 13) {
		    	carregaInfos($(this).val(), $(this).attr('id').replace('comparacao', ''));
		    }
	    });

	    function carregaInfos(nome_time, idx) {
			var formData = new FormData();
			formData.append('nome_time', nome_time);

			$('#loading-modal').modal({
				keyboard: false
			});

			var idx2 = 1;

			if(idx == 1)
				idx2 = 2;

			$('.dados_time' + idx).html('');
			$('.posicao_time' + idx).html('');
			$('.pontos_time' + idx).html('');
			$('.patrimonio_time' + idx).html('');
			$('.media_time' + idx).html('');
			$('.maior_time' + idx).html('');
			$('.menor_time' + idx).html('');
			$('.ultima_time' + idx).html('');
			$('.table-estatisticas').hide();

			$('.med_g_time' + idx).html('');
			$('.med_l_time' + idx).html('');
			$('.med_z_time' + idx).html('');
			$('.med_m_time' + idx).html('');
			$('.med_a_time' + idx).html('');
			$('.med_t_time' + idx).html('');
			$('.table-medias').hide();

			$.ajax({
				type: "POST",
				url: "acts/acts.comparacao.php?act=dados_time",				
				data : formData,
				processData: false,
				contentType: false,
    			timeout: 0,
				success: function(data)				
				{
				    try {console.log(data);
						var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

						if(retorno.succeed) {
							$('.dados_time' + idx).html('<img src="img/escudos/' + retorno.escudo + '"> ' + retorno.time);
							$('.posicao_time' + idx).html(retorno.posicao + ' º');
							$('.pontos_time' + idx).html(retorno.tot_pontos.toFixed(2));
							$('.patrimonio_time' + idx).html('C$' + retorno.patrimonio.replace(',', '.'));
							$('.media_time' + idx).html(retorno.media);
							$('.maior_time' + idx).html(retorno.max_pontos);
							$('.menor_time' + idx).html(retorno.min_pontos);
							$('.ultima_time' + idx).html(retorno.ult_pontos);

							$('.posicao_time' + idx).removeClass('positivo');
							$('.posicao_time' + idx).removeClass('negativo');
							$('.pontos_time' + idx).removeClass('positivo');
							$('.pontos_time' + idx).removeClass('negativo');
							$('.patrimonio_time' + idx).removeClass('positivo');
							$('.patrimonio_time' + idx).removeClass('negativo');
							$('.media_time' + idx).removeClass('positivo');
							$('.media_time' + idx).removeClass('negativo');
							$('.maior_time' + idx).removeClass('positivo');
							$('.maior_time' + idx).removeClass('negativo');
							$('.menor_time' + idx).removeClass('positivo');
							$('.menor_time' + idx).removeClass('negativo');
							$('.ultima_time' + idx).removeClass('positivo');
							$('.ultima_time' + idx).removeClass('negativo');
							$('.med_g_time' + idx).removeClass('positivo');
							$('.med_g_time' + idx).removeClass('negativo');
							$('.med_l_time' + idx).removeClass('positivo');
							$('.med_l_time' + idx).removeClass('negativo');
							$('.med_z_time' + idx).removeClass('positivo');
							$('.med_z_time' + idx).removeClass('negativo');
							$('.med_m_time' + idx).removeClass('positivo');
							$('.med_m_time' + idx).removeClass('negativo');
							$('.med_a_time' + idx).removeClass('positivo');
							$('.med_a_time' + idx).removeClass('negativo');
							$('.med_t_time' + idx).removeClass('positivo');
							$('.med_t_time' + idx).removeClass('negativo');

							$('.posicao_time' + idx2).removeClass('positivo');
							$('.posicao_time' + idx2).removeClass('negativo');
							$('.pontos_time' + idx2).removeClass('positivo');
							$('.pontos_time' + idx2).removeClass('negativo');
							$('.patrimonio_time' + idx2).removeClass('positivo');
							$('.patrimonio_time' + idx2).removeClass('negativo');
							$('.media_time' + idx2).removeClass('positivo');
							$('.media_time' + idx2).removeClass('negativo');
							$('.maior_time' + idx2).removeClass('positivo');
							$('.maior_time' + idx2).removeClass('negativo');
							$('.menor_time' + idx2).removeClass('positivo');
							$('.menor_time' + idx2).removeClass('negativo');
							$('.ultima_time' + idx2).removeClass('positivo');
							$('.ultima_time' + idx2).removeClass('negativo');
							$('.med_g_time' + idx2).removeClass('positivo');
							$('.med_g_time' + idx2).removeClass('negativo');
							$('.med_l_time' + idx2).removeClass('positivo');
							$('.med_l_time' + idx2).removeClass('negativo');
							$('.med_z_time' + idx2).removeClass('positivo');
							$('.med_z_time' + idx2).removeClass('negativo');
							$('.med_m_time' + idx2).removeClass('positivo');
							$('.med_m_time' + idx2).removeClass('negativo');
							$('.med_a_time' + idx2).removeClass('positivo');
							$('.med_a_time' + idx2).removeClass('negativo');
							$('.med_t_time' + idx2).removeClass('positivo');
							$('.med_t_time' + idx2).removeClass('negativo');

							if(parseFloat($('.posicao_time' + idx).html().replace(' º', '')) < 
							   parseFloat($('.posicao_time' + idx2).html().replace(' º', ''))) {
								$('.posicao_time' + idx).addClass('positivo');
								$('.posicao_time' + idx2).addClass('negativo');
							}
							else {
								$('.posicao_time' + idx).addClass('negativo');
								$('.posicao_time' + idx2).addClass('positivo');
							




							}

							if(parseFloat($('.pontos_time' + idx).html()) > parseFloat($('.pontos_time' + idx2).html())) {
								$('.pontos_time' + idx).addClass('positivo');
								$('.pontos_time' + idx2).addClass('negativo');
							}
							else {
								$('.pontos_time' + idx).addClass('negativo');
								$('.pontos_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.patrimonio_time' + idx).html().replace('C$', '')) > 
							   parseFloat($('.patrimonio_time' + idx2).html().replace('C$', ''))) {
								$('.patrimonio_time' + idx).addClass('positivo');
								$('.patrimonio_time' + idx2).addClass('negativo');
							}
							else {
								$('.patrimonio_time' + idx).addClass('negativo');
								$('.patrimonio_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.media_time' + idx).html()) > parseFloat($('.media_time' + idx2).html())) {
								$('.media_time' + idx).addClass('positivo');
								$('.media_time' + idx2).addClass('negativo');
							}
							else {
								$('.media_time' + idx).addClass('negativo');
								$('.media_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.maior_time' + idx).html()) > parseFloat($('.maior_time' + idx2).html())) {
								$('.maior_time' + idx).addClass('positivo');
								$('.maior_time' + idx2).addClass('negativo');
							}
							else {
								$('.maior_time' + idx).addClass('negativo');
								$('.maior_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.menor_time' + idx).html()) > parseFloat($('.menor_time' + idx2).html())) {
								$('.menor_time' + idx).addClass('positivo');
								$('.menor_time' + idx2).addClass('negativo');
							}
							else {
								$('.menor_time' + idx).addClass('negativo');
								$('.menor_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.ultima_time' + idx).html()) > parseFloat($('.ultima_time' + idx2).html())) {
								$('.ultima_time' + idx).addClass('positivo');
								$('.ultima_time' + idx2).addClass('negativo');
							}
							else {
								$('.ultima_time' + idx).addClass('negativo');
								$('.ultima_time' + idx2).addClass('positivo');
							}

							$('.table-estatisticas').fadeIn("slow");

							$('.med_g_time' + idx).html(retorno.media_g);
							$('.med_l_time' + idx).html(retorno.media_l);
							$('.med_z_time' + idx).html(retorno.media_z);
							$('.med_m_time' + idx).html(retorno.media_m);
							$('.med_a_time' + idx).html(retorno.media_a);
							$('.med_t_time' + idx).html(retorno.media_t);

							if(parseFloat($('.med_g_time' + idx).html()) > parseFloat($('.med_g_time' + idx2).html())) {
								$('.med_g_time' + idx).addClass('positivo');
								$('.med_g_time' + idx2).addClass('negativo');
							}
							else {
								$('.med_g_time' + idx).addClass('negativo');
								$('.med_g_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.med_l_time' + idx).html()) > parseFloat($('.med_l_time' + idx2).html())) {
								$('.med_l_time' + idx).addClass('positivo');
								$('.med_l_time' + idx2).addClass('negativo');
							}
							else {
								$('.med_l_time' + idx).addClass('negativo');
								$('.med_l_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.med_z_time' + idx).html()) > parseFloat($('.med_z_time' + idx2).html())) {
								$('.med_z_time' + idx).addClass('positivo');
								$('.med_z_time' + idx2).addClass('negativo');
							}
							else {
								$('.med_z_time' + idx).addClass('negativo');
								$('.med_z_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.med_m_time' + idx).html()) > parseFloat($('.med_m_time' + idx2).html())) {
								$('.med_m_time' + idx).addClass('positivo');
								$('.med_m_time' + idx2).addClass('negativo');
							}
							else {
								$('.med_m_time' + idx).addClass('negativo');
								$('.med_m_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.med_a_time' + idx).html()) > parseFloat($('.med_a_time' + idx2).html())) {
								$('.med_a_time' + idx).addClass('positivo');
								$('.med_a_time' + idx2).addClass('negativo');
							}
							else {
								$('.med_a_time' + idx).addClass('negativo');
								$('.med_a_time' + idx2).addClass('positivo');
							}

							if(parseFloat($('.med_t_time' + idx).html()) > parseFloat($('.med_t_time' + idx2).html())) {
								$('.med_t_time' + idx).addClass('positivo');
								$('.med_t_time' + idx2).addClass('negativo');
							}
							else {
								$('.med_t_time' + idx).addClass('negativo');
								$('.med_t_time' + idx2).addClass('positivo');
							}

							$('.table-medias').fadeIn("slow");

							$('#loading-modal').modal('hide');
						}
						else {
							$('#alert-title').html(retorno.title);
							$('#alert-content').html(retorno.errno + " - " + retorno.erro);
							$('#alert').modal('show');

							$('.dados_time' + idx).html('');
							$('.posicao_time' + idx).html('');
							$('.pontos_time' + idx).html('');
							$('.patrimonio_time' + idx).html('');
							$('.media_time' + idx).html('');
							$('.maior_time' + idx).html('');
							$('.menor_time' + idx).html('');
							$('.ultima_time' + idx).html('');
							$('.table-estatisticas').hide();

							$('.med_g_time' + idx).html('');
							$('.med_l_time' + idx).html('');
							$('.med_z_time' + idx).html('');
							$('.med_m_time' + idx).html('');
							$('.med_a_time' + idx).html('');
							$('.med_t_time' + idx).html('');
							$('.table-medias').hide();

							$('.posicao_time' + idx).removeClass('positivo');
							$('.posicao_time' + idx).removeClass('negativo');
							$('.pontos_time' + idx).removeClass('positivo');
							$('.pontos_time' + idx).removeClass('negativo');
							$('.patrimonio_time' + idx).removeClass('positivo');
							$('.patrimonio_time' + idx).removeClass('negativo');
							$('.media_time' + idx).removeClass('positivo');
							$('.media_time' + idx).removeClass('negativo');
							$('.maior_time' + idx).removeClass('positivo');
							$('.maior_time' + idx).removeClass('negativo');
							$('.menor_time' + idx).removeClass('positivo');
							$('.menor_time' + idx).removeClass('negativo');
							$('.ultima_time' + idx).removeClass('positivo');
							$('.ultima_time' + idx).removeClass('negativo');
							$('.med_g_time' + idx).removeClass('positivo');
							$('.med_g_time' + idx).removeClass('negativo');
							$('.med_l_time' + idx).removeClass('positivo');
							$('.med_l_time' + idx).removeClass('negativo');
							$('.med_z_time' + idx).removeClass('positivo');
							$('.med_z_time' + idx).removeClass('negativo');
							$('.med_m_time' + idx).removeClass('positivo');
							$('.med_m_time' + idx).removeClass('negativo');
							$('.med_a_time' + idx).removeClass('positivo');
							$('.med_a_time' + idx).removeClass('negativo');
							$('.med_t_time' + idx).removeClass('positivo');
							$('.med_t_time' + idx).removeClass('negativo');

							$('.posicao_time' + idx2).removeClass('positivo');
							$('.posicao_time' + idx2).removeClass('negativo');
							$('.pontos_time' + idx2).removeClass('positivo');
							$('.pontos_time' + idx2).removeClass('negativo');
							$('.patrimonio_time' + idx2).removeClass('positivo');
							$('.patrimonio_time' + idx2).removeClass('negativo');
							$('.media_time' + idx2).removeClass('positivo');
							$('.media_time' + idx2).removeClass('negativo');
							$('.maior_time' + idx2).removeClass('positivo');
							$('.maior_time' + idx2).removeClass('negativo');
							$('.menor_time' + idx2).removeClass('positivo');
							$('.menor_time' + idx2).removeClass('negativo');
							$('.ultima_time' + idx2).removeClass('positivo');
							$('.ultima_time' + idx2).removeClass('negativo');
							$('.med_g_time' + idx2).removeClass('positivo');
							$('.med_g_time' + idx2).removeClass('negativo');
							$('.med_l_time' + idx2).removeClass('positivo');
							$('.med_l_time' + idx2).removeClass('negativo');
							$('.med_z_time' + idx2).removeClass('positivo');
							$('.med_z_time' + idx2).removeClass('negativo');
							$('.med_m_time' + idx2).removeClass('positivo');
							$('.med_m_time' + idx2).removeClass('negativo');
							$('.med_a_time' + idx2).removeClass('positivo');
							$('.med_a_time' + idx2).removeClass('negativo');
							$('.med_t_time' + idx2).removeClass('positivo');
							$('.med_t_time' + idx2).removeClass('negativo');

							$('#loading-modal').modal('hide');
						}
				    }
				    catch (e) {
						$('#alert-title').html("Erro ao fazer parse do JSON!");
						$('#alert-content').html(String(e.stack));
						$('#alert').modal('show');

						$('.dados_time' + idx).html('');
						$('.posicao_time' + idx).html('');
						$('.pontos_time' + idx).html('');
						$('.patrimonio_time' + idx).html('');
						$('.media_time' + idx).html('');
						$('.maior_time' + idx).html('');
						$('.menor_time' + idx).html('');
						$('.ultima_time' + idx).html('');
						$('.table-estatisticas').hide();

						$('.med_g_time' + idx).html('');
						$('.med_l_time' + idx).html('');
						$('.med_z_time' + idx).html('');
						$('.med_m_time' + idx).html('');
						$('.med_a_time' + idx).html('');
						$('.med_t_time' + idx).html('');
						$('.table-medias').hide();

						$('.posicao_time' + idx).removeClass('positivo');
						$('.posicao_time' + idx).removeClass('negativo');
						$('.pontos_time' + idx).removeClass('positivo');
						$('.pontos_time' + idx).removeClass('negativo');
						$('.patrimonio_time' + idx).removeClass('positivo');
						$('.patrimonio_time' + idx).removeClass('negativo');
						$('.media_time' + idx).removeClass('positivo');
						$('.media_time' + idx).removeClass('negativo');
						$('.maior_time' + idx).removeClass('positivo');
						$('.maior_time' + idx).removeClass('negativo');
						$('.menor_time' + idx).removeClass('positivo');
						$('.menor_time' + idx).removeClass('negativo');
						$('.ultima_time' + idx).removeClass('positivo');
						$('.ultima_time' + idx).removeClass('negativo');
						$('.med_g_time' + idx).removeClass('positivo');
						$('.med_g_time' + idx).removeClass('negativo');
						$('.med_l_time' + idx).removeClass('positivo');
						$('.med_l_time' + idx).removeClass('negativo');
						$('.med_z_time' + idx).removeClass('positivo');
						$('.med_z_time' + idx).removeClass('negativo');
						$('.med_m_time' + idx).removeClass('positivo');
						$('.med_m_time' + idx).removeClass('negativo');
						$('.med_a_time' + idx).removeClass('positivo');
						$('.med_a_time' + idx).removeClass('negativo');
						$('.med_t_time' + idx).removeClass('positivo');
						$('.med_t_time' + idx).removeClass('negativo');

						$('.posicao_time' + idx2).removeClass('positivo');
						$('.posicao_time' + idx2).removeClass('negativo');
						$('.pontos_time' + idx2).removeClass('positivo');
						$('.pontos_time' + idx2).removeClass('negativo');
						$('.patrimonio_time' + idx2).removeClass('positivo');
						$('.patrimonio_time' + idx2).removeClass('negativo');
						$('.media_time' + idx2).removeClass('positivo');
						$('.media_time' + idx2).removeClass('negativo');
						$('.maior_time' + idx2).removeClass('positivo');
						$('.maior_time' + idx2).removeClass('negativo');
						$('.menor_time' + idx2).removeClass('positivo');
						$('.menor_time' + idx2).removeClass('negativo');
						$('.ultima_time' + idx2).removeClass('positivo');
						$('.ultima_time' + idx2).removeClass('negativo');
						$('.med_g_time' + idx2).removeClass('positivo');
						$('.med_g_time' + idx2).removeClass('negativo');
						$('.med_l_time' + idx2).removeClass('positivo');
						$('.med_l_time' + idx2).removeClass('negativo');
						$('.med_z_time' + idx2).removeClass('positivo');
						$('.med_z_time' + idx2).removeClass('negativo');
						$('.med_m_time' + idx2).removeClass('positivo');
						$('.med_m_time' + idx2).removeClass('negativo');
						$('.med_a_time' + idx2).removeClass('positivo');
						$('.med_a_time' + idx2).removeClass('negativo');
						$('.med_t_time' + idx2).removeClass('positivo');
						$('.med_t_time' + idx2).removeClass('negativo');

						$('#loading-modal').modal('hide');
				    };
				}
			});
	    }
	}

	// END SCOUTS (comparacao)
});

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function formatDate(milliseconds) {
	var today = new Date(milliseconds);
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

	return dd + '/' + mm + '/' + yyyy + ' - ' + h + ':' + i + 'hrs';
}

function formatBRDate(date) {
	var dd = date.getDate();
	var mm = date.getMonth()+1; //January is 0!
	var yyyy = date.getFullYear();

	if(dd<10) {
	    dd = '0'+dd
	} 

	if(mm<10) {
	    mm = '0'+mm
	}

	if(isNaN(date.getTime())) {
		return "A definir";
	}
	else {
		return dd + '/' + mm + '/' + yyyy;
	}
}

function formatTodayEUDate() {
	var date = new Date();
	var dd = date.getDate();
	var mm = date.getMonth()+1; //January is 0!
	var yyyy = date.getFullYear();

	if(dd<10) {
	    dd = '0'+dd
	} 

	if(mm<10) {
	    mm = '0'+mm
	}

	if(isNaN(date.getTime())) {
		return "0000-00-00";
	}
	else {
		return yyyy + '-' + mm + '-' + dd;
	}
}

function formatTime(date) {
	var h = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
	var i = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
	if(isNaN(date.getTime())) {
		return "--:--";
	}
	else {
		return h + ':' + i;
	}
}

function weekDay(day) {
	var weekday = new Array(7);
	weekday[0] =  "DOM";
	weekday[1] = "SEG";
	weekday[2] = "TER";
	weekday[3] = "QUA";
	weekday[4] = "QUI";
	weekday[5] = "SEX";
	weekday[6] = "SAB";

	if(isNaN(day)) {
		return "---";
	}
	else {
		return weekday[day];
	}
}

function setCookie(name, value, exdays) {
	var expires;

	var date; 

	date = new Date(); //  criando o COOKIE com a data atual
	date.setTime(date.getTime()+(exdays*24*60*60*1000));
	expires = date.toUTCString();
	document.cookie = name+"="+value+"; expires="+expires+"; path=/";
}

function getCookie(name) {
    var cookies = document.cookie;
    var prefix = name + "=";
    var begin = cookies.indexOf("; " + prefix);
 
    if (begin == -1) {
 
        begin = cookies.indexOf(prefix);
         
        if (begin != 0) {
            return null;
        }
 
    } else {
        begin += 2;
    }
 
    var end = cookies.indexOf(";", begin);
     
    if (end == -1) {
        end = cookies.length;                        
    }
 
    return unescape(cookies.substring(begin + prefix.length, end));
}


function deleteCookie(name) {
	if (getCookie(name)) {
		document.cookie = name + "=" + "; expires=Thu, 01-Jan-70 00:00:01 GMT";
	}
}

function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

/*!
 * Validator v0.11.9 for Bootstrap 3, by @1000hz
 * Copyright 2017 Cina Saffary
 * Licensed under http://opensource.org/licenses/MIT
 *
 * https://github.com/1000hz/bootstrap-validator
 */

+function(a){"use strict";function b(b){return b.is('[type="checkbox"]')?b.prop("checked"):b.is('[type="radio"]')?!!a('[name="'+b.attr("name")+'"]:checked').length:b.is("select[multiple]")?(b.val()||[]).length:b.val()}function c(b){return this.each(function(){var c=a(this),e=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b),f=c.data("bs.validator");(f||"destroy"!=b)&&(f||c.data("bs.validator",f=new d(this,e)),"string"==typeof b&&f[b]())})}var d=function(c,e){this.options=e,this.validators=a.extend({},d.VALIDATORS,e.custom),this.$element=a(c),this.$btn=a('button[type="submit"], input[type="submit"]').filter('[form="'+this.$element.attr("id")+'"]').add(this.$element.find('input[type="submit"], button[type="submit"]')),this.update(),this.$element.on("input.bs.validator change.bs.validator focusout.bs.validator",a.proxy(this.onInput,this)),this.$element.on("submit.bs.validator",a.proxy(this.onSubmit,this)),this.$element.on("reset.bs.validator",a.proxy(this.reset,this)),this.$element.find("[data-match]").each(function(){var c=a(this),d=c.attr("data-match");a(d).on("input.bs.validator",function(){b(c)&&c.trigger("input.bs.validator")})}),this.$inputs.filter(function(){return b(a(this))&&!a(this).closest(".has-error").length}).trigger("focusout"),this.$element.attr("novalidate",!0)};d.VERSION="0.11.9",d.INPUT_SELECTOR=':input:not([type="hidden"], [type="submit"], [type="reset"], button)',d.FOCUS_OFFSET=20,d.DEFAULTS={delay:500,html:!1,disable:!0,focus:!0,custom:{},errors:{match:"Does not match",minlength:"Not long enough"},feedback:{success:"glyphicon-ok",error:"glyphicon-remove"}},d.VALIDATORS={"native":function(a){var b=a[0];return b.checkValidity?!b.checkValidity()&&!b.validity.valid&&(b.validationMessage||"error!"):void 0},match:function(b){var c=b.attr("data-match");return b.val()!==a(c).val()&&d.DEFAULTS.errors.match},minlength:function(a){var b=a.attr("data-minlength");return a.val().length<b&&d.DEFAULTS.errors.minlength}},d.prototype.update=function(){var b=this;return this.$inputs=this.$element.find(d.INPUT_SELECTOR).add(this.$element.find('[data-validate="true"]')).not(this.$element.find('[data-validate="false"]').each(function(){b.clearErrors(a(this))})),this.toggleSubmit(),this},d.prototype.onInput=function(b){var c=this,d=a(b.target),e="focusout"!==b.type;this.$inputs.is(d)&&this.validateInput(d,e).done(function(){c.toggleSubmit()})},d.prototype.validateInput=function(c,d){var e=(b(c),c.data("bs.validator.errors"));c.is('[type="radio"]')&&(c=this.$element.find('input[name="'+c.attr("name")+'"]'));var f=a.Event("validate.bs.validator",{relatedTarget:c[0]});if(this.$element.trigger(f),!f.isDefaultPrevented()){var g=this;return this.runValidators(c).done(function(b){c.data("bs.validator.errors",b),b.length?d?g.defer(c,g.showErrors):g.showErrors(c):g.clearErrors(c),e&&b.toString()===e.toString()||(f=b.length?a.Event("invalid.bs.validator",{relatedTarget:c[0],detail:b}):a.Event("valid.bs.validator",{relatedTarget:c[0],detail:e}),g.$element.trigger(f)),g.toggleSubmit(),g.$element.trigger(a.Event("validated.bs.validator",{relatedTarget:c[0]}))})}},d.prototype.runValidators=function(c){function d(a){return c.attr("data-"+a+"-error")}function e(){var a=c[0].validity;return a.typeMismatch?c.attr("data-type-error"):a.patternMismatch?c.attr("data-pattern-error"):a.stepMismatch?c.attr("data-step-error"):a.rangeOverflow?c.attr("data-max-error"):a.rangeUnderflow?c.attr("data-min-error"):a.valueMissing?c.attr("data-required-error"):null}function f(){return c.attr("data-error")}function g(a){return d(a)||e()||f()}var h=[],i=a.Deferred();return c.data("bs.validator.deferred")&&c.data("bs.validator.deferred").reject(),c.data("bs.validator.deferred",i),a.each(this.validators,a.proxy(function(a,d){var e=null;!b(c)&&!c.attr("required")||void 0===c.attr("data-"+a)&&"native"!=a||!(e=d.call(this,c))||(e=g(a)||e,!~h.indexOf(e)&&h.push(e))},this)),!h.length&&b(c)&&c.attr("data-remote")?this.defer(c,function(){var d={};d[c.attr("name")]=b(c),a.get(c.attr("data-remote"),d).fail(function(a,b,c){h.push(g("remote")||c)}).always(function(){i.resolve(h)})}):i.resolve(h),i.promise()},d.prototype.validate=function(){var b=this;return a.when(this.$inputs.map(function(){return b.validateInput(a(this),!1)})).then(function(){b.toggleSubmit(),b.focusError()}),this},d.prototype.focusError=function(){if(this.options.focus){var b=this.$element.find(".has-error :input:first");0!==b.length&&(a("html, body").animate({scrollTop:b.offset().top-d.FOCUS_OFFSET},250),b.focus())}},d.prototype.showErrors=function(b){var c=this.options.html?"html":"text",d=b.data("bs.validator.errors"),e=b.closest(".form-group"),f=e.find(".help-block.with-errors"),g=e.find(".form-control-feedback");d.length&&(d=a("<ul/>").addClass("list-unstyled").append(a.map(d,function(b){return a("<li/>")[c](b)})),void 0===f.data("bs.validator.originalContent")&&f.data("bs.validator.originalContent",f.html()),f.empty().append(d),e.addClass("has-error has-danger"),e.hasClass("has-feedback")&&g.removeClass(this.options.feedback.success)&&g.addClass(this.options.feedback.error)&&e.removeClass("has-success"))},d.prototype.clearErrors=function(a){var c=a.closest(".form-group"),d=c.find(".help-block.with-errors"),e=c.find(".form-control-feedback");d.html(d.data("bs.validator.originalContent")),c.removeClass("has-error has-danger has-success"),c.hasClass("has-feedback")&&e.removeClass(this.options.feedback.error)&&e.removeClass(this.options.feedback.success)&&b(a)&&e.addClass(this.options.feedback.success)&&c.addClass("has-success")},d.prototype.hasErrors=function(){function b(){return!!(a(this).data("bs.validator.errors")||[]).length}return!!this.$inputs.filter(b).length},d.prototype.isIncomplete=function(){function c(){var c=b(a(this));return!("string"==typeof c?a.trim(c):c)}return!!this.$inputs.filter("[required]").filter(c).length},d.prototype.onSubmit=function(a){this.validate(),(this.isIncomplete()||this.hasErrors())&&a.preventDefault()},d.prototype.toggleSubmit=function(){this.options.disable&&this.$btn.toggleClass("disabled",this.isIncomplete()||this.hasErrors())},d.prototype.defer=function(b,c){return c=a.proxy(c,this,b),this.options.delay?(window.clearTimeout(b.data("bs.validator.timeout")),void b.data("bs.validator.timeout",window.setTimeout(c,this.options.delay))):c()},d.prototype.reset=function(){return this.$element.find(".form-control-feedback").removeClass(this.options.feedback.error).removeClass(this.options.feedback.success),this.$inputs.removeData(["bs.validator.errors","bs.validator.deferred"]).each(function(){var b=a(this),c=b.data("bs.validator.timeout");window.clearTimeout(c)&&b.removeData("bs.validator.timeout")}),this.$element.find(".help-block.with-errors").each(function(){var b=a(this),c=b.data("bs.validator.originalContent");b.removeData("bs.validator.originalContent").html(c)}),this.$btn.removeClass("disabled"),this.$element.find(".has-error, .has-danger, .has-success").removeClass("has-error has-danger has-success"),this},d.prototype.destroy=function(){return this.reset(),this.$element.removeAttr("novalidate").removeData("bs.validator").off(".bs.validator"),this.$inputs.off(".bs.validator"),this.options=null,this.validators=null,this.$element=null,this.$btn=null,this.$inputs=null,this};var e=a.fn.validator;a.fn.validator=c,a.fn.validator.Constructor=d,a.fn.validator.noConflict=function(){return a.fn.validator=e,this},a(window).on("load",function(){a('form[data-toggle="validator"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery);