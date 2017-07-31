<?php

class GsBtobsDisplayAdminCustomersController
{
	public function __construct($module, $file, $path)
	{
		$this->file = $file;
		$this->module = $module;
		$this->context = Context::getContext();
		$this->_path = $path;
	}

	public function run()
	{
		// Get customer instance
		$id_customer = (int)Tools::getValue('id_customer');
		$customer = new Customer($id_customer);


		// Build actions url
		$ajax_action_url = $this->context->link->getAdminLink('AdminModules', true);
		$ajax_action_url = str_replace('index.php', 'ajax-tab.php', $ajax_action_url);
		$action_url = $this->context->link->getAdminLink( 'AdminGsBtobs', true);

		// Get compagny
		$compagny = GsBtob::getCustomerCompagny($customer->id_compagny);

		// Assign comments and product object
		$this->context->smarty->assign('compagnies', $compagny);
		$this->context->smarty->assign('action_url', $action_url);
		$this->context->smarty->assign('ajax_action_url', $ajax_action_url);
		$this->context->smarty->assign('pc_base_dir', __PS_BASE_URI__.'modules/'.$this->module->name.'/');

		return $this->module->display($this->file, 'displayAdminCustomers.tpl');
	}
}
