<?php
class Komplizierte_ActionsaleDeliveryTime_IndexController extends Mage_Core_Controller_Front_Action
{
    public function AjaxAction()
    {
        $value = $this->getRequest()->getPost('shipping_method');
        $content ='';
        $table=Mage::getStoreConfig('komplizierte_actionsaledeliverytime/main/method');
        if (!strstr($value, $table))
        {
            if (!Mage::getSingleton('customer/session')->getDeliverydate()) {
                $returnValue = array('morning' => 'morning',
                    'afternoon' => 'afternoon');
                Mage::getSingleton('customer/session')->setDeliverydate($returnValue['morning']);
            }
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array('dropdownhtml' => $content)));
    }
}