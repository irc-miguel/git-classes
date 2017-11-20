<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
	function enviarResultado()
	{
		$("#pesquisa-submit").hide();
	  	$("#loader").show();
		var dados = $("#frm_responder_pesquisa").serialize();								
		
		$.ajax({
			type: "POST",
			url: "/pesquisas_controller/salvar_resultado_pesquisa",
			data: dados,
			success: function( data )
			{
				if(data == "Sucesso") {
					alert("Informações salvas com sucesso! Obrigado por responder nossa pesquisa!");
					window.location="/pesquisas_controller";
				} 
				else if(data == "Erro") {
					alert("É necessário responder todas as perguntas! Por favor, tente novamente.");
					$("#loader").hide();
				  	$("#pesquisa-submit").show();
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown)
			{
				alert("ERRO: "+textStatus);					  	
			}
		});
	
		return false;	
	}
	
	$(document).ready(function() {
		$("#frm_responder_pesquisa").submit(function() {
			return enviarResultado();
		});
	});
{/literal}
</script>
</head>
<body>
<div id="wrapper">
	{include file="includes/cabecalho.tpl"}
	<!-- end #header -->
	{include file="includes/menu.tpl"}
	<!-- end #menu -->
	
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
					
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/pesquisas_controller">Pesquisas</a> > Responder</p>
						<h2 class="title"><a >{$enquete->titulo}</a></h2>		
						<p>{$enquete->descricao}</p>							
						<div style="clear: both; height: 5px;">&nbsp;</div>
												
						{if $perguntas}
							<form id="frm_responder_pesquisa" method="post">
								
								<!-- Perguntas -->
								{foreach from=$perguntas item='pergunta'}							
									<p class="meta">
										<span class="span_pergunta_pesquisa">{$pergunta->pergunta}</span>
										<input type="hidden" name="hdn_pergunta_id-{$pergunta->id}" value="{$pergunta->id}" />
									</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>										
									<!-- Respostas -->
									{if $pergunta->respostas}
										{foreach from=$pergunta->respostas item='resposta'}
											
											{if $pergunta->tipo == 1}											
												<input class="optativa" type="radio" name="radio_pergunta_id-{$pergunta->id}" value="{$resposta->id}"><span class="alternativa">{$resposta->resposta}</span><br>
											{else}
												<input class="multipla_escolha" type="checkbox" name="checkbox_pergunta_id-{$pergunta->id}[]" value="{$resposta->id}"><span class="alternativa">{$resposta->resposta}</span><br>
											{/if}
											
										{/foreach}
									{else}
										<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Não possui alternativas!</p>
									{/if}
									<div style="clear: both; height: 10px;">&nbsp;</div>												
								{/foreach}
								
								<input type="hidden" name="hdn_enquete-id" value="{$enquete->id}" />
								
								<div class="dv_resposta_pesquisa_salvar">
									<p class="lnk_voltar"><a href="/pesquisas_controller"><u>Voltar</u></a></p>									
									<input type="submit" id="pesquisa-submit" value="Salvar" />
									<img src="/system/application/images/ajax-loader-preto.gif" id="loader" />
								</div>
							</form>
						{else}
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Não possui perguntas!</p>
						{/if}						
						
					</div>
				<div style="clear: both; height: 146px;">&nbsp;</div>
				</div>
				<!-- end #content -->
				
				{include file="includes/menu_lateral.tpl"}
				<!-- end #sidebar -->
				
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
	{include file="includes/rodape.tpl"}
	
</div>	
</body>
</html>