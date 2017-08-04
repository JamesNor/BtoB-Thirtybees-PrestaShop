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

 /**
  * @since 0.3
  */
 class AdminDashboardBtoBController extends ModuleAdminController
 {
     public function __construct()
     {
       // Appel de la méthode parente du constructeur
       parent::__construct();
       $this->bootstrap = true;
     }

     /**
      * Render kpis
      *
      * @return mixed
      *
      * @since 1.0.0
      */
     public function renderKpis()
     {
         $time = time();
         $kpis = [];

         /* The data generation is located in AdminStatsControllerCore */

         $helper = new HelperKpi();
         $helper->id = 'box-gender';
         $helper->icon = 'icon-male';
         $helper->color = 'color1';
         $helper->title = $this->l('Professionels', null, null, false);
         if (ConfigurationKPI::get('CUSTOMER_MAIN_GENDER', $this->context->language->id) !== false) {
             $helper->value = ConfigurationKPI::get('CUSTOMER_MAIN_GENDER', $this->context->language->id);
         }
         $helper->source = $this->context->link->getAdminLink('AdminStats').'&ajax=1&action=getKpi&kpi=customer_main_gender';
         $helper->refresh = (bool) (ConfigurationKPI::get('CUSTOMER_MAIN_GENDER_EXPIRE', $this->context->language->id) < $time);
         $kpis[] = $helper->generate();

         $helper = new HelperKpi();
         $helper->id = 'box-age';
         $helper->icon = 'icon-calendar';
         $helper->color = 'color2';
         $helper->title = $this->l('Particuliers', 'AdminTab', null, false);
         if (ConfigurationKPI::get('AVG_CUSTOMER_AGE', $this->context->language->id) !== false) {
             $helper->value = ConfigurationKPI::get('AVG_CUSTOMER_AGE', $this->context->language->id);
         }
         $helper->source = $this->context->link->getAdminLink('AdminStats').'&ajax=1&action=getKpi&kpi=avg_customer_age';
         $helper->refresh = (bool) (ConfigurationKPI::get('AVG_CUSTOMER_AGE_EXPIRE', $this->context->language->id) < $time);
         $kpis[] = $helper->generate();

         $helper = new HelperKpiRow();
         $helper->kpis = $kpis;
         $tpl = $this->context->smarty->createTemplate(dirname(__FILE__). '/../../views/templates/admin/dashboard.tpl');
         return $tpl->fetch();
         return $helper->generate();
     }
 }
