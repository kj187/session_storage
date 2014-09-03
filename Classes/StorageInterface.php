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
interface StorageInterface extends \TYPO3\CMS\Core\SingletonInterface {
 
	/**
	 * @param mixed $data
	 */
	public function isSerializable($data);

	/**
	 * @param string $key
	 * @param string $type
	 */
	public function get($key, $type = '');

	/**
	 * @param string $key
	 * @param mixed $data
	 * @param string $type
	 */
	public function set($key, $data, $type = '');

	/**
	 * @param string $key
	 * @param string $type
	 */
	public function remove($key, $type = '');

	/**
	 * @param string $key
	 * @param string $type
	 */
	public function has($key, $type = '');

	/**
	 * @param object $object
	 * @param string $key
	 * @param string $type
	 */
	public function storeObject($object, $key = NULL, $type = '');

	/**
	 * @param string $key
	 * @param string $type
	 * @return mixed
	 */
	public function getObject($key, $type = '');

	/**
	 * @return object
	 */
	public function getUser();

	/**
	 * @return string
	 */
	public function getSessionId();

	/**
	 * @param string $id
	 */
	public function setSessionId($id);

}