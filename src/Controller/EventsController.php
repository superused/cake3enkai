<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class EventsController extends AppController
{
	public function index()
	{
		$this->paginate = [
				'contain' => ['EventUsers','Categories','Users'],
				'limit' => 5,
				'order' => ['id' => 'ASC'],
		];
		$events = $this->paginate($this->Events);

		$this->set(compact('events'));
	}


	public function view($id = null)
	{
		$event = $this->Events->get($id, [
				'contain' => ['EventUsers','Categories','Users']
		]);

		$this->set('event', $event);
	}

}
