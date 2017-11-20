<?php /* Smarty version 2.6.24, created on 2013-11-10 12:38:28
         compiled from esqueci_senha.tpl */ ?>
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

	  $("#frm_senha").validate({
		  rules: {
		    email: {
		     	required: true,
		     	email: true
			 }
		  },
		  messages:{	
			  	email: {required: "<font color=\'red\'>Informe o e-mail</font>", email: "<font color=\'red\'>E-mail inválido</font>"}		  
		  },
		  submitHandler: function( form ){			  
			  	
			  	$("#search-submit").hide();
			  	$("#loader").show();
				var dados = $( form ).serialize();								
				
				$.ajax({
					type: "POST",
					url: "/usuario_controller/enviarSenha",
					data: dados,
					success: function( data )
					{
						if(data == "Sucesso") {
							alert("E-mail enviado com sucesso!");
							window.location="/usuario_controller/login";
						} 
						else if(data == "Erro") {
							alert("E-mail não cadastrado! Por favor, realize seu cadastro!");
							window.location="/usuario_controller/esqueciSenha";
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
<body class="reduzido">
<div id="wrapper">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/cabecalho.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!-- end #header -->
	<div id="menu">		
	</div>
	<!-- end #menu -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<h2 class="title_cadastro"><font color="#32639A">Esqueci minha senha:</font></h2>
						<div id="esqueci" >
							<form id="frm_senha" method="post">
								<div>
									<label class="lb_esqueci_email"><font size="4" color="#FFFFE7">E-mail: </font></label>								
									<input class="cl_esqueci_email" type="text" maxlength="100" name="email" id="email" value="" />																
								</div>				
								<div class="btn_senha_enviar">		
									<p class="lnk_voltar"><a href="login"><u>Voltar</u></a></p>							
									<input type="submit" id="search-submit" value="Enviar" />
									<img src="/system/application/images/ajax-loader-preto.gif" id="loader" />
								</div>
							</form>
						</div>
					</div>
					
				<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div style="clear: both;">&nbsp;</div>				
			</div>
		</div>
	</div>
	<!-- end #page -->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/rodape.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>	
</body>
</html>