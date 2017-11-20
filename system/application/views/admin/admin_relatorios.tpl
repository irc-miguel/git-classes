<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
	function relatorioPesquisa(id){
		window.location="/admin/admin_pesquisa_controller/relatorio_pesquisa/"+id;
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
					
						<h2 class="title"><a >Relatórios   </a></h2>						
						<div style="clear: both; height: 5px;">&nbsp;</div>
						
						{if $enquetes}
							{foreach from=$enquetes item='enquete'}							
								<p class="meta">
									<span class="span_responder_pesquisa">{$enquete->titulo}</span>
									<div id="div_visualizar_relatorio">
										<input type="submit" id="btn_visualizar_relatorio" onclick="relatorioPesquisa({$enquete->id})" value="visualizar relatório" />					
									</div>
								</p> 
								<div style="clear: both; height: 2px;">&nbsp;</div>				
							{/foreach}
						{else}
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Nenhuma pesquisa disponível!</p>
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