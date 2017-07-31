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
 * @copyright 2017-2017 Glass Systems
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
 // use PrestaShop\PrestaShop\Adapter\ServiceLocator;
 // use PrestaShop\PrestaShop\Adapter\CoreException;

/***
 * Class GsBtob
 */
class GsBtob extends ObjectModel
{
    /** @var int $id_gsbtob Entreprise ID */
    public $id_gsbtob;

    /** @var string $name Entreprise name */
    public $name;

    /** @var string $siret Entreprise siret */
    public $siret;

    /** @var string $tva_number Entreprise tva number */
    public $tva_number;

    /** @var string $tva_type Entreprise type tva */
    public $tva_type;

    /** @var string $type Entreprise type */
    public $type;

    /** @var string $capital Entreprise capital */
    public $capital;

    /** @var string $fax fax number*/
    public $fax;

    /** @var string $tel tel number */
    public $tel;

    /** @var string $email email */
    public $email;

    /** @var string $website website */
    public $website;

    /** @var string $status status prospe/client */
    public $status;

    /** @var string $activite secteur d'activité */
    public $activite;

    /** @var string $employe employé interne */
    public $employe;

    /** @var string $commentaire commentaire */
    public $commentaire;

    /** @var string $address Adresse */
    public $address;

    /** @var string $postal_code Code Postal */
    public $postal_code;

    /** @var string $ville Ville */
    public $ville;

    /** @var string $pays Pays */
    public $pays;

    /** @var date $date_add Date add Entreprise */
    public $date_add;


    /**
    * @see ObjectModel::$definition
    */
    public static $definition = array(
        'table' => 'gsbtob',
        'primary' => 'id_gsbtob',
        'multilang' => false,
        'fields' => array(
          'name' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 255),
          'siret' => array('type' => self::TYPE_STRING, 'validate' => 'isSiret', 'size' => 255),
          'tva_number' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
          'tva_type' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
          'type' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
          'capital' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
          'fax' => array('type' => self::TYPE_STRING, 'validate' => 'isPhoneNumber', 'size' => 32),
          'tel' => array('type' => self::TYPE_STRING, 'validate' => 'isPhoneNumber', 'size' => 32),
          'email' => array('type' => self::TYPE_STRING, 'validate' => 'isEmail', 'size' => 255),
          'website' => array('type' => self::TYPE_STRING, 'validate' => 'isUrl', 'size' => 255),
          'status' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'size' => 255),
          'activite' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
          'employe' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
          'address' => array('type' => self::TYPE_STRING, 'validate' => 'isAddress', 'size' => 255),
          'postal_code' => array('type' => self::TYPE_STRING, 'validate' => 'isPostCode', 'size' => 255),
          'ville' => array('type' => self::TYPE_STRING, 'validate' => 'isCityName', 'size' => 255),
          'pays' => array('type' => self::TYPE_STRING, 'validate' => 'isCountryName', 'size' => 255),
          'commentaire' => array('type' => self::TYPE_HTML, 'validate' => 'isString', 'size' => 65535),
          'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
        ),
    );

    public static function getCompagny()
    {
      return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
        SELECT `id_gsbtob`, `name`, `siret`, `tva_number`, `tva_type`, `type`, `capital`, `fax`, `tel`, `email`, `website`, `status`, `activite`, `employe`, `commentaire`, `date_add`
        FROM `'._DB_PREFIX_.'gsbtob`
        ORDER BY `id_gsbtob` ASC LIMIT 30'
      );
    }

    public static function getCustomerCompagny($id)
  	{
  		$limit = 30;

  		$comments = Db::getInstance()->executeS('
  		SELECT gb.*
  		FROM `'._DB_PREFIX_.'gsbtob` gb
  		WHERE gb.`id_gsbtob` = \''.pSQL($id).'\'
  		ORDER BY gb.`date_add` DESC
  		LIMIT '.$limit);

  		return $comments;
  	}

    /**
     * return list of customer in a company
     *
     * @param int $idCompany
     *
     * @return array of customers
     *
     * @since 0.1
     */
    public function getCustomerByIdCompany($idCompany)
    {
      $limit = 100;

  		$comments = Db::getInstance()->executeS('
  		SELECT ct.*
  		FROM `'._DB_PREFIX_.'customer` ct
  		WHERE ct.`id_company` = \''.pSQL($idCompany).'\'
  		ORDER BY ct.`date_add` ASC
  		LIMIT '.$limit);

  		return $comments;
    }
}
