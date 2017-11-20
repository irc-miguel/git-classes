<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
	function novaPergunta(id_enquete){
		window.location="/admin/admin_pesquisa_controller/cadastrar_pergunta/"+id_enquete;
	}

	function editarPergunta(id_pergunta){
		window.location="/admin/admin_pesquisa_controller/editar_pergunta/"+id_pergunta;
	}

	function confirmar_exclusao_pergunta(id_pergunta, id_enquete){
		confirmacao = confirm("Deseja excluir esta pergunta?");
		if (confirmacao){
			//caso confirmada a exclusão chamo o método Ajax verificaPergunta
			verificaPergunta(id_pergunta, id_enquete);
		}
	}

	function verificaPergunta(id_pergunta, id_enquete){
		$.ajax({
			  url: "/admin/admin_pesquisa_controller/verifica_pergunta/"+id_pergunta,
			  success: function(data) {
			    if(data == 'vazia'){
			    	excluirPergunta(id_pergunta, id_enquete);
				}
				else if(data == 'possui_respostas'){
					confirmacao = confirm("Esta pergunta possui respostas cadastradas. Tem certeza que deseja excluir a pergunta?");
					if (confirmacao){
						//caso confirmada a exclusão chamo o método Ajax excluirPergunta
						excluirPergunta(id_pergunta, id_enquete);
					}
			    }
				else
					alert('Erro na verificação da pergunta!');
			  }
		});
	}

	function excluirPergunta(id_pergunta, id_enquete){
		$.ajax({
			  url: '/admin/admin_pesquisa_controller/excluir_pergunta/'+id_pergunta,
			  success: function(data) {
			    if(data == 'ok'){
			    	alert('Pergunta excluída com sucesso!');
			    	window.location="/admin/admin_pesquisa_controller/visualizar_pesquisa/"+id_enquete;
				}			
				else
					alert('Erro ao excluir pergunta!');
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
					
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/listar_pesquisas">Pesquisas</a> > <a>{$enquete->titulo}</a></p>
						<h2 class="title"><a >{$enquete->titulo}</a></h2>		
						<p>{$enquete->descricao}</p>	
							
						<p class="meta_botao"><input type="submit" id="btn_nova_pergunta" onclick="novaPergunta({$enquete->id})" value="Nova Pergunta" /></p>
						<div style="clear: both; height: 5px;">&nbsp;</div>
						
						{if $perguntas}
							{foreach from=$perguntas item='pergunta'}							
								<p class="meta">
									<span><a class="lnk_pergunta" href="/admin/admin_pesquisa_controller/visualizar_pergunta/{$pergunta->id}" alt="Visualizar Pergunta" >{$pergunta->pergunta}</a></span>						
									<input type="submit" id="btn_editar_pergunta" onclick="editarPergunta({$pergunta->id})" value="editar" />
									<input type="submit" id="btn_excluir_pergunta" onclick="confirmar_exclusao_pergunta({$pergunta->id},{$enquete->id})" value="excluir" />
								</p> 
								<div style="clear: both; height: 2px;">&nbsp;</div>	
								{if $pergunta->respostas}
									{foreach from=$pergunta->respostas item='resposta'}
										<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">{$resposta->resposta}</p>
									{/foreach}
								{else}
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Não possui respostas!</p>
								{/if}									
							{/foreach}
						{else}
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Não possui perguntas!</p>
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