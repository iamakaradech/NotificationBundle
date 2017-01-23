<?php

namespace Akaradech\NotificationBundle\Notification;

Interface NotificationInterface
{
	public function setMessage($message);
	public function sendMessage();
}