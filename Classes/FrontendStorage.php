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
class FrontendStorage extends \Aijko\SessionStorage\AbstractStorage {
 
	/**
	 * @param string $key
	 * @param string $type
	 * @return string
	 */
	public function get($key, $type = 'ses') {
		$sessionData = $this->getFeUser()->getKey($type, $this->getKey($key));
		if ($sessionData == '') {
			return '';
		}
		return $sessionData;
	}

	/**
	 * @param string $key
	 * @param string $type
	 * @return boolean
	 */
	public function has($key, $type = 'ses') {
		$sessionData = $this->getFeUser()->getKey($type, $this->getKey($key));
		if ($sessionData == '') {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * @param string $key
	 * @param mixed $data
	 * @param string $type
	 * @return void
	 */
	public function set($key, $data, $type = 'ses') {
		$this->getFeUser()->setKey($type, $this->getKey($key), $data);
		$this->getFeUser()->storeSessionData();
	}

	/**
	 * @param string $key
	 * @param string $type
	 * @return void
	 */
	public function remove($key, $type = 'ses') {
		if ($this->has($key, $type)) {
			$this->write($key, NULL, $type);
		}
	}

	/**
	 * @return string
	 */
	public function getSessionId() {
		return $this->getFeUser()->id;
	}

	/**
	 * @param string $id
	 */
	public function setSessionId($id) {
		$this->getFeUser()->id = $id;
		$this->getFeUser()->fetchSessionData();
	}

	/**
	 * @param string $type
	 */
	protected function setUserDataChanged($type = 'ses') {
		switch ($type) {
			case 'ses':
				$this->getFeUser()->sesData_change = 1;
				break;
			case 'user':
				$this->getFeUser()->userData_change = 1;
				break;
			default:
				$this->getFeUser()->sesData_change = 1;
				break;
		}
	}

	/**
	 * @return \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication
	 */
	protected function getFeUser() {
		return $GLOBALS['TSFE']->fe_user;
	}

	/**
	 * @return \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication
	 */
	public function getUser() {
		return $this->getFeUser();
	}
 
}

?>