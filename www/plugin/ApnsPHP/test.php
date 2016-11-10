<?
Class IosPush
{
	public function iosSendPush ()
	{
		$path =  $_SERVER['DOCUMENT_ROOT'].'/plugin/ApnsPHP';
		// Adjust to your timezone
		//date_default_timezone_set('Asia/Seoul');
		// Report all PHP errors
		//error_reporting(-1);
		// Using Autoload all classes are loaded on-demand
		require_once $path.'/Autoload.php';
		// Instantiate a new ApnsPHP_Push object

		$push = new ApnsPHP_Push(
			ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION,
			$path.'/wbox_apns_user.pem'
		);
		//$push->setRootCertificationAuthority('entrust_root_certification_authority.pem');
		for ($i=0; $i < 1; $i++) {

			// Connect to the Apple Push Notification Service
			$push->connect();

			// Instantiate a new Message with a single recipient
			$message = new ApnsPHP_Message('a454ad22a33c822589b4f7836d52e8cb8f1ee11126d2e0ff5bdb83ae0fcc1f04');

			// Set a custom identifier. To get back this identifier use the getCustomIdentifier() method
			// over a ApnsPHP_Message object retrieved with the getErrors() message.
			$message->setCustomIdentifier("Message-Badge-3");

			// Set badge icon to "3"
			$message->setBadge((1));

			// Set a simple welcome text
			$message->setText('setText');

			// Play the default sound
			$message->setSound();

			// Set a custom property
			$message->setCustomProperty('ps_title', 'ps_title');
			$message->setCustomProperty('push_url', 'http://naver.com/');

			// Set the expiry value to 30 seconds
			$message->setExpiry(30);

			// Add the message to the message queue
			$push->add($message);

			// Send all messages in the message queue
			$push->send();

			// Disconnect from the Apple Push Notification Service
			$push->disconnect();

			// Examine the error message container
			$aErrorQueue = $push->getErrors();
			echo $aErrorQueue;


		}
	}
}

$push = new IosPush();
$push->iosSendPush();