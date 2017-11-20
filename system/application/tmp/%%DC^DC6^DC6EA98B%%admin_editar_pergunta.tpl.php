<?php /* Smarty version 2.6.24, created on 2013-11-09 21:43:45
         compiled from admin/admin_editar_pergunta.tpl */ ?>
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
	$(document).ready(function(){
	
		  $("#frm_pergunta").validate({
			  rules: {
			    pergunta: {
			      required: true
			    },
			    tipo_pergunta: {
			      required: true
			    }
			  },
			  messages:{
				  pergunta:  "<font color=\'red\'>Informe a pergunta.</font>",
				  tipo_pergunta: "<font color=\'red\'>Informe o tipo da pergunta.</font>"
			  },
			  submitHandler: function( form ){
				  
					$("#pergunta-submit").hide();
				  	$("#loader").show();
					var dados = $( form ).serialize();								
					var idEnquete = '; ?>
 <?php echo $this->_tpl_vars['enquete']->id; ?>
 <?php echo ';
					
					$.ajax({
						type: "POST",
						url: "/admin/admin_pesquisa_controller/atualizar_pergunta",
						data: dados,
						success: function( data )
						{
							if(data == "Sucesso") {
								alert("Pergunta alterada com sucesso!");
								window.location="/admin/admin_pesquisa_controller/visualizar_pesquisa/" + idEnquete;
							}
							else if(data == "Erro")
							{
								alert("Esta pergunta já está sendo usado nesta pesquisa! Por favor, informe outra pergunta!");
								$("#loader").hide();
							  	$("#pergunta-submit").show();
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown)
						{
							alert("ERRO: "+textStatus);
						}
					});
		
					return false;
			  }
		  });		  
	});
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
</a> > Editar pergunta </p>
						<h2 class="title"><a >Editar Pergunta </a></h2>		
						<div id="pergunta_pesquisa">		
							<form id="frm_pergunta" method="post">								
								<div>
									<label><font size="4" color="#32639A">Pergunta: </font></label>
								</div>
								<div>														
									<input class="cl_enq_pergunta" type="text" maxlength="150" name="pergunta" id="pergunta" value="<?php echo $this->_tpl_vars['pergunta']->pergunta; ?>
" />																
								</div>
								<div>
									<label><font size="4" color="#32639A">Tipo pergunta: </font></label>
								</div>
								<div>
									<select class="cl_pergunta_tipo" name="tipo_pergunta" id="tipo_pergunta" >
										<option value="">Selecione</option>
										<?php $_from = $this->_tpl_vars['listaTipos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tipo']):
?>
											<option value="<?php echo $this->_tpl_vars['tipo']->id_tipo; ?>
" <?php if ($this->_tpl_vars['pergunta']->tipo == $this->_tpl_vars['tipo']->id_tipo): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['tipo']->tipo; ?>
</option>
										<?php endforeach; endif; unset($_from); ?>
									</select>
								</div>
								<div class="div_pergunta_salvar">
									<input type="submit" value="Salvar" id="pergunta-submit">
									<img src="/system/application/images/ajax-loader-preto.gif" id="loader" />
								</div>	
								<input type="hidden" name="id_pergunta" value="<?php echo $this->_tpl_vars['pergunta']->id; ?>
" >
								<input type="hidden" name="pergunta_titulo" value="<?php echo $this->_tpl_vars['pergunta']->pergunta; ?>
" >
								<input type="hidden" name="id_enquete" value="<?php echo $this->_tpl_vars['pergunta']->id_enquete; ?>
" >				
							</form>
						</div>
						
					</div>		
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