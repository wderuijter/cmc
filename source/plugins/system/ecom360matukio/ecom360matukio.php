<?php
/**
 * Compojoom System Plugin
 * @package Joomla!
 * @Copyright (C) 2012 - Yves Hoppe - compojoom.com
 * @All rights reserved
 * @Joomla! is Free Software
 * @Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
 * @version $Revision: 1.0.0 $
 **/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JLoader::discover('CmcHelper', JPATH_ADMINISTRATOR . '/components/com_cmc/helpers/');

class plgSystemECom360Matukio extends JPlugin {


    /**
     *
     * ('onAfterBooking', $neu, $event)
     */

    public function onAfterBooking($neu, $event){
		$app = JFactory::getApplication();

		// This plugin is only intended for the frontend
		if ($app->isAdmin()) {
			return true;
		}

        $this->notifyMC($neu,$event);
    }

    private function notifyMC($row, $event) {
        $session = JFactory::getSession();
        // Trigger plugin only if user comes from Mailchimp
        if(!$session->get( 'mc', '0' )) {
            return;
        }

		$shop_name = $this->params->get("store_name", "Your shop");
		$shop_id = $this->params->get("store_id", 42);

		// get the cat information
        $db = JFactory::getDbo();
        $sql = "SELECT * FROM #__categories WHERE id = " . $event->catid;

        $db->setQuery($sql);
        $cat = $db->loadObject();

        $products = array( 0 => array(
            "product_id" => $event->id, "sku" => $event->semnum, "product_name" => $event->title,
            "category_id" => $event->catid, "category_name" => $cat->title, "qty" => $row->nrbooked,
            "cost" =>  $event->fee
            )
        );

        CmcHelperEcom360::sendOrderInformations(
												$shop_id,
												$shop_name,
												$row->id,
												$row->payment_brutto,
												$row->payment_tax,
												0.00,  // No shipping
												$products
        );
    }
}