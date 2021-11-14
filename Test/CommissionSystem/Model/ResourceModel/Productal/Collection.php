<?php
namespace Altayer\CustomCatal\Model\ResourceModel\Productal;

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
            'Altayer\CustomCatal\Model\Productal',
            'Altayer\CustomCatal\Model\ResourceModel\Productal'
        );
    }
}
