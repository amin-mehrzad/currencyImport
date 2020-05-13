<?php
/* TODO:
    - Add setValue function for currencies
*/
namespace SamuraiCode\CurrencyBasePrice\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
 {
    protected $_scopeConfig;
    protected $_reportCollectionFactory;

    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_ONE     = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_one';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_TWO	    = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_two';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_THREE   = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_three';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_FOUR    = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_four';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_FIVE    = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_five';

    public function __construct (
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct( $context );
        $this->_scopeConfig = $scopeConfig;
    }

    public function getCurrencyValue( $currency ) {
        switch  ( $currency ) {
            case 'USD':
                return $this->_scopeConfig->getValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_ONE );
                break;
            case 'EUR':
                return $this->_scopeConfig->getValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_TWO );
                break;
            case 'TRY':
                return  $this->_scopeConfig->getValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_THREE );
                break;
            case 'AED':
                return $this->_scopeConfig->getValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_FOUR );
                break;
            case 'custom':
                return $this->_scopeConfig->getValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_FIVE );
                break;
            default:
                return 1;
                break;
        }

    }

    public function setCurrencyValue( $currency, $value ) {
        switch  ( $currency ) {
            case 'USD':
                return $this->_scopeConfig->setValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_ONE, $value );
                break;
            case 'EUR':
                return $this->_scopeConfig->setValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_TWO, $value );
                break;
            case 'TRY':
                return  $this->_scopeConfig->setValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_THREE, $value );
                break;
            case 'AED':
                return $this->_scopeConfig->setValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_FOUR, $value );
                break;
            case 'custom':
                return $this->_scopeConfig->setValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_FIVE, $value );
                break;
            default:
                return 1;
                break;
        }

    }

}
