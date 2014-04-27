<?php
/**
* @author Amasty Team
* @copyright Copyright (c) Amasty (http://www.amasty.com)
* @package Amasty_Deliverydate
*/
class Komplizierte_ActionsaleDeliveryTime_Model_Observer
{

    public function onCoreBlockAbstractToHtmlAfter($observer)
    {
        $storeId = Mage::app()->getStore()->getId();
        //if (Mage::getStoreConfig('amdeliverydate/general/enabled', $storeId)) {
            $block = $observer->getBlock();
            $transport = $observer->getTransport();
            $html = $transport->getHtml();
            // Shipping Method step
            $blockClass = Mage::getConfig()->getBlockClassName('checkout/onepage_shipping_method_available');
            if ($blockClass == get_class($block)) {
                $insert = Mage::app()->getLayout()->createBlock('komplizierte_actionsaledeliverytime/onepage_deliverydate')->toHtml();
                $html .= $insert;
            }

            $transport->setHtml($html);
       // }
    }
    /**
     * Save notice & date
     * @param object $observer
     * @return
     */
    public function saveDeliveryData($observer) {

        $order = $observer->getEvent()->getOrder();

        if(!$deliverytime= Mage::getSingleton('customer/session')->getDeliverydate())
            $deliverytime = Mage::app()->getRequest()->getParam('komplizierte_delivery_date');

        if($deliverytime){
            $model=Mage::getModel('komplizierte_actionsaledeliverytime/deliverytime')
                ->load($order->getId(), 'order_id');
            $model->setOrderId($order->getId());
            $model->setValue($deliverytime);
            $model->save();
        }

    }
    /**
     * Puts module data in session
     * @param object $observer
     * @return
     */
    public function catchDeliveryData($observer) {

        if ($observer->getRequest()){
        $date = $observer->getRequest()->getPost('komplizierte_delivery_date');
        $method = $observer->getRequest()->getPost('shipping_method');
        if($date)
        Mage::getSingleton('customer/session')
            ->setDeliverydate($date);
        if($method)
        Mage::getSingleton('customer/session')
            ->setShippingMethod($method);
        }
    }

    /**
     * render block to admin
     * @param $observer
     */
    public function onBlockHtmlBefore($observer)
    {
        $block = $observer->getBlock();
        if (!isset($block)) return;


        switch ($block->getType()) {
            case 'amdeliverydate/onepage_shipping_method_available':
                $html = $observer->getTransport()->getHtml();
                $block = $observer->getBlock()
                    ->getLayout()
                    ->createBlock(
                        'komplizierte_actionsaledeliverytime/adminhtml_form_deliverytime',
                        'komplizierte_actionsaledeliverytime'
                    );
                $observer->getTransport()->setHtml($html.$block->toHtml());

                break;
        }
    }

}