<?php
class Komplizierte_ActionsaleDeliveryTime_Block_Onepage_Deliverydate extends Mage_Checkout_Block_Onepage_Abstract
{
    public function __construct()
    {
        $this->setTemplate('komplizierte_deliverytime/checkout/onepage/shipping_method/available.phtml');
    }


    public function displayDeliveryDate()
    {


        return true;
    }

    public function getDeliveryDateArrayOptions()
    {
        $returnValue = array();
        $table=Mage::getStoreConfig('komplizierte_actionsaledeliverytime/main/method');

        $shippingCode = Mage::getSingleton('customer/session')->getShippingMethod();

        if  (strstr($shippingCode, $table)){
            $returnValue=array('morning'=>'morning',
                'afternoon'=>'afternoon');

            if(!Mage::getSingleton('customer/session')
                ->getDeliverydate()){
                Mage::getSingleton('customer/session')
                    ->setDeliverydate($returnValue['morning']);
            }
        }
        return $returnValue;
    }


    public function getSelectedDeliveryDate()
    {
        return  Mage::getSingleton('customer/session')->getDeliverydate();
    }
}