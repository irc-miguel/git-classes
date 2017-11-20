<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
	function responderPesquisa(id){
		window.location="/pesquisas_controller/responder_pesquisa/"+id;
	}
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
					
						<h2 class="title"><a >Pesquisas   </a></h2>						
						<div style="clear: both; height: 5px;">&nbsp;</div>
						
						{if $enquetes}
							{foreach from=$enquetes item='enquete'}							
								<p class="meta">
									<span class="span_responder_pesquisa">{$enquete->titulo} {if $enquete->respondida} <img src="/system/application/images/checked.gif" title="Pesquisa respondida" style="margin: -2px 3px;"> {/if}</span>
									<div id="div_responder_pesquisa">
										{if $enquete->respondida == false}
											<input type="submit" id="btn_responder_pesquisa" onclick="responderPesquisa({$enquete->id})" value="responder" />
										{/if}											
									</div>
								</p> 
								<div style="clear: both; height: 2px;">&nbsp;</div>				
							{/foreach}
						{else}
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">No momento não possuímos pesquisas disponíveis!</p>
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