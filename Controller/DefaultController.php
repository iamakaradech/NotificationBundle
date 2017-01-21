<?php

namespace Acme\Bundle\NotificationBundle\Controller;

use Acme\Bundle\NotificationBundle\Notification\EmailNotification;
use Acme\Bundle\NotificationBundle\Notification\NotificationAdapter;
use Acme\Bundle\NotificationBundle\Notification\SmsNotification;
use Acme\Bundle\NotificationBundle\Notification\TwitterNotification;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AcmeBundleNotificationBundle:Default:master.html.twig');
    }

	/**
	 * @Route("/send")
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function sendAction(Request $request)
	{
		$notificationAdapter = new NotificationAdapter();

		$message = $request->get('message');
		$providerType = $request->get('provider');
		$provider = null;

		switch ($providerType) {
			case 'sms':
				$provider = new SmsNotification($message);
				break;
			case 'email':
				$provider = new EmailNotification($message);
				break;
			case 'twitter':
				$provider = new TwitterNotification($message);
				break;
			default:
				$provider = new SmsNotification($message);
				break;
		}

		$notificationAdapter->setProvider($provider);

		return new Response($notificationAdapter->send(), Response::HTTP_OK);
	}
}