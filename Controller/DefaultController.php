<?php

namespace Akaradech\NotificationBundle\Controller;

use Akaradech\NotificationBundle\Notification\EmailNotification;
use Akaradech\NotificationBundle\Notification\NotificationAdapter;
use Akaradech\NotificationBundle\Notification\SmsNotification;
use Akaradech\NotificationBundle\Notification\TwitterNotification;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="notification-index")
     */
    public function indexAction()
    {
        return $this->render('NotificationBundle:Default:index.html.twig');
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
		$result = $notificationAdapter->send();

		return $this->render('NotificationBundle:Default:result.html.twig', array('result' => $result));
	}
}
