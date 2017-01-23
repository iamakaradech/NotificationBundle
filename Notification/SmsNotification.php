<?php
namespace Akaradech\NotificationBundle\Notification;

class SmsNotification implements NotificationInterface
{
	private $_message;

	public function __construct($message = '')
	{
		$this->_message = $message;
	}

	public function setMessage($message)
	{
		$this->_message = $message;
	}

	public function sendMessage()
	{
		return 'Message: ' . $this->_message . ' Has Been Sent To SMS';
	}
}