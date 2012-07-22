<?php
/**
 * Tiles
 * @package Joomla!
 * @Copyright (C) 2012 - Yves Hoppe - compojoom.com
 * @All rights reserved
 * @Joomla! is Free Software
 * @Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
 * @version $Revision: 0.9.0 beta $
 **/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class CmcViewLists extends JView {

    function display($tpl = null) {
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');

//        $appl = JFactory::getApplication();
//        $uri = JFactory::getURI();
//        $model = $this->getModel();
        //var_dump($model);

        //Filter
//        $context = 'com_cmc.lists.list.';
//        $filter_state2 = $appl->getUserStateFromRequest($context . 'filter_state', 'filter_state', '', 'word');
//        $filter_order2 = $appl->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'cc.list_name', 'cmd');
//        $filter_order_Dir2 = $appl->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '', 'word');
//        $search = $appl->getUserStateFromRequest($context . 'search', 'search', '', 'string');
//        $search = JString::strtolower($search);
//
//        $list = $model->getItems();
//        $pagination2 = $this->get('Pagination');
//        $total2 = $this->get('Total');
//
//        $javascript = 'onchange="document.adminForm.submit();"';
//
//        // state filter
//        $filter['state'] = JHTML::_('grid.state', $filter_state2, 'JPUBLISHED', 'JUNPUBLISHED');
//
//        // table ordering
//        $filter['order_Dir'] = $filter_order_Dir2;
//        $filter['order'] = $filter_order2;
//
//        $filter['search'] = $search;
//
//        $ordering = ($filter['order'] == 'cc.list_name'); //Ordering allowed ?
//
//        $this->assignRef('list', $list);
//        $this->assignRef('filter', $filter);
//        $this->assignRef('pagination', $pagination2);
//        $this->assignRef('total', $total2);
//        $this->assignRef('ordering', $ordering2); // WTF Daniel?!

        $this->addToolbar();
        parent::display($tpl);
    }

    public function addToolbar() {
        // Set toolbar items for the page
        JToolBarHelper::title(JText::_('COM_CMC_LISTS'), 'lists');
//        JToolBarHelper::publishList();
//        JToolBarHelper::unpublishList();
//        JToolBarHelper::deleteList(JText::_('COM_CMC_DO_YOU_REALLY_WANTO_TO_REMOVE_THIS_LIST'));
//        JToolBarHelper::editList();
//        JToolBarHelper::addNewX('editList');
    }
}