<?php
namespace Vnext\Region\Model\ResourceModel;

class CountryCode extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('msp_tfa_country_codes', 'msp_tfa_country_codes_id');
    }
}
