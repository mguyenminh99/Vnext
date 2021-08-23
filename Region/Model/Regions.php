<?php
namespace Vnext\Region\Model;
class Regions extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	protected function _construct()
	{
		$this->_init('Vnext\Region\Model\ResourceModel\Regions');
	}

	public function getIdentities()
	{
		return [$this->getRegionId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}