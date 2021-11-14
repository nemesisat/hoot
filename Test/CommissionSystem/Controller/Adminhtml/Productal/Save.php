<?php
namespace Test\CommissionSystem\Controller\Adminhtml\Productal;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Test\CommissionSystem\Model\Productal
     */
    protected $productal;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Test\CommissionSystem\Model\Productal $productal
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Test\CommissionSystem\Model\Productal $productal
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->jsonFactory = $jsonFactory;
        $this->productal = $productal;
        parent::__construct($context);
    }

    /**
     * @return $this|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws LocalizedException
     * @throws \Exception
     */
    public function execute()
    {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');


            $model = $this->productal->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Customer Commission no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            if(!$id){
                unset($data['id']);
            }
            unset($data['form_key']);

            $model->setData($data);

            try {

                $model->save();


                $this->messageManager->addSuccessMessage(__('You saved the Customer.'));
                $this->dataPersistor->clear('custom_catal_productal_index');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Customer Commission.'));
            }

            $this->dataPersistor->set('custom_catal_productal_index', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}
