<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript">
{literal}
  $(document).ready(function(){

	  $("#frm_senha_adm").validate({
		  rules: {
		    email: {
		     	required: true,
		     	email: true
			 }
		  },
		  messages:{	
			  	email: {required: "<font color='red'>Informe o e-mail</font>", email: "<font color='red'>E-mail inválido</font>"}		  
		  },
		  submitHandler: function( form ){			  
			  	
			  	$("#login_adm-submit").hide();
			  	$("#loader").show();
				var dados = $( form ).serialize();								
				
				$.ajax({
					type: "POST",
					url: "/admin/admin_controller/enviarSenha",
					data: dados,
					success: function( data )
					{
						if(data == "Sucesso") {
							alert("E-mail enviado com sucesso!");
							window.location="/admin";
						} 
						else if(data == "Erro") {
							alert("E-mail não cadastrado! Por favor, entre em contato com o admin do sistema!");
							window.location="/admin/admin_controller/esqueciSenha";
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
{/literal}
</script>
</head>
<body class="reduzido">
<div id="wrapper">
	{include file="admin/includes/cabecalho_admin.tpl"}
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
						<div id="esqueci_admin" >
							<form id="frm_senha_adm" method="post">
								<div>
									<label class="lb_esqueci_email"><font size="4" color="#335b99">E-mail: </font></label>								
									<input class="cl_esqueci_email" type="text" maxlength="100" name="email" id="email" value="" />																
								</div>
								<div class="btn_senha_enviar">		
									<p class="lnk_voltar"><a href="/admin"><u>Voltar</u></a></p>							
									<input type="submit" id="login_adm-submit" value="Enviar" />
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
	{include file="admin/includes/rodape_admin.tpl"}
</div>	
</body>
</html>