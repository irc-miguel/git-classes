<?php /* Smarty version 2.6.24, created on 2013-11-05 21:42:52
         compiled from admin/admin_cadastro_enquete.tpl */ ?>
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
		
		  $("#frm_enquete").validate({
			  rules: {
			    titulo: {
			      required: true
			    },
			    descricao: {
			      required: true
				}
			  },
			  messages:{
				  titulo:  "<font color=\'red\'>Informe o título.</font>",
				  descricao:  "<font color=\'red\'>Informe a descrição.</font>",
			  },
			  submitHandler: function( form ){
				  
					$("#enquete-submit").hide();
				  	$("#loader").show();
					var dados = $( form ).serialize();								
					
					$.ajax({
						type: "POST",
						url: "/admin/admin_pesquisa_controller/salvar_enquete",
						data: dados,
						success: function( data )
						{
							if(data == "Sucesso") {
								alert("Pesquisa cadastrada com sucesso!");
								window.location="/admin/admin_pesquisa_controller/listar_pesquisas";
							}
							else if(data == "Erro")
							{
								alert("Este título já está sendo usado em outra pesquisa! Por favor, informe outro título!");
								$("#loader").hide();
							  	$("#enquete-submit").show();
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
					
						<h2 class="title"><a >Cadastrar Pesquisa </a></h2>	
						<div id="enquete_pesquisa">
							<form id="frm_enquete" method="post">
								<div>
									<label class="cl_enq_titulo"><font size="4" color="#32639A">Título: </font></label>
								</div>
								<div id="dv_enq_titulo">														
									<input class="cl_enq_titulo" type="text" maxlength="100" name="titulo" id="titulo" value="<?php echo $this->_tpl_vars['titulo_enq']; ?>
" />																
								</div>
								<div>
									<label class="cl_enq_descricao"><font size="4" color="#32639A">Descrição: </font></label>
								</div>
								<div id="dv_enq_descricao">
									<textarea class="cl_enq_descricao" name="descricao" id="descricao" rows="5" cols="5"><?php echo $this->_tpl_vars['descricao_enq']; ?>
</textarea>																
								</div>
								<div class="div_enquete_salvar">
									<input type="submit" value="Salvar" id="enquete-submit">
									<img src="/system/application/images/ajax-loader-preto.gif" id="loader" />
								</div>					
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