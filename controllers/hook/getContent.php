<?php

class GsbtobsGetContentController
{
	public function __construct($module, $file, $path)
	{
		$this->file = $file;
		$this->module = $module;
		$this->context = Context::getContext(); $this->_path = $path;
	}

	public function processConfiguration()
	{
		if (Tools::isSubmit('mymod_pc_form'))
		{
			$enable_module = Tools::getValue('enable_module');
			$enable_comments = Tools::getValue('enable_comments');
			Configuration::updateValue('GS_ENABLE', $enable_module);
			Configuration::updateValue('GS_COMMENTS', $enable_comments);
			$this->context->smarty->assign('confirmation', 'ok');
		}
	}

	public function renderForm()
	{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->module->l('My Module configuration'),
					'icon' => 'icon-briefcase'
				),
				'input' => array(
					array(
						'type' => 'switch',
						'label' => $this->module->l('Enable module:'),
						'name' => 'enable_module',
						'desc' => $this->module->l('Enable module'),
						'values' => array(
							array('id' => 'enable_module_1', 'value' => 1, 'label' => $this->module->l('Enabled')),
							array('id' => 'enable_module_0', 'value' => 0, 'label' => $this->module->l('Disabled'))
						),
					),
					array(
						'type' => 'switch',
						'label' => $this->module->l('Enable comments:'), 'name' => 'enable_comments',
						'desc' => $this->module->l('Enable comments on products.'),
						'values' => array(
							array('id' => 'enable_comments_1', 'value' => 1, 'label' => $this->module->l('Enabled')),
							array('id' => 'enable_comments_0', 'value' => 0, 'label' => $this->module->l('Disabled'))
						),

					),
				),
				'submit' => array('title' => $this->module->l('Save'))
			)
		);

		$helper = new HelperForm();
		$helper->table = 'gsbtob';
		$helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
		$helper->allow_employee_form_lang = (int)Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG');
		$helper->submit_action = 'mymod_pc_form';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->module->name.'&tab_module='.$this->module->tab.'&module_name='.$this->module->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => array(
				'enable_module' => Tools::getValue('enable_module', Configuration::get('GS_ENABLE')),
				'enable_comments' => Tools::getValue('enable_comments', Configuration::get('GS_COMMENTS')),
			),
			'languages' => $this->context->controller->getLanguages()
		);

		return $helper->generateForm(array($fields_form));
	}

	public function run()
	{
		$this->processConfiguration();
		$html_confirmation_message = $this->module->display($this->file, 'getContent.tpl');
		$html_form = $this->renderForm();
		return $html_confirmation_message.$html_form;
	}
}
