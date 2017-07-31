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

/**
 * Class Particulier
 *
 * @since 0.2
 */
class Particulier extends ObjectModel
{
    /** @var int $id_gsbtob Entreprise ID */
    public $id_particulier;

    /** @var string $firstname firstname */
    public $firstname;

    /** @var string $lastname lastname */
    public $lastname;

    /** @var string $tel tel number*/
    public $tel;

    /** @var string $mobile mobile number */
    public $mobile;

    /** @var string $email email */
    public $email;

    /** @var string $website website */
    public $website;

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

    /** @var date $date_add Date add Particulier */
    public $date_add;


    /**
    * @see ObjectModel::$definition
    */
    public static $definition = array(
        'table' => 'particulier',
        'primary' => 'id_particulier',
        'multilang' => false,
        'fields' => array(
          'firstname' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'required' => true, 'size' => 255),
          'lastname' => array('type' => self::TYPE_STRING, 'validate' => 'isName', 'required' => true, 'size' => 255),
          'tel' => array('type' => self::TYPE_STRING, 'validate' => 'isPhoneNumber', 'size' => 32),
          'mobile' => array('type' => self::TYPE_STRING, 'validate' => 'isPhoneNumber', 'size' => 32),
          'email' => array('type' => self::TYPE_STRING, 'validate' => 'isEmail', 'size' => 255),
          'website' => array('type' => self::TYPE_STRING, 'validate' => 'isUrl', 'size' => 255),
          'address' => array('type' => self::TYPE_STRING, 'validate' => 'isAddress', 'size' => 255),
          'postal_code' => array('type' => self::TYPE_STRING, 'validate' => 'isPostCode', 'size' => 255),
          'ville' => array('type' => self::TYPE_STRING, 'validate' => 'isCityName', 'size' => 255),
          'pays' => array('type' => self::TYPE_STRING, 'validate' => 'isCountryName', 'size' => 255),
          'commentaire' => array('type' => self::TYPE_HTML, 'validate' => 'isString', 'size' => 65535),
          'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
        ),
    );

    public static function getParticulier()
    {
      return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
        SELECT `id_particulier`, `firstname`, `lastname`, `tel`, `mobile`, `email`, `website`, `address`, `postal_code`, `ville`, `pays`, `commentaire`, `date_add`
        FROM `'._DB_PREFIX_.'particulier`
        ORDER BY `id_particulier` ASC LIMIT 30'
      );
    }
}
