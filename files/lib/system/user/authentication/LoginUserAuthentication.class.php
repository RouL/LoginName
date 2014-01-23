<?php
namespace wcf\system\user\authentication;
use wcf\data\user\User;

/**
 * User authentication implementation that uses the login to identify users.
 *
 * @author		Markus Zhang
 * @copyright	2014 Markus Zhang
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.loginname
 * @subpackage	system.user.authentication
 * @category	LoginName
 */
class LoginUserAuthentication extends DefaultUserAuthentication {
	/**
	 * @see	\wcf\system\user\authentication\DefaultUserAuthentication::getUserByLogin()
	 */
	protected function getUserByLogin($login) {
		$sql = "SELECT	*
				FROM	wcf".WCF_N."_user
				WHERE	login = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($login));
		$row = $statement->fetchArray();
		if (!$row) $row = array();
		
		return new User(null, $row);
	}
}
