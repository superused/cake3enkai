<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class HomesController extends AppController
{
	public function index()
	{
		$this->loadModel("Events");
		$this->paginate = [
				'contain' => ['EventUsers','Categories','Users'],
				'limit' => 5,
				'order' => ['id' => 'ASC'],
		];
		$events = $this->paginate($this->Events);
		$this->set(compact('events'));
 	}

}