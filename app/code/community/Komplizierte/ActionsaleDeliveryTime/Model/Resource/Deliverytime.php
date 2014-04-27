<?php
/**
 * Created by PhpStorm.
 * User: belov_ab
 * Date: 20.04.14
 * Time: 13:01
 */ 
class Komplizierte_ActionsaleDeliveryTime_Model_Resource_Deliverytime extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('komplizierte_actionsaledeliverytime/deliverytime', 'deliverytime_id');
    }

}