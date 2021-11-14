<?php

namespace Test\CommissionSystem\Observer;

use Magento\Framework\Event\ObserverInterface;

class Productsaveafter implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $_product = $observer->getProduct();  // you will get product object
        $commision = $_product->getCommissionProduct();
        if($commision == '')
        {
            $categories = $_product->getCategoryIds();
            foreach($categories as $category){
                $cat = $objectManager->create('Magento\Catalog\Model\Category')->load($category);
                $commsionvalue = $cat->getCommissionCategory();
                if($commsionvalue != ''){
                    $_product->setCommissionProduct($commsionvalue);
                    $_product->save();
                    break;
                }
            }

        }

    }
}