<?php /* Smarty version 2.6.24, created on 2013-11-10 22:09:57
         compiled from cadastro.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/meta.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="/system/application/scripts/cadastro.js"></script>
<script type="text/javascript">
<?php echo '
  $(document).ready(function(){
	  	  
	  $("#cep").mask("99999-999");
	  $("#data_nasc").mask("99/99/9999");

	  $("#frm_cadastro").validate({
		  rules: {
		    nome: {
		      required: true
		    },
		    email: {
		     	required: true,
		     	email: true
			 },
			estado: {
		     	required: true
			 }, 
		 	cidade: {
		     	required: true
			 },
		 	sexo: {
		     	required: true
			 },
			data_nasc: {
		     	required: true
			 },
			escolaridade: {
				required: true
			 },			 
		 	senha: {
		     	required: true
			 },
			conf_senha: {
			       required: true,
			       equalTo: "#senha"
			 }
		  },
		  messages:{
			  	nome:  "<font color=\'red\'>Informe o nome</font>",
			  	email:  {required: "<font color=\'red\'>Informe o e-mail</font>", email: "<font color=\'red\'>Informe um e-mail válido</font>"},
			  	estado: "<font color=\'red\'>Informe o estado</font>",
			  	cidade: "<font color=\'red\'>Informe a cidade</font>",
			  	sexo: "<font color=\'red\'>Informe o sexo</font>",
			  	data_nasc: "<font color=\'red\'>Informe a data nascimento</font>",
			  	escolaridade: "<font color=\'red\'>Informe a escolaridade</font>",
			  	senha: "<font color=\'red\'>Informe a senha</font>",
			  	conf_senha: {required: "<font color=\'red\'>Por favor confirme sua senha</font>", equalTo: "<font color=\'red\'>Senha precisa ser idêntica a anterior</font>"}
		  },
		  submitHandler: function( form ){
			  
				$("#search-submit").hide();
			  	$("#loader").show();
				var dados = $( form ).serialize();								
				
				$.ajax({
					type: "POST",
					url: "/usuario_controller/salvarCadastro",
					data: dados,
					success: function( data )
					{
						if(data == "Sucesso") {
							alert("Cadastro realizado com sucesso!");
							window.location="/usuario_controller/login";
						} 
						else if(data == "Erro") {
							alert("E-mail já cadastrado! Por favor, informe outro e-mail!");
							$("#loader").hide();
						  	$("#search-submit").show();
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
						<h2 class="title_cadastro"><font color="#32639A">Cadastro:</font></h2>
						<div id="cadastro" >
							<form id="frm_cadastro" method="post">
								<div id="dv_nome">
									<div><label class="lb_cadastro_nome"><font size="4" color="#FFFFE7">Nome: </font></label></div>								
									<div><input class="cl_cadastro_nome" type="text" maxlength="100" name="nome" id="nome" value="" /></div>																
								</div>
								<div id="dv_email">
									<div><label class="lb_cadastro_email"><font size="4" color="#FFFFE7">E-mail: </font></label></div>								
									<div><input class="cl_cadastro_email" type="text" maxlength="100" name="email" id="email" value="" /></div>
								</div>
								<div id="dv_estado">
									<div><label class="lb_cadastro_estado"><font size="4" color="#FFFFE7">Estado: </font></label></div>
									<div>
										<select class="cl_cadastro_estado" name="estado" id="estado" onchange="atualizarCidades();">
											<option value="">Selecione</option>
											<?php $_from = $this->_tpl_vars['listaEstados']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['estado']):
?>
												<option value="<?php echo $this->_tpl_vars['estado']->id; ?>
"><?php echo $this->_tpl_vars['estado']->nome; ?>
</option>
											<?php endforeach; endif; unset($_from); ?>
										</select>
									</div>
								</div>
								<div id="dv_cidade">
									<div><label class="lb_cadastro"><font size="4" color="#FFFFE7">Cidade: </font></label></div>
									<div>
										<select class="cl_cadastro_cidade" name="cidade" id="cidade">
											<option value="">Selecione a cidade</option>
										</select>
									</div>
								</div>								
								<div id="dv_cep">
									<div><label class="lb_cadastro"><font size="4" color="#FFFFE7">CEP: </font></label></div>
									<div><input class="cl_cadastro_cep" type="text" name="cep" id="cep" value="" /></div>
								</div>								
								<div id="dv_sexo">
									<div><label class="lb_cadastro"><font size="4" color="#FFFFE7">Sexo: </font></label></div>
									<div>
										<select class="cl_cadastro_sexo" name="sexo" id="sexo" >
											<option value="">Selecione</option>
											<option value="Feminino">Feminino</option>
											<option value="Masculino">Masculino</option>
										</select>
									</div>
								</div>								
								<div id="dv_nasc">
									<div><label class="lb_cadastro"><font size="4" color="#FFFFE7">Data nascimento: </font></label></div>
									<div><input class="cl_cadastro_dtnasc" type="text" maxlength="20" name="data_nasc" id="data_nasc" value="" /></div>
								</div>
								<div id="dv_escolaridade">
									<div><label class="lb_cadastro_escolaridade"><font size="4" color="#FFFFE7">Escolaridade: </font></label></div>
									<div>
										<select class="cl_cadastro_escolaridade" name="escolaridade" id="escolaridade">
											<option value="">Selecione</option>
											<?php $_from = $this->_tpl_vars['listaEscolaridade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['escolaridade']):
?>
												<option value="<?php echo $this->_tpl_vars['escolaridade']->id; ?>
"><?php echo $this->_tpl_vars['escolaridade']->nivel; ?>
</option>
											<?php endforeach; endif; unset($_from); ?>
										</select>
									</div>
								</div>
								<div id="dv_senha">
									<div><label class="lb_cadastro"><font size="4" color="#FFFFE7">Senha: </font></label></div>
									<div><input class="cl_cadastro_senha" type="password" maxlength="20" name="senha" id="senha" /></div>
								</div>
								<div id="dv_confSenha">
									<div><label class="lb_cadastro"><font size="4" color="#FFFFE7">Confirme a Senha: </font></label></div>
									<div><input class="cl_cadastro_confsenha" type="password" maxlength="20" name="conf_senha" id="conf_senha" /></div>
								</div>
								<div class="dv_cadastro_salvar">
									<p class="lnk_voltar"><a href="login"><u>Voltar</u></a></p>									
									<input type="submit" id="search-submit" value="Salvar" />
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