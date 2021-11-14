<?php

namespace Test\CommissionSystem\Model;


class Productal extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @param $productal
     * @return array
     */
    public function getCollectionByProductalServer($productal)
    {

        return $productal;
    }

    /**
     * @param $server
     * @return array|\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    protected function getProductalServerByServer($server)
    {
        if (isset($server[1])) {
            return $this->getCollection()
                ->addFieldToFilter(
                    'product_id_al',
                    array('like' => '%' . $server[1] . '%')
                );
        }
        return [];
    }

    protected function _construct()
    {
        $this->_init('Test\CommissionSystem\Model\ResourceModel\Productal');
    }
}
