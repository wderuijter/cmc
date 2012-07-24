<?php
/**
 * @author Daniel Dimitrov - compojoom.com
 * @date: 23.07.12
 *
 * @copyright  Copyright (C) 2008 - 2012 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class CmcControllerSubscription extends JController {

    public function save() {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $db = & JFactory::getDBO();
        $query = $db->getQuery(true);

        $chimp = new cmcHelperChimp();

        $input = JFactory::getApplication()->input;
        $form = $input->get('jform', '', 'array');

        if(isset($form['groups'])) {
            foreach($form['groups'] as $key => $group) {
                $mergeVars[$key] = $group;
            }
        }

        if(isset($form['interests'])) {
            foreach($form['interests'] as $key => $interest) {
                $mergeVars['GROUPINGS'][] = array( 'id' => $key, 'groups' => $interest);
            }
        }

        $mergeVars['OPTINIP'] = $_SERVER['REMOTE_ADDR'];

        $listId = $form['listid'];
        $email = $mergeVars['EMAIL'];

        // check if the user is in the list already
        $userlists = $chimp->listsForEmail($email);
        if($userlists && in_array($listId,$userlists)) {
            $updated = true;
        } else {
            $updated = false;
        }

        $chimp->listSubscribe( $listId, $email, $mergeVars, 'html', true, true, true, false );


        if ( $chimp->errorCode ) {
            $response['html'] = $chimp->errorMessage;
            $response['error'] = true;
        } else {
            $query->insert('#__cmc_users')->columns('list_id,email')->values($db->quote($listId).','.$db->quote($email));
            $db->setQuery($query);
            $db->Query();
            $response['html'] = ($updated) ? 'updated' : 'saved';
            $response['error'] = false;
        }

        echo json_encode( $response );
    }
}

