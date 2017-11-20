<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
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
						<h2 class="title"><a >Painel Administrativo</a></h2>
						<p class="meta"><span class="date">Seja Bem Vindo <font color="#32639A">{$usuario_nome}</font> !</span></p> 
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
							<p>Olá Administrador, esse é seu espaço para gerenciar pesquisas, gerenciar contas de usuários, gerar relatórios, entre outras funcionalidades presentes na área administrativa.</p>							
						</div>
					</div>
					
					<div style="clear: both;">&nbsp;</div>
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