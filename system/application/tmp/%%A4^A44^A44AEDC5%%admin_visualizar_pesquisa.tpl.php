<?php /* Smarty version 2.6.24, created on 2013-11-10 21:06:46
         compiled from admin/admin_visualizar_pesquisa.tpl */ ?>
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
			    if(data == \'vazia\'){
			    	excluirPergunta(id_pergunta, id_enquete);
				}
				else if(data == \'possui_respostas\'){
					confirmacao = confirm("Esta pergunta possui respostas cadastradas. Tem certeza que deseja excluir a pergunta?");
					if (confirmacao){
						//caso confirmada a exclusão chamo o método Ajax excluirPergunta
						excluirPergunta(id_pergunta, id_enquete);
					}
			    }
				else
					alert(\'Erro na verificação da pergunta!\');
			  }
		});
	}

	function excluirPergunta(id_pergunta, id_enquete){
		$.ajax({
			  url: \'/admin/admin_pesquisa_controller/excluir_pergunta/\'+id_pergunta,
			  success: function(data) {
			    if(data == \'ok\'){
			    	alert(\'Pergunta excluída com sucesso!\');
			    	window.location="/admin/admin_pesquisa_controller/visualizar_pesquisa/"+id_enquete;
				}			
				else
					alert(\'Erro ao excluir pergunta!\');
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
					
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/listar_pesquisas">Pesquisas</a> > <a><?php echo $this->_tpl_vars['enquete']->titulo; ?>
</a></p>
						<h2 class="title"><a ><?php echo $this->_tpl_vars['enquete']->titulo; ?>
</a></h2>		
						<p><?php echo $this->_tpl_vars['enquete']->descricao; ?>
</p>	
							
						<p class="meta_botao"><input type="submit" id="btn_nova_pergunta" onclick="novaPergunta(<?php echo $this->_tpl_vars['enquete']->id; ?>
)" value="Nova Pergunta" /></p>
						<div style="clear: both; height: 5px;">&nbsp;</div>
						
						<?php if ($this->_tpl_vars['perguntas']): ?>
							<?php $_from = $this->_tpl_vars['perguntas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pergunta']):
?>							
								<p class="meta">
									<span><a class="lnk_pergunta" href="/admin/admin_pesquisa_controller/visualizar_pergunta/<?php echo $this->_tpl_vars['pergunta']->id; ?>
" alt="Visualizar Pergunta" ><?php echo $this->_tpl_vars['pergunta']->pergunta; ?>
</a></span>						
									<input type="submit" id="btn_editar_pergunta" onclick="editarPergunta(<?php echo $this->_tpl_vars['pergunta']->id; ?>
)" value="editar" />
									<input type="submit" id="btn_excluir_pergunta" onclick="confirmar_exclusao_pergunta(<?php echo $this->_tpl_vars['pergunta']->id; ?>
,<?php echo $this->_tpl_vars['enquete']->id; ?>
)" value="excluir" />
								</p> 
								<div style="clear: both; height: 2px;">&nbsp;</div>	
								<?php if ($this->_tpl_vars['pergunta']->respostas): ?>
									<?php $_from = $this->_tpl_vars['pergunta']->respostas; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['resposta']):
?>
										<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;"><?php echo $this->_tpl_vars['resposta']->resposta; ?>
</p>
									<?php endforeach; endif; unset($_from); ?>
								<?php else: ?>
									<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Não possui respostas!</p>
								<?php endif; ?>									
							<?php endforeach; endif; unset($_from); ?>
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