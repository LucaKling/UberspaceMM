<?php
/**
 * Class UberspaceMM
 *
 * @copyright  Luca Kling 2014
 * @author     Luca Kling <hallo@lucakling.de>
 *
 * Parts forked from Fabian Laule <fabianlaule.de>
 */
class UberspaceMM {
	/**
	 * Get all currently defined usernames (mailboxes and forwarding destinations)
	 * @param object
	 * @return array
	 */
	public function getUsernames($onlyUsernames = false) {
		$arrUsernames = array();
		$arrForwards = array();

		$usernames = shell_exec('listvdomain');
		$usernames = preg_split('/[\r\n]+/', $usernames, null, PREG_SPLIT_NO_EMPTY);
		unset($usernames[0]);
		foreach ($usernames as $key => $value) {
			$isMailbox = null;
			$x = null;
			$value = explode(' ', $value);
			if($onlyUsernames) {
				$arrUsernames[$value[0]] = $value[0];
			} else {
				if(count($value) > 2) {
					for($x = 2; $x < count($value); $x++)
						$arrForwards[$value[0]][$value[$x]] = $value[$x];
				} else
					$arrForwards[$value[0]] = array();
				switch($value[1]) {
					case 'Yes': $isMailbox = true; break;
					case 'No': $isMailbox = false; break;
				}
				$arrUsernames[$value[0]] = array('name' => $value[0], 'isMailbox' => $isMailbox, 'forwards' => $arrForwards[$value[0]]);
			}
		}
		return $arrUsernames;
	}
	/**
	 * add new user via Shell
	 * 
	 * @param string
	 * @param string
	 * @return bool
	 */
	public function addNewUser($strMailbox, $strPassword) {
		$strPassword = utf8_decode($strPassword);
		$strCommand = 'vadduser ' . $strMailbox;
		
		$descriptorspec = array(
				0 => array('pipe', 'r')
		);
		
		$process = proc_open($strCommand, $descriptorspec, $pipes, null, null);
		
		if(is_resource($process)) {
			fwrite($pipes[0], $strPassword);
			fclose($pipes[0]);
			$return_value = proc_close($process);
				if($return_value == 0) {
					return true;	
				}
		}
		return false;
	}
	/**
	 * delete user via Shell
	 * supports deletion of several users, just place a whitespace in between the mailbox names
	 * 
	 * @param string
	 * @return bool
	 */
	public function deleteUser($strMailboxes) {
		$strCommand = 'vdeluser ' . $strMailboxes;
		
		$descriptorspec = array();
		
		$process = proc_open($strCommand, $descriptorspec, $pipes, null, null);
		
		if(is_resource($process)) {
			if(proc_close($process) == 0)
				return true;
		}
		return false;
	}
	/**
	 * set the new Password via Shell
	 * @copyright Fabian Laule <fabianlaule.de>
	 * 
	 * @param string
	 * @param string
	 * @return bool
	 */
	public function setNewPassword($strMailbox, $strPassword) {
		$strPassword = utf8_decode($strPassword);
		$strCommand = 'vpasswd ' . $strMailbox;
		
		$descriptorspec = array(
				0 => array('pipe', 'r')
		);
		
		$process = proc_open($strCommand, $descriptorspec, $pipes, null, null);
		
		if(is_resource($process)) {
			fwrite($pipes[0], $strPassword);
			fclose($pipes[0]);
			$return_value = proc_close($process);
				if($return_value == 0) {
					return true;	
				}
		}
		return false;
	}
	/**
	 * Add alias (forwarder) account
	 * This function adds a forwarder account which forwards mails sent to the account to the given forwards
	 * supports several destinations, just place a whitespace in between the destinations
	 *
	 * @param string
	 * @param string
	 * @return bool
	 */
	public function addNewAlias($strMailbox, $strDestinations) {
		$strCommand = 'vaddalias ' . $strMailbox . ' ' . $strDestinations;
		
		$descriptorspec = array();
		
		$process = proc_open($strCommand, $descriptorspec, $pipes, null, null);
		
		if(is_resource($process)) {
			if(proc_close($process) == 0)
				return true;
		}
		return false;
	}
	/**
	 * Change/Replace forwards of an account
	 * This functions replaces the forward destinations of an account with the given ones
	 * supports several destinations, just place a whitespace in between the destinations
	 *
	 * @param string
	 * @param string
	 * @return bool
	 */
	public function changeForwards($strMailbox, $strDestinations) {
		$strCommand = 'vchforwards ' . $strMailbox . ' ' . $strDestinations;
		
		$descriptorspec = array();
		
		$process = proc_open($strCommand, $descriptorspec, $pipes, null, null);
		
		if(is_resource($process)) {
			if(proc_close($process) == 0)
				return true;
		}
		return false;
	}
}