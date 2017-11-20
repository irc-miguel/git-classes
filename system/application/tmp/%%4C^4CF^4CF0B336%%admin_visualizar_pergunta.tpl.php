<?php /* Smarty version 2.6.24, created on 2013-11-09 21:49:00
         compiled from admin/admin_visualizar_pergunta.tpl */ ?>
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
			  url: \'/admin/admin_pesquisa_controller/excluir_resposta/\'+id_resposta,
			  success: function(data) {
			    if(data == \'ok\'){
			    	alert(\'Resposta excluída com sucesso!\');
			    	window.location="/admin/admin_pesquisa_controller/visualizar_pergunta/"+id_pergunta;
				}			
				else
					alert(\'Erro ao excluir resposta!\');
			  }
		});
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
					
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/listar_pesquisas">Pesquisas</a> > <a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/visualizar_pesquisa/<?php echo $this->_tpl_vars['enquete']->id; ?>
"><?php echo $this->_tpl_vars['enquete']->titulo; ?>
</a> > <a><?php echo $this->_tpl_vars['pergunta']->pergunta; ?>
</a></p>
						<h2 class="title"><a ><?php echo $this->_tpl_vars['pergunta']->pergunta; ?>
</a></h2>
						<p>Tipo: <?php echo $this->_tpl_vars['tipo_pergunta']; ?>
</p>
							
						<p class="meta_botao"><input type="submit" id="btn_nova_resposta" onclick="novaResposta(<?php echo $this->_tpl_vars['pergunta']->id; ?>
)" value="Nova Resposta" /></p>
						<div style="clear: both; height: 5px;">&nbsp;</div>
						
						<?php if ($this->_tpl_vars['respostas']): ?>
							<?php $_from = $this->_tpl_vars['respostas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['resposta']):
?>							
								<p class="meta">
									
									<span class="span_resposta"><?php echo $this->_tpl_vars['resposta']->resposta; ?>
</span>					
									<input type="submit" id="btn_editar_pergunta" onclick="editarResposta(<?php echo $this->_tpl_vars['resposta']->id; ?>
)" value="editar" />
									<input type="submit" id="btn_excluir_pergunta" onclick="confirmar_exclusao_resposta(<?php echo $this->_tpl_vars['resposta']->id; ?>
,<?php echo $this->_tpl_vars['pergunta']->id; ?>
)" value="excluir" />
								</p>
								<div style="clear: both; height: 2px;">&nbsp;</div>
							<?php endforeach; endif; unset($_from); ?>
						<?php else: ?>
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Não possui respostas!</p>
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