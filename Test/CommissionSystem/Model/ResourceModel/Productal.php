<?php
namespace Test\CommissionSystem\Model\ResourceModel;

use Test\CommissionSystem\Api\Data\ProductalInterface;

class Productal extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{


    protected function _construct()
    {
        $this->_initSerializableFields();
        $this->_init('test_commissionsystem', 'id');
    }

    /**
     * @return $this
     */
    protected function _initSerializableFields()
    {
        $this->_serializableFields = [
            ProductalInterface::PRODUCTAL_SERVER => null
        ];
        return $this;
    }
}
