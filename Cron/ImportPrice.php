<?php

namespace SamuraiCode\CurrencyBasePrice\Cron;

//use Psr\Log\LoggerInterface;
use \Zend\Log\Logger;
use \Zend\Log\Writer\Stream;
use \Magento\Catalog\Api\ProductRepositoryInterface;
use SamuraiCode\CurrencyBasePrice\Helper\Data;

class ImportPrice
 {
    // protected $logger;
	protected $helper;

    public function __construct(
        //LoggerInterface $logger
        ProductRepositoryInterface $productRepository,
		Data $helper

    )
 {
        //$this->logger = $logger;
        $this->productRepository = $productRepository;
		$this->helper = $helper;

    }

    public function execute()
 {
        $writer = new Stream( BP . '/var/log/importPrice.log' );
        $logger = new Logger();
        $logger->addWriter( $writer );
        $logger->info( '-------------New Import is runing--------------' );
        //$this->logger->info( 'Cron Works' );

        $url = 'http://13.57.51.121/stylist/sampleData.json';

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' ) );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
        $result = curl_exec( $ch );

        // Check HTTP status code
        if ( !curl_errno( $ch ) ) {
            switch ( $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE ) ) {
                case 200: # OK
                break;
                default:
                error_log( 'Unexpected HTTP code: ' . $http_code );
            }
        }

        // $logger->info( $result );
        curl_close( $ch );

        $products = json_decode( $result, true );
        foreach ( $products as $product ) {
            $productName = $product['title'];
            $productSku = $product['sku'];
            $importedPrice = $product['price'];
            $currency = $product['currency'];
            $currencyValue = $this->helper->getCurrencyValue($currency);

            $logger->info( 'Product Name :'. $productName );
            $logger->info( 'Product SKU :'. $productSku );
            $logger->info( 'Price :'. $importedPrice );
            $logger->info( 'Currency :'. $currency );
            $logger->info( 'Currency value :'. $currencyValue );

            $productItem = $this->productRepository->get($productSku);
            $oldPrice=$productItem->getPrice();
            $newPrice = $currencyValue * $importedPrice;
            $logger->info( 'newPrice :'.$newPrice );

            $productItem->setPrice($newPrice);

            $productItem->save();
            
        

        }



    }
}
