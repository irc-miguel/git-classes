<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
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
					
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/relatorios">Relatórios</a> > Visualizar</p>
						<h2 class="title"><a >{$enquete->titulo}</a></h2>		
						<p>{$enquete->descricao}</p>										
												
						{if $perguntas}
								
								<!-- Perguntas -->
								{foreach from=$perguntas item='pergunta'}							
									<p class="meta">
										<span class="span_pergunta_pesquisa">{$pergunta->pergunta}</span>
									</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>										
									<!-- Respostas -->
									{if $pergunta->respostas}
										{foreach from=$pergunta->respostas item='resposta'}
											<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">{$resposta->resposta} <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">(Qtde: {$resposta->qtde_resposta} - {$resposta->porcentagem}%)</span></p>											
										{/foreach}
									{else}
										<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Não possui respostas!</p>
									{/if}
									<div style="clear: both; height: 10px;">&nbsp;</div>
								{/foreach}								
												
								<!-- Estatísticas dos usuários -->
								<p class="meta">
									<span style="color: #758F47; float: left; height: 24px; padding: 3px 15px; text-decoration: none;">Estatísticas dos usuários - Participantes</span>
								</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Qtde de usuários que participaram da pesquisa: <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$qtde_participantes}</span></p>
									<div style="clear: both; height: 10px;">&nbsp;</div>
								
								<p class="meta">
									<span style="color: #758F47; float: left; height: 24px; padding: 3px 15px; text-decoration: none;">Estatísticas dos usuários - Sexo</span>
								</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Sexo (masculino): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$qtde_masculino}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Sexo (feminino): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$qtde_feminino}</span></p>
									<div style="clear: both; height: 10px;">&nbsp;</div>
									
								<p class="meta">
									<span style="color: #758F47; float: left; height: 24px; padding: 3px 15px; text-decoration: none;">Estatísticas dos usuários - Escolaridade</span>
								</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>										
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Ensino Fundamental Incompleto): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$ensino_fundamental_incompleto}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Ensino Fundamental Completo): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$ensino_fundamental_completo}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Ensino Médio Incompleto): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$ensino_medio_incompleto}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Ensino Médio Completo): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$ensino_medio_completo}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Técnico/Pós-Médio Incompleto): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$tecnico_posmedio_incompleto}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Técnico/Pós-Médio Completo): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$tecnico_posmedio_completo}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Superior Incompleto): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$superior_incompleto}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Superior Completo): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$superior_completo}</span></p>
									<div style="clear: both; height: 10px;">&nbsp;</div>
								
								<p class="meta">
									<span style="color: #758F47; float: left; height: 24px; padding: 3px 15px; text-decoration: none;">Estatísticas dos usuários - Faixa etária</span>
								</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>		
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (até 18 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$idade_ate_18}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (19 - 25 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$idade_19_25}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (26 - 35 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$idade_26_35}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (36 - 55 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$idade_36_55}</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (mais que 55 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">{$idade_mais_55}</span></p>
									<div style="clear: both; height: 10px;">&nbsp;</div>
								
								<!-- Link voltar -->
								<div class="dv_relatorio_pesquisa_voltar">
									<p class="lnk_voltar"><a href="/admin/admin_pesquisa_controller/relatorios"><u>Voltar</u></a></p>
								</div>
						
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