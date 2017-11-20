<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
{include file="includes/meta.tpl"}
<script type="text/javascript" src="/system/application/scripts/cadastro.js"></script>
<script type="text/javascript">
{literal}
  $(document).ready(function(){
	  	  
	  $("#cep").mask("99999-999");
	  $("#data_nasc").mask("99/99/9999");

	  $("#frm_edicao").validate({
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
			  	nome:  "<font color='red'>Informe o nome</font>",
			  	email:  {required: "<font color='red'>Informe o e-mail</font>", email: "<font color='red'>Informe um e-mail válido</font>"},
			  	estado: "<font color='red'>Informe o estado</font>",
			  	cidade: "<font color='red'>Informe a cidade</font>",
			  	sexo: "<font color='red'>Informe o sexo</font>",
			  	data_nasc: "<font color='red'>Informe a data nascimento</font>",
			  	escolaridade: "<font color='red'>Informe a escolaridade</font>",
			  	senha: "<font color='red'>Informe a senha</font>",
			  	conf_senha: {required: "<font color='red'>Por favor confirme sua senha</font>", equalTo: "<font color='red'>Senha precisa ser idêntica a anterior</font>"}
		  },
		  submitHandler: function( form ){
			  
				$("#edicao-submit").hide();
			  	$("#loader").show();
				var dados = $( form ).serialize();								
				
				$.ajax({
					type: "POST",
					url: "/usuario_controller/atualizarDados",
					data: dados,
					success: function( data )
					{
						if(data == "Sucesso") {
							alert("Dados alterados com sucesso!");
							window.location="/home_controller";
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
<body>
<div id="wrapper">
	{include file="includes/cabecalho.tpl"}
	<!-- end #header -->
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="/home_controller">Home</a></li>
			<li><a href="/pesquisas_controller">Pesquisas</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<h2 class="title_editar"><font color="#32639A">Editar meus dados:</font></h2>
				<div id="edicao" >
					<form id="frm_edicao" method="post" action="{$action}">
						<div id="dv_nome">
							<label class="lb_edicao_nome"><font size="4" color="#32639A">Nome: </font></label>								
							<input class="cl_edicao_nome" type="text" maxlength="100" name="nome" id="nome" value="{$usuario->nome}" />																
						</div>
						<div id="dv_email">
							<label class="lb_edicao_email"><font size="4" color="#32639A">Email: </font></label>								
							<input class="cl_edicao_email" type="text" maxlength="100" name="email" id="email" value="{$usuario->email_usuario}" />
						</div>
						<div id="dv_estado">
							<label class="lb_edicao_estado"><font size="4" color="#32639A">Estado: </font></label>
							<select class="cl_edicao_estado" name="estado" id="estado" onchange="atualizarCidades();">
								<option value="">Selecione</option>
								{foreach from=$listaEstados item='estado'}
									<option value="{$estado->id}" {if $estado_usuario->id == $estado->id}selected="selected"{/if}>{$estado->nome}</option>
								{/foreach}
							</select>
						</div>
						<div id="dv_cidade">
							<label class="lb_edicao_cidade"><font size="4" color="#32639A">Cidade: </font></label>
							<select class="cl_edicao_cidade" name="cidade" id="cidade">								
								<option value="">Selecione a cidade</option>
								{foreach from=$listaCidades item='cidade'}
									<option value="{$cidade->id}" {if $usuario->cod_cidade == $cidade->id}selected="selected"{/if}>{$cidade->nome}</option>
								{/foreach}
							</select>
						</div>								
						<div id="dv_cep">
							<label class="lb_edicao_cep"><font size="4" color="#32639A">CEP: </font></label>
							<input class="cl_edicao_cep" type="text" maxlength="20" name="cep" id="cep" value="{$usuario->cep}" />
						</div>								
						<div id="dv_sexo">
							<label class="lb_edicao_sexo"><font size="4" color="#32639A">Sexo: </font></label>
							<select class="cl_edicao_sexo" name="sexo" id="sexo" >
								<option value="">Selecione</option>
								<option value="Feminino" {if $usuario->sexo == 'Feminino'}selected="selected"{/if}>Feminino</option>
								<option value="Masculino" {if $usuario->sexo == 'Masculino'}selected="selected"{/if}>Masculino</option>
							</select>
						</div>
						<div id="dv_nasc">
							<label class="lb_edicao_dtnasc"><font size="4" color="#32639A">Data nascimento: </font></label>
							<input class="cl_edicao_dtnasc" type="text" maxlength="20" name="data_nasc" id="data_nasc" value="{$usuario->data_nascimento}" />
						</div>
						<div id="dv_escolaridade">
							<label class="lb_edicao_escolaridade"><font size="4" color="#32639A">Escolaridade: </font></label>
							<select class="cl_edicao_escolaridade" name="escolaridade" id="escolaridade">
								<option value="">Selecione</option>
								{foreach from=$listaEscolaridade item='escolaridade'}
									<option value="{$escolaridade->id}" {if $usuario->escolaridade == $escolaridade->id}selected="selected"{/if}>{$escolaridade->nivel}</option>
								{/foreach}
							</select>
						</div>
						<div id="dv_senha">
							<label class="lb_edicao_senha"><font size="4" color="#32639A">Senha: </font></label>
							<input class="cl_edicao_senha" type="password" maxlength="20" name="senha" id="senha" value="{$usuario->senha}" />
						</div>
						<div id="dv_confSenha">
							<label class="lb_edicao_confsenha"><font size="4" color="#32639A">Confirme a Senha: </font></label>
							<input class="cl_edicao_confsenha" type="password" maxlength="20" name="conf_senha" id="conf_senha" value="{$usuario->senha}" />
						</div>
						<input type="hidden" name="hdn_id_usuario" value="{$usuario_id}" />
						<div class="div_edicao_salvar">									
							<input type="submit" id="edicao-submit" value="Salvar" />
							<img src="/system/application/images/ajax-loader-preto.gif" id="loader" />
						</div>								
					</form>
				</div>
			</div>
		</div>
		<!-- end #content -->
		{include file="includes/menu_lateral.tpl"}
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	</div>
	</div>
	<!-- end #page -->
	{include file="includes/rodape.tpl"}
</div>	
</body>
</html>