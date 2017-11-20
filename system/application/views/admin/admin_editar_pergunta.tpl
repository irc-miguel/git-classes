<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
	$(document).ready(function(){
	
		  $("#frm_pergunta").validate({
			  rules: {
			    pergunta: {
			      required: true
			    },
			    tipo_pergunta: {
			      required: true
			    }
			  },
			  messages:{
				  pergunta:  "<font color='red'>Informe a pergunta.</font>",
				  tipo_pergunta: "<font color='red'>Informe o tipo da pergunta.</font>"
			  },
			  submitHandler: function( form ){
				  
					$("#pergunta-submit").hide();
				  	$("#loader").show();
					var dados = $( form ).serialize();								
					var idEnquete = {/literal} {$enquete->id} {literal};
					
					$.ajax({
						type: "POST",
						url: "/admin/admin_pesquisa_controller/atualizar_pergunta",
						data: dados,
						success: function( data )
						{
							if(data == "Sucesso") {
								alert("Pergunta alterada com sucesso!");
								window.location="/admin/admin_pesquisa_controller/visualizar_pesquisa/" + idEnquete;
							}
							else if(data == "Erro")
							{
								alert("Esta pergunta já está sendo usado nesta pesquisa! Por favor, informe outra pergunta!");
								$("#loader").hide();
							  	$("#pergunta-submit").show();
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
					
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/listar_pesquisas">Pesquisas</a> > <a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/visualizar_pesquisa/{$enquete->id}">{$enquete->titulo}</a> > Editar pergunta </p>
						<h2 class="title"><a >Editar Pergunta </a></h2>		
						<div id="pergunta_pesquisa">		
							<form id="frm_pergunta" method="post">								
								<div>
									<label><font size="4" color="#32639A">Pergunta: </font></label>
								</div>
								<div>														
									<input class="cl_enq_pergunta" type="text" maxlength="150" name="pergunta" id="pergunta" value="{$pergunta->pergunta}" />																
								</div>
								<div>
									<label><font size="4" color="#32639A">Tipo pergunta: </font></label>
								</div>
								<div>
									<select class="cl_pergunta_tipo" name="tipo_pergunta" id="tipo_pergunta" >
										<option value="">Selecione</option>
										{foreach from=$listaTipos item='tipo'}
											<option value="{$tipo->id_tipo}" {if $pergunta->tipo == $tipo->id_tipo}selected="selected"{/if}>{$tipo->tipo}</option>
										{/foreach}
									</select>
								</div>
								<div class="div_pergunta_salvar">
									<input type="submit" value="Salvar" id="pergunta-submit">
									<img src="/system/application/images/ajax-loader-preto.gif" id="loader" />
								</div>	
								<input type="hidden" name="id_pergunta" value="{$pergunta->id}" >
								<input type="hidden" name="pergunta_titulo" value="{$pergunta->pergunta}" >
								<input type="hidden" name="id_enquete" value="{$pergunta->id_enquete}" >				
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