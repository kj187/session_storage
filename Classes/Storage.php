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
class Storage implements \Aijko\SessionStorage\StorageInterface {
 
	/**
	 * @var \Aijko\SessionStorage\FrontendStorage | \Aijko\SessionStorage\BackendStorage
	 */
	protected $concreteSessionManager = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Service\EnvironmentService
	 */
	protected $environmentService = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 */
	protected $objectManager = NULL;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$this->environmentService = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Service\\EnvironmentService');
		$this->initializeConcreteSessionManager();
	}

	/**
	 * @return void
	 */
	protected function initializeConcreteSessionManager() {
		if ($this->environmentService->isEnvironmentInFrontendMode()) {
			$this->concreteSessionManager = $this->objectManager->get('Aijko\\SessionStorage\\FrontendStorage');
		} else {
			$this->concreteSessionManager = $this->objectManager->get('Aijko\\SessionStorage\\BackendStorage');
		}
	}

	/**
	 * @param mixed $data
	 * @return boolean
	 */
	public function  isSerializable($data) {
		return $this->concreteSessionManager->isSerializable($data);
	}

	/**
	 * @param string $key
	 * @param string $type
	 * @return string
	 */
	public function get($key, $type = 'ses') {
		return $this->concreteSessionManager->get($key, $type);
	}

	/**
	 * @param string $key
	 * @param mixed $data
	 * @param string $type
	 * @return void
	 */
	public function set($key, $data, $type = 'ses') {
		$this->concreteSessionManager->set($key, $data, $type);
	}

	/**
	 * @param string $key
	 * @param string $type
	 * @return boolean
	 */
	public function has($key, $type = 'ses') {
		return $this->concreteSessionManager->has($key, $type);
	}

	/**
	 * @param string $key
	 * @param string $type
	 * @return void
	 */
	public function remove($key, $type = 'ses') {
		$this->concreteSessionManager->remove($key, $type);
	}

	/**
	 * @param object $object
	 * @param string $key
	 * @param string $type
	 * @return void
	 */
	public function storeObject($object, $key = NULL, $type = 'ses') {
		$this->concreteSessionManager->storeObject($object, $key, $type);
	}

	/**
	 * @param string $key
	 * @param string $type
	 * @return mixed
	 */
	public function getObject($key, $type = 'ses') {
		return $this->concreteSessionManager->getObject($key, $type);
	}

	/**
	 * @return \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication
	 */
	public function getUser() {
		return $this->concreteSessionManager->getUser();
	}

	/**
	 *
	 * @return \Aijko\SessionStorage\AbstractSessionStorage
	 */
	public function getConcreteSessionManager() {
		return $this->concreteSessionManager;
	}

}

?>