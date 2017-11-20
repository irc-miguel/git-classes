<?php /* Smarty version 2.6.24, created on 2013-11-10 23:12:35
         compiled from admin/includes/menu_admin.tpl */ ?>
<div id="menu">
	<ul>
		<li <?php if ($this->_tpl_vars['aba'] == 'inicial'): ?> class="current_page_item"<?php endif; ?>><a href="/admin/admin_controller/inicial">Painel</a></li>		
		<li <?php if ($this->_tpl_vars['aba'] == 'pesquisa'): ?> class="current_page_item"<?php endif; ?>><a href="/admin/admin_pesquisa_controller/listar_pesquisas">Pesquisas</a></li>
		<li <?php if ($this->_tpl_vars['aba'] == 'relatorios'): ?> class="current_page_item"<?php endif; ?>><a href="/admin/admin_pesquisa_controller/relatorios">Relatórios</a></li>
	</ul>
</div>