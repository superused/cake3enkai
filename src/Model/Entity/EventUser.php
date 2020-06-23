<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class EventUser extends Entity
{
	protected $_accessible = [
			'*' => true,
			'id' => false
	];
}