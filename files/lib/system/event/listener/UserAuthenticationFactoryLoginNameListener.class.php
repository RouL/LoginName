<?php
namespace wcf\system\event\listener;

use wcf\system\cache\builder\BotcheckQuestionCacheBuilder;
use wcf\system\event\IEventListener;
use wcf\system\exception\UserInputException;
use wcf\system\Regex;
use wcf\system\WCF;
use wcf\util\ArrayUtil;
use wcf\util\MathUtil;
use wcf\util\StringUtil;

/**
 * Changes the user authentication class name.
 *
 * @author		Markus Zhang <roul@codingcorner.info>
 * @copyright	2014 Markus Zhang
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	system.event.listener
 * @category	Community Framework
 */
class UserAuthenticationFactoryLoginNameListener implements IEventListener {
	/**
	 * instance of UserAuthenticationFactory
	 * @var wcf\system\user\authentication\UserAuthenticationFactory
	 */
	protected $eventObj = null;

	/**
	 * loginname module enabled
	 * @var bool
	 */
	protected $enabled = MODULE_SYSTEM_LOGINNAME;

	/**
	 * @see	wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		$this->eventObj = $eventObj;
		
		if ($this->enabled) {
			$this->$eventName();
		}
	}
	
	/**
	 * Handles the init event.
	 */
	protected function init() {
		$this->eventObj->className = 'wcf\system\user\authentication\LoginUserAuthentication';
	}
}
