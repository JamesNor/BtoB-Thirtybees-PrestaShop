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

require_once(dirname(__FILE__).'/../../classes/Particulier.php');

/**
 * @since 0.2
 */
class AdminParticuliersController extends ModuleAdminController
{
    public function __construct()
    {
        // Définition des variables
        $this->table = "particulier";
        $this->className = "Particulier";
        $this->allow_export = true;
        $this->fields_list =  array(
            'id_particulier' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
            'firstname' => array('title' => $this->l('Nom'), 'width' => 100),
            'lastname' => array('title' => $this->l('Prénom'), 'width' => 100),
            'tel' => array('title' => $this->l('Tél'), 'width' => 100),
            'mobile' => array('title' => $this->l('Mobile'), 'width' => 80),
            'email' => array('title' => $this->l('E-mail'), 'width' => 80),
            'website' => array('title' => $this->l('Site web'), 'width' => 100),
            'address' => array('title' => $this->l('Adresse'), 'width' => 100),
            'postal_code' => array('title' => $this->l('Code Postal'), 'width' => 60),
            'ville' => array('title' => $this->l('Ville'), 'width' => 100),
            'pays' => array('title' => $this->l('Pays'), 'width' => 100),
            'commentaire' => array('title' => $this->l('Commentaire'), 'width' => 120, 'type' => 'text'),
            'date_add' => array('title' => $this->l('Date add'), 'type' => 'datetime'),
        );

        // Set fields form for form view
        $this->context = Context::getContext();
        $this->context->controller = $this;
        $this->fields_form = array(
            'legend' => array('title' => $this->l('Particulier'), 'icon' => 'icon-user'),
            'input' => array(
              array('type' => 'text', 'label' => $this->l('Prénom'), 'name' => 'firstname', 'class' => 'gs-md', 'hint' => 'Caractères invalides:<br>0-9!<>,;?=+()@#"°{}_$%:'),
              array('type' => 'text', 'label' => $this->l('Nom'), 'name' => 'lastname', 'required' => true, 'class' => 'gs-md', 'hint' => 'Caractères invalides:<br>0-9!<>,;?=+()@#"°{}_$%:'),
              array('type' => 'free', 'name' => 'a', 'desc' => $this->l('Les informations de contact du particulier'), 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Tél'), 'name' => 'tel', 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Mobile'), 'name' => 'mobile', 'required' => true, 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('E-mail'), 'name' => 'email', 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Site web'), 'name' => 'website', 'class' => 'gs-md'),
              array('type' => 'free', 'name' => 'a', 'desc' => $this->l('L\'adresse du particulier'), 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Adresse'), 'name' => 'address', 'class' => 'gs-md', 'hint' => 'Caractères invalides:<br>!<>?=+@{}_$%'),
              array('type' => 'text', 'label' => $this->l('Code Postal'), 'name' => 'postal_code', 'required' => true, 'class' => 'gs-md'),
              array('type' => 'text', 'label' => $this->l('Ville'), 'name' => 'ville', 'class' => 'gs-md', 'hint' => 'Caractères invalides:<br>!<>;?=+@#"°{}_$%'),
              array('type' => 'text', 'label' => $this->l('Pays'), 'name' => 'pays', 'class' => 'gs-md', 'hint' => 'Caractères valides:<br>a-zA-Z -'),
              array('type' => 'free', 'name' => 'a', 'desc' => $this->l('Informations complémentaires'), 'class' => 'gs-md'),
              array('type' => 'textarea', 'label' => $this->l('Commentaire'), 'name' => 'commentaire', 'class' => 'gs-md'),
            ),
            'submit' => array('title' => $this->l('Save'))
        );
        //Activation de Bootstrap
        $this->bootstrap = true;

        // Appel de la méthode parente du constructeur
        parent::__construct();

        // Update the SQL request of the HelperList
        $this->_select = "pl.`name` as product_name";
        $this->_join = 'LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (pl.`id_product` = a.`id_particulier` AND pl.`id_lang` = '. (int)$this->context->language->id.')';

        // Add actions
        $this->addRowAction('edit');
        $this->addRowAction('view');

    }

    public function renderView()
    {
      // Build edit link
      $admin_edit_link = $this->context->link->getAdminLink('AdminGsBtobs').'&updategsbtob&id_gsbtob='.(int)$this->object->id;

      // Add edit shortcut button to toolbar
      $this->page_header_toolbar_btn['edit'] = array(
        'href' => $admin_edit_link,
        'desc' => $this->l('L\'éditer'),
        'icon' => 'process-icon-edit',
      );

      $tpl = $this->context->smarty->createTemplate(dirname(__FILE__). '/../../views/templates/admin/viewParticulier.tpl');
      $tpl->assign('particulier', $this->object);

      return $tpl->fetch();
    }

    public function initPageHeaderToolbar()
    {
      $this->page_header_toolbar_btn['new_particulier'] = array(
          'href' => self::$currentIndex.'&addparticulier&token='.$this->token,
          'desc' => $this->l('Ajouter un nouveau contact Particulier'),
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
              $this->toolbar_title[] = $this->l('Gérer vos contacts Particuliers');
              break;
          case 'view':
              /** @var Customer $customer */
              if (($customer = $this->loadObject(true)) && Validate::isLoadedObject($customer)) {
                array_pop($this->toolbar_title);
                $this->toolbar_title[] = sprintf($this->l('Information à propos du contact particulier : %s'), $customer->name);
              }
              break;
          case 'add':
          case 'edit':
              array_pop($this->toolbar_title);
              /** @var Customer $customer */
              if (($customer = $this->loadObject(true)) && Validate::isLoadedObject($customer)) {
                  $this->toolbar_title[] = sprintf($this->l('Editer le contact particulier : %s'), $customer->name);
              } else {
                  $this->toolbar_title[] = $this->l('Créer un nouveau contact Particulier');
              }
              break;
      }
        array_pop($this->meta_title);
        if (count($this->toolbar_title) > 0) {
            $this->addMetaTitle($this->toolbar_title[count($this->toolbar_title) - 1]);
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

      if ($this->display == 'edit' || $this->display == 'add') {
        $this->addCSS(
          [
              dirname(__FILE__). '/../../views/css/gsbtobs.css',
          ]
        );
      }
    }
  }
