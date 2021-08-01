<?php

namespace Portal\RestController;

use Portal\WordsController\WordsController;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;


/**
 * RestController
 */
class RestController extends AbstractRestfulController {
	/**
	 * @var WordsController|null
	 */
	private $wordController;
	/**
	 * @var Integer $httpStatusCode Define Api Response code.
	 */
	public $httpStatusCode = 200;

	/**
	 * @var array $apiResponse Define response for api
	 */
	public $apiResponse;

	/**
	 *
	 * @var type string
	 */
	public $token;

	/**
	 *
	 * @var type Object or Array
	 */
	public $tokenPayload;


	public function __construct() {
		$this->wordController = WordsController::getInstance();
	}

	private function __clone() {
		// TODO: Implement __clone() method.
	}

	/**
	 * set Event Manager to check Authorization
	 * @param \Zend\EventManager\EventManagerInterface $events
	 */
	public function setEventManager(EventManagerInterface $events)
	{
		die('test');
		parent::setEventManager($events);
		//$events->attach('dispatch', array($this, 'checkAuthorization'), 10);
		$events->attach('dispatch', array($this, 'SetWord'), 11);
	}


	public function SetWord( $event ) {
		$request = $event->getRequest();
		$response = $event->getResponse();
		$config = $event->getApplication()->getServiceManager()->get('Config');
		$event->setParam('config', $config);
		if (isset($config['ApiRequest'])) {
			if ( $this->wordController->manipulate_word( $request->text ) === true ) {
				$this->httpStatusCode              = 200;
				$this->apiResponse['response'] = 'ok';
			} else {
				$this->httpStatusCode              = 200;
				$this->apiResponse['response'] = 'error';
			}


		} else {
			$response->setStatusCode(400);
			$jsonModelArr = ['status' => 'NOK', 'result' => ['error' => 'error']];
		}

		$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
		$view = new JsonModel($jsonModelArr);
		$response->setContent($view->serialize());
		return $response;

	}



}
