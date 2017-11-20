<?php /* Smarty version 2.6.24, created on 2013-11-10 23:10:58
         compiled from admin/admin_relatorios.tpl */ ?>
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
	function relatorioPesquisa(id){
		window.location="/admin/admin_pesquisa_controller/relatorio_pesquisa/"+id;
	}
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
					
						<h2 class="title"><a >Relatórios   </a></h2>						
						<div style="clear: both; height: 5px;">&nbsp;</div>
						
						<?php if ($this->_tpl_vars['enquetes']): ?>
							<?php $_from = $this->_tpl_vars['enquetes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['enquete']):
?>							
								<p class="meta">
									<span class="span_responder_pesquisa"><?php echo $this->_tpl_vars['enquete']->titulo; ?>
</span>
									<div id="div_visualizar_relatorio">
										<input type="submit" id="btn_visualizar_relatorio" onclick="relatorioPesquisa(<?php echo $this->_tpl_vars['enquete']->id; ?>
)" value="visualizar relatório" />					
									</div>
								</p> 
								<div style="clear: both; height: 2px;">&nbsp;</div>				
							<?php endforeach; endif; unset($_from); ?>
						<?php else: ?>
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Nenhuma pesquisa disponível!</p>
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