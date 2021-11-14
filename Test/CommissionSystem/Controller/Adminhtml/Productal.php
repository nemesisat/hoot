<?php
namespace Test\CommissionSystem\Controller\Adminhtml;

abstract class Productal extends \Magento\Backend\App\Action  implements \Test\CommissionSystem\Api\Data\ProductalInterface
{
    /**
     * @var \Altayer\CustomCatal\Model\Productal
     */
    protected $productal;

    /**
     * Productal constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Test\CommissionSystem\Model\Productal $productal
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Test\CommissionSystem\Model\Productal $productal
    ) {
        $this->productal = $productal;
        parent::__construct($context);
    }

    /**
     * @param $resultPage
     * @return mixed
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Customer'), __('Commission'));
        return $resultPage;
    }
}
