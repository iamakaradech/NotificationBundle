<?php
namespace Acme\Bundle\NotificationBundle\Notification;

class NotificationAdapter
{
	private $_provider;

	public function __construct()
	{
	}

	public function setProvider(NotificationInterface $provider)
	{
		$this->_provider = $provider;
	}

	public function send()
	{
		return $this->_provider->sendMessage();
	}
}