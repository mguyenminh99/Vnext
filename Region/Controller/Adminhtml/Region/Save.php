<?php

namespace Vnext\Region\Controller\Adminhtml\Region;

use Magento\Backend\App\Action;
use Vnext\Region\Model\ResourceModel\Regions\CollectionFactory;
use Vnext\Region\Model\RegionsFactory;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Save extends Action
{
    private $resultRedirect;
    private $regionFactory;

    public function __construct(
        Action\Context $context,
        RegionsFactory $regionFactory,
        RedirectFactory $redirectFactory
    )
    {
        parent::__construct($context);
        $this->regionFactory = $regionFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['region_id']) ? $data['region_id'] : null;

        $newData = [
            'country_id' => $data['country_id'],
            'code' => $data['code'],
            'default_name' => $data['default_name']
        ];

        $student = $this->regionFactory->create();
        if ($id) {
            $student->load($id);
            $this->getMessageManager()->addSuccessMessage(__('Edit thành công'));
        } 
        try{
            if(empty($student->getCollection()->addFieldToFilter('default_name', ['eq' => $data['default_name']])->getData())){
                $student->addData($newData);
                $student->save();
                $this->getMessageManager()->addSuccessMessage(__('Tạo mới thành công'));
                return $this->resultRedirect->create()->setPath('region/region/index');
            }else{
                $this->getMessageManager()->addErrorMessage(__('Default Name đã tồn tại '));
                return $this->resultRedirect->create()->setPath('region/region/new');
                $student->getCollection()->getSelect()->reset(\Magento\Framework\DB\Select::WHERE);
                if(empty($student->getCollection()->addFieldToFilter('code' , ['eq' => $data['code']])->addFieldToFilter('country_id' , ['eq' => $data['country_id']])->getData())){
                    $this->getMessageManager()->addErrorMessage(__('Code đã tồn tại tại country '));
                    return $this->resultRedirect->create()->setPath('region/region/new');
                }
            }
        }catch (\Exception $e){
            $this->getMessageManager()->addErrorMessage(__('Save thất bại.'));
        }
    }
}