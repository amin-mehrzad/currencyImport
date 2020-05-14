<?php

namespace SamuraiCode\CurrencyBasePrice\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;
use \Magento\Framework\App\Config\Storage\WriterInterface;
use \Magento\Framework\App\Config\ValueFactory;
use \Magento\Framework\App\Cache\TypeListInterface;


class Data extends AbstractHelper
 {
    protected $_scopeConfig;
    protected $_reportCollectionFactory;
    protected $configWriter;
    protected $configValueFactory;
    protected $cacheTypeList;

    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_ONE     = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_one';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_TWO	    = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_two';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_THREE   = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_three';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_FOUR    = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_four';
    const XML_PATH_CURRENCY_BASE_PRICE_TYPE_FIVE    = 'currencyBasePrice_tab/currencyBasePrice_currency_setting/currencyBasePrice_currency_type_five';

    public function __construct (
        Context $context,
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter,
        ValueFactory $configValueFactory,
        TypeListInterface $cacheTypeList

    ) {
        parent::__construct( $context );
        $this->_scopeConfig = $scopeConfig;
        $this->_configWriter = $configWriter; 
        $this->_configValueFactory = $configValueFactory; 
        $this->cacheTypeList  = $cacheTypeList; 
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
                // return $this->_scopeConfig->setValue( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_ONE, $value );
                $this->_configWriter->save(self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_ONE, $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);  
                $this->cacheTypeList ->cleanType(\Magento\Framework\App\Cache\Type\Config::TYPE_IDENTIFIER); $this->cacheTypeList ->cleanType(\Magento\PageCache\Model\Cache\Type::TYPE_IDENTIFIER);
                break;
            case 'EUR':
               $this->_configValueFactory->create()->load( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_TWO , 'path' )->setValue( $value )->setPath( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_TWO )->save();   
               break;
            case 'TRY':
                $this->_configValueFactory->create()->load( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_THREE , 'path' )->setValue( $value )->setPath( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_THREE )->save(); 
                break;
            case 'AED':
                $this->_configValueFactory->create()->load( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_FOUR , 'path' )->setValue( $value )->setPath( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_FOUR )->save(); 
                break;
            case 'custom':
                $this->_configValueFactory->create()->load( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_FIVE , 'path' )->setValue( $value )->setPath( self::XML_PATH_CURRENCY_BASE_PRICE_TYPE_FIVE )->save();       
                break;
            default:
                return 1;
                break;
        }

    }

}
