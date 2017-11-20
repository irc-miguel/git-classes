<?php /* Smarty version 2.6.24, created on 2013-11-10 21:06:39
         compiled from admin/admin_pesquisas.tpl */ ?>
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
			  url: \'/admin/admin_pesquisa_controller/verifica_enquete/\'+id_enq,
			  success: function(data) {
			    if(data == \'vazia\'){
			    	excluirEnquete(id_enq);
				}
			    else if(data == \'possui_perguntas\'){
			    	confirmacao = confirm("Esta pesquisa possui perguntas cadastradas. Tem certeza que deseja excluir a pesquisa?");
					if (confirmacao){
						//caso confirmada a exclusão chamo o método Ajax excluirEnquete
						excluirEnquete(id_enq);
					}
			    }
				else if(data == \'possui_respostas\'){
					confirmacao = confirm("Esta pesquisa possui perguntas e respostas cadastradas. Tem certeza que deseja excluir a pesquisa?");
					if (confirmacao){
						//caso confirmada a exclusão chamo o método Ajax excluirEnquete
						excluirEnquete(id_enq);
					}
			    }
				else
					alert(\'Erro na verificação da enquete!\');
			  }
		});
	}

	function excluirEnquete(id_enq){
		$.ajax({
			  url: \'/admin/admin_pesquisa_controller/excluir_enquete/\'+id_enq,
			  success: function(data) {
			    if(data == \'ok\'){
			    	alert(\'Pesquisa excluída com sucesso!\');
			    	window.location="/admin/admin_pesquisa_controller/listar_pesquisas";
				}			
				else
					alert(\'Erro ao excluir pesquisa!\');
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
					
						<h2 class="title"><a >Pesquisas   </a></h2>				
						<p class="meta_botao"><input type="submit" id="btn_nova_enquete" onclick="novaEnquete()" value="Nova Pesquisa" /></p>						
						<div style="clear: both; height: 5px;">&nbsp;</div>
						
						<?php if ($this->_tpl_vars['enquetes']): ?>
							<?php $_from = $this->_tpl_vars['enquetes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['enquete']):
?>							
								<p class="meta">
									<span><a class="lnk_pesquisa" href="/admin/admin_pesquisa_controller/visualizar_pesquisa/<?php echo $this->_tpl_vars['enquete']->id; ?>
"><?php echo $this->_tpl_vars['enquete']->titulo; ?>
</a></span>
									<input type="submit" id="btn_editar_pergunta" onclick="alterarEnquete(<?php echo $this->_tpl_vars['enquete']->id; ?>
)" value="editar" />
									<input type="submit" id="btn_excluir_pergunta" onclick="confirmar_exclusao(<?php echo $this->_tpl_vars['enquete']->id; ?>
)" value="excluir" />
								</p> 
								<div style="clear: both; height: 2px;">&nbsp;</div>				
							<?php endforeach; endif; unset($_from); ?>
						<?php else: ?>
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Nenhuma pesquisa cadastrada!</p>
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