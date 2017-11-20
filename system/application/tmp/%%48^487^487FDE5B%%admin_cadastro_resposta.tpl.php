<?php /* Smarty version 2.6.24, created on 2013-11-09 21:45:23
         compiled from admin/admin_cadastro_resposta.tpl */ ?>
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
	
		  $("#frm_resposta").validate({
			  rules: {
			    resposta: {
			      required: true
			    }
			  },
			  messages:{
				  resposta:  "<font color=\'red\'>Informe a resposta.</font>"
			  },
			  submitHandler: function( form ){
				  
					$("#resposta-submit").hide();
				  	$("#loader").show();
					var dados = $( form ).serialize();								
					var idPergunta = '; ?>
 <?php echo $this->_tpl_vars['pergunta']->id; ?>
 <?php echo ';
					
					$.ajax({
						type: "POST",
						url: "/admin/admin_pesquisa_controller/salvar_resposta",
						data: dados,
						success: function( data )
						{
							if(data == "Sucesso") {
								alert("Resposta cadastrada com sucesso!");
								window.location="/admin/admin_pesquisa_controller/visualizar_pergunta/" + idPergunta;
							}
							else if(data == "Erro")
							{
								alert("Esta resposta já está sendo usado nesta pergunta! Por favor, informe outra resposta!");
								$("#loader").hide();
							  	$("#resposta-submit").show();
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
</a> > <a class="lnk_breadcrumb" href="/admin/admin_pesquisa_controller/visualizar_pergunta/<?php echo $this->_tpl_vars['pergunta']->id; ?>
"><?php echo $this->_tpl_vars['pergunta']->pergunta; ?>
</a> > Nova resposta </p>
						<h2 class="title"><a >Cadastrar Resposta </a></h2>				
						<div id="resposta_pesquisa">
							<form id="frm_resposta" method="post">								
								<div>
									<label><font size="4" color="#32639A">Resposta: </font></label>
								</div>
								<div>														
									<input class="cl_enq_resposta" type="text" maxlength="150" name="resposta" id="resposta" value="" />																
								</div>								
								<div class="div_resposta_salvar">
									<input type="submit" value="Salvar" id="resposta-submit">
									<img src="/system/application/images/ajax-loader-preto.gif" id="loader" />
								</div>			
								<input type="hidden" name="id_pergunta" value="<?php echo $this->_tpl_vars['pergunta']->id; ?>
">		
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