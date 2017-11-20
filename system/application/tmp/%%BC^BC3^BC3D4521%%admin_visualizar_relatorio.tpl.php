<?php /* Smarty version 2.6.24, created on 2013-11-10 23:12:35
         compiled from admin/admin_visualizar_relatorio.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/meta.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
<?php echo '
'; ?>

</script>
</head>
<body>
<div id="wrapper">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/includes/cabecalho_admin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!-- end #header -->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/includes/menu_admin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!-- end #menu -->
	
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
					
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/relatorios">Relatórios</a> > Visualizar</p>
						<h2 class="title"><a ><?php echo $this->_tpl_vars['enquete']->titulo; ?>
</a></h2>		
						<p><?php echo $this->_tpl_vars['enquete']->descricao; ?>
</p>							
						<p style="font-family: Arial,Helvetica,sans-serif; font-weight: normal; color: #FF0000; margin-top: 15px;">*Cálculo de porcentagem baseado nas respostas mais usadas pelos usuários.</p>										
												
						<?php if ($this->_tpl_vars['perguntas']): ?>
								
								<!-- Perguntas -->
								<?php $_from = $this->_tpl_vars['perguntas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pergunta']):
?>							
									<p class="meta">
										<span class="span_pergunta_pesquisa"><?php echo $this->_tpl_vars['pergunta']->pergunta; ?>
</span>
									</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>										
									<!-- Respostas -->
									<?php if ($this->_tpl_vars['pergunta']->respostas): ?>
										<?php $_from = $this->_tpl_vars['pergunta']->respostas; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['resposta']):
?>
											<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;"><?php echo $this->_tpl_vars['resposta']->resposta; ?>
 <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;">(Qtde: <?php echo $this->_tpl_vars['resposta']->total; ?>
 - <?php echo $this->_tpl_vars['resposta']->porcentagem; ?>
%)</span></p>											
										<?php endforeach; endif; unset($_from); ?>
									<?php else: ?>
										<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Não possui respostas!</p>
									<?php endif; ?>
									<div style="clear: both; height: 10px;">&nbsp;</div>
								<?php endforeach; endif; unset($_from); ?>								
												
								<!-- Estatísticas dos usuários -->
								<p class="meta">
									<span style="color: #758F47; float: left; height: 24px; padding: 3px 15px; text-decoration: none;">Estatísticas dos usuários - Participantes</span>
								</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Qtde de usuários que participaram da pesquisa: <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['qtde_participantes']; ?>
</span></p>
									<div style="clear: both; height: 10px;">&nbsp;</div>
								
								<p class="meta">
									<span style="color: #758F47; float: left; height: 24px; padding: 3px 15px; text-decoration: none;">Estatísticas dos usuários - Sexo</span>
								</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Sexo (masculino): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['qtde_masculino']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Sexo (feminino): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['qtde_feminino']; ?>
</span></p>
									<div style="clear: both; height: 10px;">&nbsp;</div>
									
								<p class="meta">
									<span style="color: #758F47; float: left; height: 24px; padding: 3px 15px; text-decoration: none;">Estatísticas dos usuários - Escolaridade</span>
								</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>										
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Ensino Fundamental Incompleto): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['ensino_fundamental_incompleto']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Ensino Fundamental Completo): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['ensino_fundamental_completo']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Ensino Médio Incompleto): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['ensino_medio_incompleto']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Ensino Médio Completo): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['ensino_medio_completo']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Técnico/Pós-Médio Incompleto): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['tecnico_posmedio_incompleto']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Técnico/Pós-Médio Completo): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['tecnico_posmedio_completo']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Superior Incompleto): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['superior_incompleto']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Escolaridade (Superior Completo): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['superior_completo']; ?>
</span></p>
									<div style="clear: both; height: 10px;">&nbsp;</div>
								
								<p class="meta">
									<span style="color: #758F47; float: left; height: 24px; padding: 3px 15px; text-decoration: none;">Estatísticas dos usuários - Faixa etária</span>
								</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>		
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (até 18 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['idade_ate_18']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (19 - 25 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['idade_19_25']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (26 - 35 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['idade_26_35']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (36 - 55 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['idade_36_55']; ?>
</span></p>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Faixa etária (mais que 55 anos): <span style="font-family: Arial,Helvetica,sans-serif; font-weight:normal; color: #FF0000; margin: 0 14px;"><?php echo $this->_tpl_vars['idade_mais_55']; ?>
</span></p>
									<div style="clear: both; height: 10px;">&nbsp;</div>
								
								<!-- Link voltar -->
								<div class="dv_relatorio_pesquisa_voltar">
									<p class="lnk_voltar"><a href="/admin/admin_pesquisa_controller/relatorios"><u>Voltar</u></a></p>
								</div>
						
						<?php else: ?>
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Não possui perguntas!</p>
						<?php endif; ?>						
						
					</div>
				<div style="clear: both; height: 146px;">&nbsp;</div>
				</div>
				<!-- end #content -->
				
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/includes/menu_lateral_admin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<!-- end #sidebar -->
				
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/includes/rodape_admin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
</div>	
</body>
</html>