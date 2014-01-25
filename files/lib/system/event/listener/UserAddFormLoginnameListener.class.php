<?php
namespace wcf\system\event\listener;

use wcf\system\event\IEventListener;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * @author		Markus Zhang <roul@codingcorner.info>
 * @copyright	2014 Markus Zhang
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	system.event.listener
 * @category	LoginName
 */
class UserAddFormLoginnameListener implements IEventListener {
	/**
	 * instance of UserAuthenticationFactory
	 * @var wcf\system\user\authentication\UserAuthenticationFactory
	 */
	protected $eventObj = null;

	/**
	 * the className of the class the event got fired from
	 */
	protected $className = null;

	/**
	 * loginname module enabled
	 * @var bool
	 */
	protected $enabled = MODULE_SYSTEM_LOGINNAME;

	/**
	 * loginname
	 * @var string
	 */
	protected $loginname = '';

	/**
	 * @see	wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		$this->eventObj = $eventObj;
		$this->className = $className;
		
		if ($this->enabled) {
			$this->$eventName();
		}
	}
	
	/**
	 * Handles the init event.
	 */
	protected function assignVariables() {
		WCF::getTPL()->assign(array(
			'loginname' => $this->loginname,
		));
	}

	/**
	 * Handles the readFormParameters event.
	 */
	protected function readFormParameters() {
		if (isset($_POST['loginname'])) $this->loginname = StringUtil::trim($_POST['loginname']);
	}

	/**
	 * Returns true if the given name is a valid loginname.
	 *
	 * @param	string		$name
	 * @return	boolean
	 */
	protected function isValidLoginname($name) {
		// minimum length is 3 characters, maximum length is 255 characters
		if (mb_strlen($name) < 3 || mb_strlen($name) > 255) {
			return false;
		}
		
		// check format
		if (!preg_match('!^[a-zA-Z]+[a-zA-Z0-9._-]*[a-zA-Z0-9]+$!', $name)) {
			return false;
		}

		return true;
	}

	protected function validate() {
		if (!$this->isValidLoginname($this->loginname)) {
			$this->eventObj->errorType['loginname'] = 'notValid';
		}
		else {
			// Check if loginname exists already.
			$sql = "SELECT	COUNT(loginname) AS count
				FROM	wcf".WCF_N."_user
				WHERE	loginname = ?";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($this->loginname));
			$row = $statement->fetchArray();

			if ($row['count'] != 0) {
				$this->eventObj->errorType['loginname'] = 'notUnique';
			}
		}
	}

	protected function save() {
		$this->eventObj->additionalFields['loginname'] = $this->loginname;
	}

	protected function saved() {
		$this->loginname = '';
	}
}
