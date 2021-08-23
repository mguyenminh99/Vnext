<?php
namespace Vnext\Region\Model;

class CountryCode extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    protected function _construct()
	{
		$this->_init('Vnext\Region\Model\ResourceModel\CountryCode');
	}

	public function getIdentities()
	{
		return [$this->getMspTfaCountryCodeId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}
