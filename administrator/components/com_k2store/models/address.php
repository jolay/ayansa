<?php
/*
 * --------------------------------------------------------------------------------
   Weblogicx India  - K2 Store v 2.4
 * --------------------------------------------------------------------------------
 * @package		Joomla! 1.5x
 * @subpackage	K2 Store
 * @author    	Weblogicx India http://www.weblogicxindia.com
 * @copyright	Copyright (c) 2010 - 2015 Weblogicx India Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link		http://weblogicxindia.com
 * --------------------------------------------------------------------------------
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.model');


class K2StoreModelAddress extends JModel
{
	/*
	 * @var int
	 */
	var $_id = null;

	/**
	 * @var array
	 */
	var $_data = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid', array(0), '', 'array');
		$edit	= JRequest::getVar('edit',true);
		if($edit)
			$this->setId((int)$array[0]);
	}

	/**
	 *
	 * @access	public
	 */
	function setId($id)
	{
		// Set address id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 *
	 * @since 1.5
	 */
	function &getData()
	{
		// Load the address data
		if ($this->_loadData())
		{
			// Initialize some variables
			$user = &JFactory::getUser();

		}
		return $this->_data;
	}

	
	/**
	 * Method to store the address
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function store($data)
	{
		$row =& $this->getTable();

		// Bind the form fields to the address table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}			

		// Make sure the address table is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the address table to the database
		if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		return true;
	}

	/**
	 *
	 * @access	private
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	function _loadData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = 'SELECT a.*'.
					' FROM #__k2store_address AS a' .
					' WHERE a.id = '.(int) $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();
			return (boolean) $this->_data;
		}
		return true;
	}

}
