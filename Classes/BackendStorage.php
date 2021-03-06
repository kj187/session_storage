<?php
namespace Aijko\SessionStorage;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 AIJKO GmbH <info@aijko.de
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @author Julian Kleinhans <julian.kleinhans@aijko.de>
 * @copyright Copyright belongs to the respective authors
 * @package Aijko\SessionStorage
 */
class BackendStorage extends \Aijko\SessionStorage\AbstractStorage {
 
	/**
	 * @param string $key
	 * @param string $type Interface compatibility
	 * @return mixed
	 */
	public function get($key, $type = '') {
		return $this->getBackendUser()->getSessionData($this->getKey($key));
	}

	/**
	 * @param string $key
	 * @param mixed $data
	 * @param string $type Interface compatibility
	 * @return void
	 */
	public function set($key, $data, $type = '') {
		$this->getBackendUser()->setAndSaveSessionData($this->getKey($key), $data);
	}

	/**
	 * @param string $key
	 * @param string $type Interface compatibility
	 */
	public function remove($key, $type = '') {
		if ($this->has($key)) {
			unset($sessionData[$this->getKey($key)]);
			$this->getBackendUser()->user['ses_data'] = (!empty($sessionData) ? serialize($sessionData) : '');
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->getBackendUser()->session_table, 'ses_id=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($this->getBackendUser()->user['ses_id'], $this->getBackendUser()->session_table), array('ses_data' => $this->getBackendUser()->user['ses_data']));
		}
	}

	/**
	 * @param string $key
	 * @param string $type Interface compatibility
	 * @return boolean
	 */
	public function has($key, $type = '') {
		$sessionData = unserialize($this->getBackendUser()->user['ses_data']);
		return isset($sessionData[$this->getKey($key)]) ? TRUE : FALSE;
	}

	/**
	 * @return t3lib_beUserAuth
	 */
	protected function getBackendUser() {
		return $GLOBALS['BE_USER'];
	}

	/**
	 * @return t3lib_beUserAuth
	 */
	public function getUser() {
		return $this->getBackendUser();
	}

	/**
	 * @return string
	 */
	public function getSessionId() {
		//return $this->getUser()->id;
	}

	/**
	 * @param string $id
	 */
	public function setSessionId($id) {
		//$this->getUser()->id = $id;
	}

	/**
	 * Writes a object to the session if the key is empty it used the classname
	 *
	 * @param object $object
	 * @param string $key
	 * @param string $type
	 * @return void
	 * @throws \InvalidArgumentException
	 */
	public function storeObject($object, $key = NULL, $type = 'ses') {
		parent::storeSerializedObject($object, $key, $type, $this);
	}

	/**
	 * Get object from storage
	 *
	 * @param string $key
	 * @param string $type
	 * @return object
	 */
	public function getObject($key, $type = 'ses') {
		return unserialize($this->get($key, $type));
	}

}