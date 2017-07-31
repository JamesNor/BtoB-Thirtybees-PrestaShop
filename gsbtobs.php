<?php

if (!defined('_PS_VERSION_')) {
    exit;
}
require_once(dirname(__FILE__).'/classes/GsBtob.php');

class GsBtobs extends Module
{
    public function __construct()
    {
        $this->name = 'gsbtobs';
        $this->tab = 'administration';
        $this->version = '0.2';
        $this->author = 'Glass Systems';
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = 'B2B by Glass-Systems';
        $this->description = 'With this module, you can create a B2B shop on Prestashop !';
    }

    public function install()
    {
        if (!parent::install()) {
            return false;
        }

        // Execute module install SQL statements
        $sql_file = dirname(__FILE__).'/install/install.sql';
        if (!$this->loadSQLFile($sql_file)) {
            return false;
        }

        //Installation d'un nouvel onglet d'administration
        if (!$this->installTab('', 'AdminParentCompanies', 'B2B')
          || !$this->installTab('AdminParentCompanies', 'AdminGsBtobs', 'Entreprise')
          || !$this->installTab('AdminParentCompanies', 'AdminCustomersBtoB', 'Contact')
          || !$this->installTab('AdminParentCompanies', 'AdminParticuliers', 'Particulier')) {
            return false;
        }

        // Register hooks
        if (!$this->registerHook('displayAdminCustomers')
          || !$this->registerHook('displayBackOfficeHeader')) {
            return false;
        }

        // Preset configuration values
        Configuration::updateValue('GS_ENABLE', '1');
        Configuration::updateValue('GS_COMMENTS', '1');

        // All went well!
        return true;
    }

    public function uninstall()
    {
        // Call uninstall parent method
        if (!parent::uninstall()) {
            return false;
        }

        /*TODO réactive quand fini de dev
          // Execute module install SQL statements
          $sql_file = dirname(__FILE__).'/install/uninstall.sql';
          if (!$this->loadSQLFile($sql_file))
              return false;*/

        if (!$this->uninstallTab('AdminParentCompanies')
          || !$this->uninstallTab('AdminGsBtobs')
          || !$this->uninstallTab('AdminCustomersBtoB')) {
            return false;
        }

        // Delete configuration values
        Configuration::deleteByName('GS_ENABLE');
        Configuration::deleteByName('GS_COMMENTS');

        // All went well!
        return true;
    }

    // public function reset()
    // {
    //     if (!$this->uninstall()) {
    //         return false;
    //     }
    //     if (!$this->install()) {
    //         return false;
    //     }
    //     return true;
    // }

    public function loadSQLFile($sql_file)
    {
        // Get install SQL file content
        $sql_content = file_get_contents($sql_file);

        // Replace prefix and store SQL command in array
        $sql_content = str_replace('PREFIX_', _DB_PREFIX_, $sql_content);
        $sql_requests = preg_split("/;\s*[\r\n]+/", $sql_content);

        // Execute each SQL statement
        $result = true;
        foreach ($sql_requests as $request) {
            if (!empty($request)) {
                $result &= Db::getInstance()->execute(trim($request));
            }
        }

        // Return result
        return $result;
    }

    public function installTab($parent, $class_name, $name)
    {
        //Création d'un nouvel onglet d'administration
        $tab = new Tab();
        if("" == $parent){
          $tab->id_parent = 0;
        } else {
          $tab->id_parent = (int)Tab::getIdFromClassName($parent);
        }
        $tab->name = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = $name;
        }
        $tab->class_name = $class_name;
        $tab->module = $this->name;
        $tab->active = 1;
        return $tab->add();
    }

    public function uninstallTab($class_name)
    {
        //Récupération de l'identifiant de l'onglet d'administration
      $id_tab = (int)Tab::getIdFromClassName($class_name);

      //Chargement de l'onglet
      $tab = new Tab((int)$id_tab);

      //Suppression de l'onglet
      return $tab->delete();
    }

    public function onClickOption($type, $href = false)
    {
        $confirm_reset = $this->l('Reseting this module will delete all entreprises from your database, are you sure you want to reset it ?');
        $reset_callback = "return gsbtobs_reset('".addslashes($confirm_reset)."');";

        $matchType = array(
        'reset' => $reset_callback,
        'delete' => "return confirm('Confirm delete?')",
      );

        if (isset($matchType[$type])) {
            return $matchType[$type];
        }

        return '';
    }

    public function getHookController($hook_name)
    {
        // Include the controller file
        require_once(dirname(__FILE__).'/controllers/hook/'. $hook_name.'.php');

        // Build dynamically the controller name
        $controller_name = $this->name.$hook_name.'Controller';

        // Instantiate controller
        $controller = new $controller_name($this, __FILE__, $this->_path);

        // Return the controller
        return $controller;
    }

    public function hookDisplayAdminCustomers($params)
    {
        $controller = $this->getHookController('displayAdminCustomers');
        return $controller->run();
    }

    public function hookDisplayBackOfficeHeader($params)
    {
      $this->context->controller->addCss($this->_path.'views/css/tab.css');
    }

    public function getContent()
    {
        $ajax_hook = Tools::getValue('ajax_hook');
        if ($ajax_hook != '') {
            $ajax_method = 'hook'.ucfirst($ajax_hook);
            if (method_exists($this, $ajax_method)) {
                die($this->{$ajax_method}(array()));
            }
        }

        $controller = $this->getHookController('getContent');
        return $controller->run();
    }
}
