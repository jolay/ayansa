<?php
/**
 * @version		$Id: k2extrafieldsgroup.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableK2ExtraFieldsGroup extends JTable
{

	var $id = null;
	var $name = null;

	function __construct( & $db) {
		parent::__construct('#__k2_extra_fields_groups', 'id', $db);
	}
	
	function check() {
		if (trim($this->name) == '') {
			$this->setError(JText::_('K2_GROUP_MUST_HAVE_A_NAME'));
			return false;
		}
		return true;
	}

}
