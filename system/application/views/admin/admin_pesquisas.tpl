<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
	function novaEnquete(){
		window.location="/admin/admin_pesquisa_controller/cadastrar_enquete";
	}

	function alterarEnquete(id){
		window.location="/admin/admin_pesquisa_controller/editar_enquete/"+id;
	}

	function confirmar_exclusao(id){
		confirmacao = confirm("Deseja excluir esta pesquisa?");
		if (confirmacao){
			//caso confirmada a exclusão chamo o método Ajax verificaEnquete
			verificaEnquete(id);
		}
	}

	function verificaEnquete(id_enq){
		$.ajax({
			  url: '/admin/admin_pesquisa_controller/verifica_enquete/'+id_enq,
			  success: function(data) {
			    if(data == 'vazia'){
			    	excluirEnquete(id_enq);
				}
			    else if(data == 'possui_perguntas'){
			    	confirmacao = confirm("Esta pesquisa possui perguntas cadastradas. Tem certeza que deseja excluir a pesquisa?");
					if (confirmacao){
						//caso confirmada a exclusão chamo o método Ajax excluirEnquete
						excluirEnquete(id_enq);
					}
			    }
				else if(data == 'possui_respostas'){
					confirmacao = confirm("Esta pesquisa possui perguntas e respostas cadastradas. Tem certeza que deseja excluir a pesquisa?");
					if (confirmacao){
						//caso confirmada a exclusão chamo o método Ajax excluirEnquete
						excluirEnquete(id_enq);
					}
			    }
				else
					alert('Erro na verificação da enquete!');
			  }
		});
	}

	function excluirEnquete(id_enq){
		$.ajax({
			  url: '/admin/admin_pesquisa_controller/excluir_enquete/'+id_enq,
			  success: function(data) {
			    if(data == 'ok'){
			    	alert('Pesquisa excluída com sucesso!');
			    	window.location="/admin/admin_pesquisa_controller/listar_pesquisas";
				}			
				else
					alert('Erro ao excluir pesquisa!');
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
					
						<h2 class="title"><a >Pesquisas   </a></h2>				
						<p class="meta_botao"><input type="submit" id="btn_nova_enquete" onclick="novaEnquete()" value="Nova Pesquisa" /></p>						
						<div style="clear: both; height: 5px;">&nbsp;</div>
						
						{if $enquetes}
							{foreach from=$enquetes item='enquete'}							
								<p class="meta">
									<span><a class="lnk_pesquisa" href="/admin/admin_pesquisa_controller/visualizar_pesquisa/{$enquete->id}">{$enquete->titulo}</a></span>
									<input type="submit" id="btn_editar_pergunta" onclick="alterarEnquete({$enquete->id})" value="editar" />
									<input type="submit" id="btn_excluir_pergunta" onclick="confirmar_exclusao({$enquete->id})" value="excluir" />
								</p> 
								<div style="clear: both; height: 2px;">&nbsp;</div>				
							{/foreach}
						{else}
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Nenhuma pesquisa cadastrada!</p>
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