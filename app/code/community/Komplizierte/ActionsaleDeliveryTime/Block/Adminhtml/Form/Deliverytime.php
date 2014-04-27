<?php

class Komplizierte_ActionsaleDeliveryTime_Block_Adminhtml_Form_Deliverytime extends Mage_Adminhtml_Block_Sales_Order_Abstract
{
    public function __construct()
    {
        $this->setTemplate('komplizierte_deliverytime/sales/order/view/deliverydate.phtml');
    }

    public function displayDeliveryDate()
    {
        $returnValue = false;


        return true;
    }

    public function getSelectedDate(){
        $returnValue = array();
        $order_id=$this->getOrder()->getId();
        $model=Mage::getModel('komplizierte_actionsaledeliverytime/deliverytime')
                    ->load($order_id, 'order_id');
        return $model->getValue();
    }
    public function getDeliveryDateArrayOptions()
    {
        $returnValue = array();

//        $model=Mage::getModel('komplizierte_actionsaledeliverytime/deliverytime')
//            ->load($order->getId(), 'order_id');
//        if ($model)
//        $returnValue=array('morning'=>'morning',
//            'afternoon'=>'afternoon');

        return $returnValue;
    }
}
