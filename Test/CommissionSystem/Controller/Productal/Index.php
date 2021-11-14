<?php

namespace Test\CommissionSystem\Controller\Productal;
class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Test\CommissionSystem\Model\Productal
     */
    protected $productal;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Test\CommissionSystem\Model\Productal $productal
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->productal = $productal;
        parent::__construct($context);
    }


    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        if ($this->getRequest()->isAjax()) {
            return $result->setData($this->productal->getCollectionByProductalServer($this->getRequest()->getParam('productal')));
        }
    }
}