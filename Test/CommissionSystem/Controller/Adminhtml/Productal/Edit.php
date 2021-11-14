<?php
namespace Test\CommissionSystem\Controller\Adminhtml\Productal;

class Edit extends \Test\CommissionSystem\Controller\Adminhtml\Productal
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Test\CommissionSystem\Model\Productal
     */
    protected $productal;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Edit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Test\CommissionSystem\Model\Productal $productal
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Test\CommissionSystem\Model\Productal $productal
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->productal = $productal;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context,$productal);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->productal;
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Customer no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('custom_catal_productal_edit', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Attribute') : __('New'),
            $id ? __('Edit Attribute') : __('New')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Commission'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('Customer Commission'));
        return $resultPage;
    }


}
