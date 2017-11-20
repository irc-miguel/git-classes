function atualizarCidades()
{
	if($("#estado").val())
	{
		$("#cidade").html("<option value=''>Atualizando...</option>");
		$.ajax({type: "POST",  url: "/usuario_controller/atualizarcidades", data: "id="+$("#estado").val(), global: false, dataType: "html", cache: "false",
			success: function(retorno)
			{
				$("#cidade").html(retorno);	
			},
			error: function(XMLHttpRequest, textStatus, errorThrown)
			{
				alert("ERRO: "+textStatus);
			}
		});
	}
	else
		$("#cidade").html("<option value=''> Selecione o estado </option>");

}