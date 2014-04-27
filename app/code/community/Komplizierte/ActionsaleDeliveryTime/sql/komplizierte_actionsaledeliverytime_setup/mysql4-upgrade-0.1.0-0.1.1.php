<?php
$installer = $this;
$installer->startSetup();

$installer->run("
    CREATE TABLE IF NOT EXISTS {$this->getTable('komplizierte_actionsaledeliverytime/deliverytime')} (
        `deliverytime_id` int(11) NOT NULL auto_increment,
		`order_id` int(11) NOT NULL ,
        `value` varchar(255) NOT NULL,
		PRIMARY KEY (`deliverytime_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
");

$installer->endSetup();