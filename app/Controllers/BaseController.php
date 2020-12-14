<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\M_Notification;
use CodeIgniter\Controller;
use CodeIgniter\Model;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'html', 'filesystem', 'security', 'text', 'url', 'lpremium_helper'];


	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:

		// Pusher
		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		);

		$this->pusher = new \Pusher\Pusher(
			'df1a99135b646cb1942a',
			'34a28e8552a1baf72c4c',
			'1121961',
			$options
		);

		// Notification
		$this->M_Notification = new M_Notification();
		// $this->session = \Config\Services::session();
	}
}
