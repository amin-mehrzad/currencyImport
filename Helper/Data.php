<?php

namespace SamuraiCode\CurrencyBasePrice\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
//use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;
//use Magento\Reports\Model\ResourceModel\Product\Sold\CollectionFactory;

class Data extends AbstractHelper
 {
    protected $_scopeConfig;
    //protected $_reportCollectionFactory;

    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_ONE     = 'currencyBasePrice_tab/currencyBasePrice_setting/currencyBasePrice_currency_type_one';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_TWO	    = 'currencyBasePrice_tab/currencyBasePrice_setting/currencyBasePrice_currency_type_two';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_THREE   = 'currencyBasePrice_tab/currencyBasePrice_setting/currencyBasePrice_currency_type_three';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_FOUR    = 'currencyBasePrice_tab/currencyBasePrice_setting/currencyBasePrice_currency_type_four';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_FIVE    = 'currencyBasePrice_tab/currencyBasePrice_setting/currencyBasePrice_currency_type_five';

    public function __construct (
        Context $context,
        //CollectionFactory  $reportCollectionFactory,
        ScopeConfigInterface $scopeConfig
    ) {
       // $this->_reportCollectionFactory = $reportCollectionFactory;
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
                return 5;
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

}