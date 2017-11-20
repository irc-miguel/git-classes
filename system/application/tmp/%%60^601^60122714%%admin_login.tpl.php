<?php /* Smarty version 2.6.24, created on 2013-11-10 18:07:48
         compiled from admin/admin_login.tpl */ ?>
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
	    $("#frm_login_adm").validate({
			  rules: {
			    login: {
			      required: true,
			      email: true
			    },
			    senha: {
			     	required: true
				 },
		  	  },
		  	  messages:{
				login:  {required: "<font color=\'red\'>Informe um e-mail válido</font>", email: "<font color=\'red\'>Informe um e-mail válido</font>"},
				senha:  "<font color=\'red\'>Informe a senha</font>"
			  },
			  submitHandler: function( form ){			  
				  	
			  	$("#login_adm-submit").hide();
			  	$("#loader").show();
				var dados = $( form ).serialize();								
				
				$.ajax({
					type: "POST",
					url: "/admin/admin_controller/entrar",
					data: dados,
					success: function( data )
					{
						if(data == "Sucesso") {
							window.location="/admin/admin_controller/inicial";
						}
						else if(data == "Erro-senha") {
							alert("Senha incorreta!");
							$("#loader").hide();
						  	$("#login_adm-submit").show();
						}
						else if(data == "Erro-email") {
							alert("E-mail não cadastrado! Por favor, entre em contato com o admin do sistema!");
							window.location="/admin";
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
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/includes/cabecalho_admin.tpl", 'smarty_include_vars' => array()));
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
						<h2 class="title"><font color="#32639A">Entrar:</font></h2>
						<div id="login_adm" >
							<form id="frm_login_adm" method="post">
								<div>
									<label class="lb_email"><font size="4" color="#335B99">e-mail: </font></label>								
									<input class="cl_login" type="text" maxlength="50" name="login" id="login" value="" />
									<label class="lb_senha"><font size="4" color="#335B99">senha: </font></label>								
									<input class="cl_senha" type="password" maxlength="30" name="senha" id="senha" value="" />								
									<input type="submit" id="login_adm-submit" value="Entrar" />
									<p class="lnk_esqueci"><a href="/admin/admin_controller/esqueciSenha"><u>Esqueci minha senha</u></a></p>
								</div>
								<div id="loader"><img src="/system/application/images/ajax-loader-preto.gif" /></div>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/includes/rodape_admin.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>	
</body>
</html>