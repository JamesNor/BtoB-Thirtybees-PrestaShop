<?php
/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    Glass Systems <contact@glass-systems.fr>
 * @copyright 2017-2017 Glass-Systems
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

require_once(dirname(__FILE__).'/../../classes/GsBtob.php');

/**
 *
 */
class AdminGsBtobsController extends ModuleAdminController
{
    public function __construct()
    {
        $listEmploye = Employee::getEmployees();
        $optionsEmploye = array(
          array(
            'id_option' => '',
            'name' => 'Choisir le commercial'
          ),
        );
        foreach ($listEmploye as $key => $employe) {
          $optionsEmploye[] = array(
            'id_option' => $employe['firstname']." ".$employe['lastname'],
            'name' => $employe['firstname']." ".$employe['lastname']
          );
          $listEmployeView[$employe['firstname']." ".$employe['lastname']] = $employe['firstname']." ".$employe['lastname'];
        }

        // Définition des variables
        $this->table = "gsbtob";
        $this->className = "GsBtob";
        $this->allow_export = true;
        $this->fields_list =  array(
            'id_gsbtob' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
            'name' => array('title' => $this->l('Nom'), 'width' => 100),
            'status' => array('title' => $this->l('Client'), 'type' => 'bool', 'callback' => 'printNewsIcon', 'hint' => $this->l('Une entreprise qui n\'est pas client, est un prospe.')),
            'email' => array('title' => $this->l('E-mail'), 'width' => 100),
            'tel' => array('title' => $this->l('Tél'), 'width' => 80),
            'fax' => array('title' => $this->l('Fax'), 'width' => 80),
            'website' => array('title' => $this->l('Site web'), 'width' => 100),
            'ville' => array('title' => $this->l('Ville'), 'width' => 100),
            'postal_code' => array('title' => $this->l('Code Postal'), 'width' => 60),
            'siret' => array('title' => $this->l('SIRET'), 'width' => 100),
            'type' => array('title' => $this->l('Type'), 'width' => 100, 'type' => 'select', 'list' => $this->getOptionTypeName(), 'filter_key' => 'type'),
            'employe' => array('title' => $this->l('Contact Commercial'), 'width' => 120, 'type' => 'select', 'list' => $listEmployeView, 'filter_key' => 'employe'),
            'date_add' => array('title' => $this->l('Date add'), 'type' => 'date'),
        );

        // Set fields form for form view
        $this->context = Context::getContext();
        $this->context->controller = $this;
        $this->fields_form = array(
            'legend' => array('title' => $this->l('Entreprise'), 'icon' => 'icon-briefcase'),
            'input' => array(
              array('type' => 'text', 'label' => $this->l('Nom'), 'name' => 'name', 'required' => true, 'class' => 'gs-md', 'hint' => 'Caractères invalides :  0-9!<>,;?=+()@#"°{}_$%:'),
              array('type' => 'free', 'name' => 'a', 'desc' => $this->l('Les informations de contact de l\'entreprise'), 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Tél'), 'name' => 'tel', 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Fax'), 'name' => 'fax', 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('E-mail'), 'name' => 'email', 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Site web'), 'name' => 'website', 'class' => 'gs-md'),
              array('type' => 'switch', 'label' => $this->l('Client'), 'name' => 'status', 'class' => 'gs-md', 'is_bool' => true, 'desc' => $this->l('Légende : Client <--> Prospe'),
                                            'values' => array(
                                              array('id' => 'status_client', 'value' => 1,'label' => $this->l('Client')),
                                              array('id' => 'status_prospe', 'value' => 0, 'label' => $this->l('Prospe')),
                                            ),),
              //array('type' => 'textarea', 'label' => $this->l('Commentaire'), 'name' => 'commentaire', 'class' => 'gs-md'),
              array('type' => 'free', 'name' => 'a', 'desc' => $this->l('L\'adresse de l\'entreprise'), 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Adresse'), 'name' => 'address', 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Code Postal'), 'name' => 'postal_code', 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Ville'), 'name' => 'ville', 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Pays'), 'name' => 'pays', 'class' => 'gs-md'),

              array('type' => 'select', 'label' => $this->l('Commercial interne'), 'name' => 'employe', 'class' => 'gs-md', 'options' => array('query' => $optionsEmploye, 'id' => 'id_option', 'name' => 'name')),
            ),
            'submit' => array('title' => $this->l('Save'))
        );
        //Activation de Bootstrap
        $this->bootstrap = true;

        // Appel de la méthode parente du constructeur
        parent::__construct();

        // Update the SQL request of the HelperList
        $this->_select = "pl.`name` as product_name";
        $this->_join = 'LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (pl.`id_product` = a.`id_gsbtob` AND pl.`id_lang` = '. (int)$this->context->language->id.')';

        // Add actions
        $this->addRowAction('edit');
        $this->addRowAction('view');
        $this->addRowAction('delete');

        // Add bulk actions
        $this->bulk_actions = array(
          'delete' => array(
            'text' => $this->l('Delete selected'),
            'confirm' => $this->l('Would you like to delete the selected items?'),
          ),
        );
    }

    protected function processBulkMyAction()
    {
        Tools::dieObject($this->boxes);
    }

    public function renderView()
    {
        // Build delete link
        $admin_delete_link = $this->context->link->getAdminLink('AdminGsBtobs').'&deletegsbtob&id_gsbtob='.(int)$this->object->id;

        // Build edit link
        $admin_edit_link = $this->context->link->getAdminLink('AdminGsBtobs').'&updategsbtob&id_gsbtob='.(int)$this->object->id;

        // Add edit shortcut button to toolbar
        $this->page_header_toolbar_btn['edit'] = array(
          'href' => $admin_edit_link,
          'desc' => $this->l('L\'éditer'),
          'icon' => 'process-icon-edit',
        );

        // Add delete shortcut button to toolbar
        $this->page_header_toolbar_btn['delete'] = array(
            'href' => $admin_delete_link,
            'desc' => $this->l('Delete it'),
            'icon' => 'process-icon-delete',
            'js' => "return confirm('".$this->l('Are you sure you want to delete it ?')."');",
        );

        $companies = GsBtob::getCompagny();
        $accessories = Product::getAccessoriesLight(1, 1);

        if ($postAccessories = Tools::getValue('inputAccessories')) {
            $postAccessoriesTab = explode('-', $postAccessories);
            foreach ($postAccessoriesTab as $accessoryId) {
                if (!$this->haveThisAccessory($accessoryId, $accessories) && $accessory = Product::getAccessoryById($accessoryId)) {
                    $accessories[] = $accessory;
                }
            }
        }

        $action_url = $this->context->link->getAdminLink('AdminGsBtobs');
        $employe_url = $this->context->link->getAdminLink('AdminEmployees');
        $tpl = $this->context->smarty->createTemplate(dirname(__FILE__). '/../../views/templates/admin/view.tpl');

        // If author is known as a customer, build admin customer link
        $admin_customer_link = '';
        $customers = Customer::getCustomersByEmail($this->object->email);
        $customersById = GsBtob::getCustomerByIdCompany($this->object->id_gsbtob);
        if (isset($customers[0]['id_customer']) && isset($customersById[0]['id_customer'])) {
            $admin_customer_link = $this->context->link->getAdminLink('AdminCustomers').'&viewcustomer&id_customer='.(int)$customers[0]['id_customer'];
            $tpl->assign('customers', $customersById);
        }

        $tpl->assign('gsbtob', $this->object);
        //var_dump($customersById);
        $tpl->assign('companies', $companies);
        $tpl->assign('accessories', $accessories);
        $tpl->assign('toto', Configuration::get('GS_ENABLE'));
        $tpl->assign('action_url', $action_url);
        $tpl->assign('employe_url', $employe_url);
        $tpl->assign('admin_customer_link', $admin_customer_link);

        return $tpl->fetch();
    }

    public function initPageHeaderToolbar()
    {
      $this->page_header_toolbar_btn['new_entreprise'] = array(
          'href' => self::$currentIndex.'&addgsbtob&token='.$this->token,
          'desc' => $this->l('Ajouter une nouvelle Entreprise'),
          'icon' => 'process-icon-new'
      );

      parent::initPageHeaderToolbar();
    }

    public function initToolbar()
    {
        parent::initToolbar();

        if (!true) {
            unset($this->toolbar_btn['new']);
        } elseif (!$this->display && $this->can_import) {
            $this->toolbar_btn['import'] = array(
                'href' => $this->context->link->getAdminLink('AdminImport', true).'&import_type=customers',
                'desc' => $this->l('Import')
            );
        }
    }

    public function initToolbarTitle()
    {
        parent::initToolbarTitle();

        switch ($this->display) {
          case '':
          case 'list':
              array_pop($this->toolbar_title);
              $this->toolbar_title[] = $this->l('Gérer vos Entreprises');
              break;
          case 'view':
              /** @var Customer $customer */
              if (($customer = $this->loadObject(true)) && Validate::isLoadedObject($customer)) {
                array_pop($this->toolbar_title);
                $this->toolbar_title[] = sprintf($this->l('Information à propos de l\'Entreprise : %s'), $customer->name);
              }
              break;
          case 'add':
          case 'edit':
              array_pop($this->toolbar_title);
              /** @var Customer $customer */
              if (($customer = $this->loadObject(true)) && Validate::isLoadedObject($customer)) {
                  $this->toolbar_title[] = sprintf($this->l('Editer l\'Entreprise : %s'), $customer->name);
              } else {
                  $this->toolbar_title[] = $this->l('Créer une nouvelle Entreprise');
              }
              break;
      }
        array_pop($this->meta_title);
        if (count($this->toolbar_title) > 0) {
            $this->addMetaTitle($this->toolbar_title[count($this->toolbar_title) - 1]);
        }
    }

    public function beforeAdd($compagny)
    {
        $customers = Customer::getCustomersByEmail($this->object->email);
        $compagny = GsBtob::getCompagny();
        $current_id = $compagny[count($compagny)-1]['id_gsbtob']+1;
        if (isset($customers[0]['id_customer']) && !isset($customers[0]['id_compagny'])) {
          Db::getInstance()->update('customer',array('id_company' => (int)$current_id),"id_customer = ".(int)$customers[0]['id_customer']);

        }
    }

    /**
     * postProcess handle every checks before saving products information
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function postProcess()
    {
        if (!$this->redirect_after) {
            parent::postProcess();
        }

        if ($this->display == 'edit') {

          $this->fields_form['input'][] = array('type' => 'free', 'desc' => $this->l('Informations complémentaires de l\'entreprise'), 'class' => 'gs-md');
          $this->fields_form['input'][] = array('type' => 'text', 'label' => $this->l('SIRET'), 'name' => 'siret', 'class' => 'gs-md');
          $this->fields_form['input'][] = array('type' => 'text', 'label' => $this->l('TVA Type'), 'name' => 'tva_type', 'class' => 'gs-md', 'hint' => 'Caractères invalides : <>={}');
          $this->fields_form['input'][] = array('type' => 'text', 'label' => $this->l('TVA Number'), 'name' => 'tva_number', 'class' => 'gs-md', 'hint' => 'Caractères invalides : <>={}');
          $this->fields_form['input'][] = array('type' => 'select', 'label' => $this->l('Type'), 'name' => 'type', 'class' => 'gs-md', 'options' => array('query' => $this->getOptionType(), 'id' => 'id_option', 'name' => 'name'));
          $this->fields_form['input'][] = array('type' => 'text', 'label' => $this->l('Capital'), 'name' => 'capital', 'class' => 'gs-md', 'hint' => 'Caractères invalides : <>={}');
        }

        if ($this->display == 'edit' || $this->display == 'add') {
            $this->addJqueryUI(
                [
                    'ui.core',
                    'ui.widget',
                    'ui',
                ]
            );

            $this->addjQueryPlugin(
                [
                    'autocomplete',
                    'tablednd',
                    'thickbox',
                    'ajaxfileupload',
                    'date',
                    'tagify',
                    'select2',
                    'validate',
                ]
            );

            $this->addJS(
                [
                    _PS_JS_DIR_.'admin/products.js',
                    _PS_JS_DIR_.'admin/attributes.js',
                    _PS_JS_DIR_.'admin/price.js',
                    _PS_JS_DIR_.'tiny_mce/tiny_mce.js',
                    _PS_JS_DIR_.'admin/tinymce.inc.js',
                    _PS_JS_DIR_.'admin/dnd.js',
                    _PS_JS_DIR_.'jquery/ui/jquery.ui.progressbar.min.js',
                    _PS_JS_DIR_.'vendor/spin.js',
                    _PS_JS_DIR_.'vendor/ladda.js',
                    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
                    dirname(__FILE__). '/../../views/js/gsbtob.js',
                ]
            );

            $this->addJS(_PS_JS_DIR_.'jquery/plugins/select2/select2_locale_'.$this->context->language->iso_code.'.js');
            $this->addJS(_PS_JS_DIR_.'jquery/plugins/validate/localization/messages_'.$this->context->language->iso_code.'.js');

            $this->addCSS(
                [
                    _PS_JS_DIR_.'jquery/plugins/timepicker/jquery-ui-timepicker-addon.css',
                    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
                    dirname(__FILE__). '/../../views/css/gsbtobs.css',
                ]
            );
        }
    }

    /**
     * Print news icon
     *
     * @param mixed $value
     * @param array $customer
     *
     * @return string
     *
     * @since 0.1
     */
    public function printNewsIcon($value, $customer)
    {
        return '<a class="list-action-enable '.($value ? 'action-enabled' : 'action-disabled').'" href="">
				'.($value ? '<i class="icon-check"></i>' : '<i class="icon-remove"></i>').
            '</a>';
    }


    /**
     * return list option "Type" for fields_form
     *
     * @return array
     *
     * @since 0.1
     */
    public function getOptionType()
    {
      $optionsType = array(
        array(
          'id_option' => '',
          'name' => 'Choisir un type d\'entreprise'
        ),
        array(
          'id_option' => 'Entreprise individuelle',
          'name' => 'Entreprise individuelle'
        ),
        array(
          'id_option' => 'SARL',
          'name' => 'SARL'
        ),
        array(
          'id_option' => 'EURL',
          'name' => 'EURL'
        ),
        array(
          'id_option' => 'EIRL',
          'name' => 'EIRL'
        ),
        array(
          'id_option' => 'SELARL',
          'name' => 'SELARL'
        ),
        array(
          'id_option' => 'SA',
          'name' => 'SA'
        ),
        array(
          'id_option' => 'SAS',
          'name' => 'SAS'
        ),
        array(
          'id_option' => 'SASU',
          'name' => 'SASU'
        ),
        array(
          'id_option' => 'SNC',
          'name' => 'SNC'
        ),
        array(
          'id_option' => 'SCP',
          'name' => 'SCP'
        ),
      );

      return $optionsType;
    }

    /**
     * return list name of option "Type" for fields_list
     *
     * @return array
     *
     * @since 0.1
     */
    public function getOptionTypeName()
    {
      $optionsType = $this->getOptionType();
      array_shift($optionsType);
      foreach ($optionsType as $key => $value) {
        $optionsTypeName[$value['id_option']] = $value['name'];
      }
      return $optionsTypeName;
    }
}
