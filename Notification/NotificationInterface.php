<?php

namespace Acme\Bundle\NotificationBundle\Notification;

Interface NotificationInterface
{
	public function setMessage($message);
	public function sendMessage();
}