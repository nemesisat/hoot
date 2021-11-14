<?php
namespace Test\CommissionSystem\Model\ResourceModel\Productal;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Test\CommissionSystem\Model\Productal',
            'Test\CommissionSystem\Model\ResourceModel\Productal'
        );
    }
}
