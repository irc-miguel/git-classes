<?php /* Smarty version 2.6.24, created on 2013-11-10 23:11:19
         compiled from login.tpl */ ?>
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
	    $("#frm_login").validate({
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
				  	
			  	$("#search-submit").hide();
			  	$("#loader").show();
				var dados = $( form ).serialize();								
				
				$.ajax({
					type: "POST",
					url: "/usuario_controller/entrar",
					data: dados,
					success: function( data )
					{
						if(data == "Sucesso") {
							window.location="/home_controller";
						} 
						else if(data == "Erro-usuario") {
							alert("É preciso ser usuário para responder as pesquisas!");
							window.location="/usuario_controller/login";
						}
						else if(data == "Erro-senha") {
							alert("Senha incorreta!");
							$("#loader").hide();
						  	$("#search-submit").show();
						}
						else if(data == "Erro-email") {
							alert("E-mail não cadastrado! Por favor, realize seu cadastro!");
							window.location="/usuario_controller/login";
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
						<h2 class="title"><font color="#32639A">Entrar:</font></h2>
						<div id="search" >
							<form id="frm_login" method="post">
								<div>
									<label class="lb_email"><font size="4" color="#FFFFE7">e-mail: </font></label>								
									<input class="cl_login" type="text" maxlength="50" name="login" id="login" value="" />
									<label class="lb_senha"><font size="4" color="#FFFFE7">senha: </font></label>								
									<input class="cl_senha" type="password" maxlength="30" name="senha" id="senha" value="" />								
									<input type="submit" id="search-submit" value="Entrar" />									
									<p class="lnk_esqueci"><a href="/usuario_controller/esqueciSenha"><u>Esqueci minha senha</u></a></p>
									<p class="lnk_cadastro"><a href="/usuario_controller/cadastro"><u>Cadastre-se</u></a></p>									
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
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/rodape.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>	
</body>
</html>