<?php
namespace Test\CommissionSystem\Observer;

use Magento\Framework\App\State as AppState;


class SetOrderCustomerCommission implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Magento\Framework\App\State
     */
    private $appState;


    public function __construct(
        AppState $appState,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
    )
    {
        $this->appState = $appState;
        $this->productRepository = $productRepository;
        $this->customer_repository = $customerRepository;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getOrder();
        $sumValue = 0;
        $orderProduct = $order->getAllItems();
        foreach ($orderProduct  as $_products){
            $valueCommission = $this->productRepository->getById($_products)->getCommissionProduct();
            if($valueCommission != '')
            {
                $sumValue = $sumValue + $valueCommission;
            }
        }

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if($customerSession->isLoggedIn()) {
            $customerData = $this->customer_repository->getById($customerSession->getCustomerId());
            $commisionvalue = $customerData->getCustomAttributes('commisionvalue');
            if($commisionvalue != ''){

                $customerData->setCustomAttribute('commisionvalue', ($commisionvalue + $sumValue));
            }
        }

        if(!$order->getCommisionAmount()){
            $areaCode = $this->appState->getAreaCode();
            $order->setCommisionAmount($sumValue);
        }
        return $this;
    }

}