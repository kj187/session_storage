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
abstract class AbstractStorage implements \Aijko\SessionStorage\StorageInterface {

	/**
	 * @var string
	 */
	protected $sessionNamespace = 'session_handler-';

	/**
	 * @return string
	 */
	public function getSessionNamespace() {
		return $this->sessionNamespace;
	}

	/**
	 * @param string $sessionNamespace
	 */
	public function setSessionNamespace($sessionNamespace) {
		$this->sessionNamespace = $sessionNamespace;
	}

	/**
	 * Check whether the data is serializable or not
	 *
	 * @param mixed $data
	 * @return boolean
	 */
	public function isSerializable($data) {
		if (is_object($data) || is_array($data)) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * @param string $key
	 * @return void
	 */
	protected function getKey($key) {
		return $this->sessionNamespace . $key;
	}

	/**
	 * Writes a object to the session if the key is empty it used the classname
	 *
	 * @param object $object
	 * @param string $key
	 * @param string $type
	 * @param \Aijko\SessionStorage\FrontendStorage|\Aijko\SessionStorage\BackendStorage $parentObject
	 * @return void
	 * @throws \InvalidArgumentException
	 */
	protected function storeSerializedObject($object, $key = NULL, $type = 'ses', $parentObject) {
		if (is_null($key)) {
			$key = get_class($object);
		}

		if ($this->isSerializable($object)) {
			$parentObject->set($key, serialize($object), $type);
		} else {
			throw new \InvalidArgumentException(sprintf('The object %s is not serializable.', get_class($object)));
		}
	}
 
}