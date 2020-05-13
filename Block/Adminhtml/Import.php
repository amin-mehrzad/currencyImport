<?php

namespace SamuraiCode\CurrencyBasePrice\Block\Adminhtml;

use \Magento\Backend\Block\Template;
use \Magento\Backend\Block\Template\Context;
use SamuraiCode\CurrencyBasePrice\Helper\Data;

class Import extends Template
{
	protected $helper;

	public function __construct(
		Context $context,
		Data $helper,
		array $data = []
	)
	{	
		parent::__construct($context,$data);
		$this->helper = $helper;
	}
    public function getRate($currency){
		return $this->helper->getCurrencyValue($currency);
    }

}