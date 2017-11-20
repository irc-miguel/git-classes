<?php /* Smarty version 2.6.24, created on 2013-11-10 23:11:34
         compiled from visualizar_pesquisa.tpl */ ?>
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
	function enviarResultado()
	{
		$("#pesquisa-submit").hide();
	  	$("#loader").show();
		var dados = $("#frm_responder_pesquisa").serialize();								
		
		$.ajax({
			type: "POST",
			url: "/pesquisas_controller/salvar_resultado_pesquisa",
			data: dados,
			success: function( data )
			{
				if(data == "Sucesso") {
					alert("Informações salvas com sucesso! Obrigado por responder nossa pesquisa!");
					window.location="/pesquisas_controller";
				} 
				else if(data == "Erro") {
					alert("É necessário responder todas as perguntas! Por favor, tente novamente.");
					$("#loader").hide();
				  	$("#pesquisa-submit").show();
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown)
			{
				alert("ERRO: "+textStatus);					  	
			}
		});
	
		return false;	
	}
	
	$(document).ready(function() {
		$("#frm_responder_pesquisa").submit(function() {
			return enviarResultado();
		});
	});
'; ?>

</script>
</head>
<body>
<div id="wrapper">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/cabecalho.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!-- end #header -->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!-- end #menu -->
	
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
					
						<p class="breadcrumb"><a class="lnk_breadcrumb" href="/pesquisas_controller">Pesquisas</a> > Responder</p>
						<h2 class="title"><a ><?php echo $this->_tpl_vars['enquete']->titulo; ?>
</a></h2>		
						<p><?php echo $this->_tpl_vars['enquete']->descricao; ?>
</p>							
						<div style="clear: both; height: 5px;">&nbsp;</div>
												
						<?php if ($this->_tpl_vars['perguntas']): ?>
							<form id="frm_responder_pesquisa" method="post">
								
								<!-- Perguntas -->
								<?php $_from = $this->_tpl_vars['perguntas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pergunta']):
?>							
									<p class="meta">
										<span class="span_pergunta_pesquisa"><?php echo $this->_tpl_vars['pergunta']->pergunta; ?>
</span>
										<input type="hidden" name="hdn_pergunta_id-<?php echo $this->_tpl_vars['pergunta']->id; ?>
" value="<?php echo $this->_tpl_vars['pergunta']->id; ?>
" />
									</p> 
									<div style="clear: both; height: 2px;">&nbsp;</div>										
									<!-- Respostas -->
									<?php if ($this->_tpl_vars['pergunta']->respostas): ?>
										<?php $_from = $this->_tpl_vars['pergunta']->respostas; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['resposta']):
?>
											
											<?php if ($this->_tpl_vars['pergunta']->tipo == 1): ?>											
												<input class="optativa" type="radio" name="radio_pergunta_id-<?php echo $this->_tpl_vars['pergunta']->id; ?>
" value="<?php echo $this->_tpl_vars['resposta']->id; ?>
"><span class="alternativa"><?php echo $this->_tpl_vars['resposta']->resposta; ?>
</span><br>
											<?php else: ?>
												<input class="multipla_escolha" type="checkbox" name="checkbox_pergunta_id-<?php echo $this->_tpl_vars['pergunta']->id; ?>
[]" value="<?php echo $this->_tpl_vars['resposta']->id; ?>
"><span class="alternativa"><?php echo $this->_tpl_vars['resposta']->resposta; ?>
</span><br>
											<?php endif; ?>
											
										<?php endforeach; endif; unset($_from); ?>
									<?php else: ?>
										<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #787878; margin: 0 14px;">Não possui alternativas!</p>
									<?php endif; ?>
									<div style="clear: both; height: 10px;">&nbsp;</div>												
								<?php endforeach; endif; unset($_from); ?>
								
								<input type="hidden" name="hdn_enquete-id" value="<?php echo $this->_tpl_vars['enquete']->id; ?>
" />
								
								<div class="dv_resposta_pesquisa_salvar">
									<p class="lnk_voltar"><a href="/pesquisas_controller"><u>Voltar</u></a></p>									
									<input type="submit" id="pesquisa-submit" value="Salvar" />
									<img src="/system/application/images/ajax-loader-preto.gif" id="loader" />
								</div>
							</form>
						<?php else: ?>
							<p style="font-family: Arial,Helvetica,sans-serif; font-weight: bold; color: #4486C7;">Não possui perguntas!</p>
						<?php endif; ?>						
						
					</div>
				<div style="clear: both; height: 146px;">&nbsp;</div>
				</div>
				<!-- end #content -->
				
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/menu_lateral.tpl", 'smarty_include_vars' => array()));
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
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/rodape.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
</div>	
</body>
</html>