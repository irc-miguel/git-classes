<div id="menu">
	<ul>
		<li {if $aba=='inicial'} class="current_page_item"{/if}><a href="/admin/admin_controller/inicial">Painel</a></li>		
		<li {if $aba=='pesquisa'} class="current_page_item"{/if}><a href="/admin/admin_pesquisa_controller/listar_pesquisas">Pesquisas</a></li>
		<li {if $aba=='relatorios'} class="current_page_item"{/if}><a href="/admin/admin_pesquisa_controller/relatorios">Relatórios</a></li>
	</ul>
</div>