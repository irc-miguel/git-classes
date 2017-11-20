<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
	function novaResposta(id_pergunta){
		window.location="/admin/admin_pesquisa_controller/cadastrar_resposta/"+id_pergunta;
	}

	function editarResposta(id_resposta){
		window.location="/admin/admin_pesquisa_controller/editar_resposta/"+id_resposta;
	}

	function confirmar_exclusao_resposta(id_resposta, id_pergunta){
		confirmacao = confirm("Deseja excluir esta resposta?");
		if (confirmacao){
			//caso confirmada a exclusão chamo o método Ajax excluirResposta
			excluirResposta(id_resposta, id_pergunta);
		}
	}

	function excluirResposta(id_resposta, id_pergunta){
		$.ajax({
			  url: '/admin/admin_pesquisa_controller/excluir_resposta/'+id_resposta,
			  success: function(data) {
			    if(data == 'ok'){
			    	alert('Resposta excluída com sucesso!');
			    	window.location="/admin/admin_pesquisa_controller/visualizar_pergunta/"+id_pergunta;
				}			
				else
					alert('Erro ao excluir resposta!');
			  }
		});
	}
	
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
					
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/listar_pesquisas">Pesquisas</a> > <a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/visualizar_pesquisa/{$enquete->id}">{$enquete->titulo}</a> > <a>{$pergunta->pergunta}</a></p>
						<h2 class="title"><a >{$pergunta->pergunta}</a></h2>
						<p>Tipo: {$tipo_pergunta}</p>
							
						<p class="meta_botao"><input type="submit" id="btn_nova_resposta" onclick="novaResposta({$pergunta->id})" value="Nova Resposta" /></p>
						<div style="clear: both; height: 5px;">&nbsp;</div>
						
						{if $respostas}
							{foreach from=$respostas item='resposta'}							
								<p class="meta">
									
									<span class="span_resposta">{$resposta->resposta}</span>					
									<input type="submit" id="btn_editar_pergunta" onclick="editarResposta({$resposta->id})" value="editar" />
									<input type="submit" id="btn_excluir_pergunta" onclick="confirmar_exclusao_resposta({$resposta->id},{$pergunta->id})" value="excluir" />
								</p>
								<div style="clear: both; height: 2px;">&nbsp;</div>
							{/foreach}
						{else}
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Não possui respostas!</p>
						{/if}
					</div>		
				<div style="clear: both; height: 146px;">&nbsp;</div>
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