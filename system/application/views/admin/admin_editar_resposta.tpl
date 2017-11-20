<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
	$(document).ready(function(){
	
		  $("#frm_resposta").validate({
			  rules: {
			    resposta: {
			      required: true
			    }
			  },
			  messages:{
				  resposta:  "<font color='red'>Informe a resposta.</font>"
			  },
			  submitHandler: function( form ){
				  
				  	$("#resposta-submit").hide();
				  	$("#loader").show();
					var dados = $( form ).serialize();								
					var idPergunta = {/literal} {$pergunta->id} {literal};
					
					$.ajax({
						type: "POST",
						url: "/admin/admin_pesquisa_controller/atualizar_resposta",
						data: dados,
						success: function( data )
						{
							if(data == "Sucesso") {
								alert("Resposta alterada com sucesso!");
								window.location="/admin/admin_pesquisa_controller/visualizar_pergunta/" + idPergunta;
							}
							else if(data == "Erro")
							{
								alert("Esta resposta já está sendo usado nesta pergunta! Por favor, informe outra resposta!");
								$("#loader").hide();
							  	$("#resposta-submit").show();
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown)
						{
							alert("ERRO: "+textStatus);
						}
					});
		
					return false;
			  }
		  });		  
	});
{/literal}
</script>
</head>
<body>
<div id="wrapper">
	{include file="admin/includes/cabecalho_admin.tpl"}
	<!-- end #header -->
	{include file="admin/includes/menu_admin.tpl"}
	<!-- end #menu -->

	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/listar_pesquisas">Pesquisas</a> > <a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/visualizar_pesquisa/{$enquete->id}">{$enquete->titulo}</a> > <a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/visualizar_pergunta/{$pergunta->id}">{$pergunta->pergunta}</a> > Editar resposta </p>
						<h2 class="title"><a >Editar Resposta </a></h2>
						<div id="resposta_pesquisa">
							<form id="frm_resposta" method="post">								
								<div>
									<label><font size="4" color="#32639A">Resposta: </font></label>
								</div>
								<div>														
									<input class="cl_enq_resposta" type="text" maxlength="150" name="resposta" id="resposta" value="{$resposta->resposta}" />
								</div>								
								<div class="div_resposta_salvar">
									<input type="submit" value="Salvar" id="resposta-submit">
									<img src="/system/application/images/ajax-loader-preto.gif" id="loader" />
								</div>			
								<input type="hidden" name="id_pergunta" value="{$pergunta->id}">
								
								<input type="hidden" name="id_resposta" value="{$resposta->id}" >
								<input type="hidden" name="resposta_titulo" value="{$resposta->resposta}" >
								<input type="hidden" name="id_pergunta" value="{$pergunta->id}" >		
							</form>
						</div>
						
					</div>		
				</div>
				<!-- end #content -->
				
				{include file="admin/includes/menu_lateral_admin.tpl"}
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
	{include file="admin/includes/rodape_admin.tpl"}
</div>
</body>
</html>