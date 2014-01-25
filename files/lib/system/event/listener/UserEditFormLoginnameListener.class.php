<?php
namespace wcf\system\event\listener;

use wcf\system\WCF;

/**
 * @author		Markus Zhang <roul@codingcorner.info>
 * @copyright	2014 Markus Zhang
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	system.event.listener
 * @category	LoginName
 */
class UserEditFormLoginnameListener extends UserAddFormLoginnameListener {
	protected function validate() {
		if (mb_strtolower($this->eventObj->user->loginname) != mb_strtolower($this->loginname)) {
			// if a user did set a loginname or you did create a user with one,
			// it can never get removed, only changed!
			if (empty($this->loginname)) {
				$this->eventObj->errorType['loginname'] = 'empty';
			}
			else {
				parent::validate();
			}
		}
	}

	protected function readData() {
		if (empty($_POST)) {
			$this->loginname = $this->eventObj->user->loginname;
		}
	}
}
