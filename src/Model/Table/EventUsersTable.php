<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EventUsersTable extends Table
{
	
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->table('event_users');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Users', [
				'foreignKey' => 'user_id',
				'joinType' => 'INNER'
		]);
		$this->belongsTo('Events', [
				'foreignKey' => 'event_id',
				'joinType' => 'INNER'
		]);
	}
	
	public function validationDefault(Validator $validator)
	{
		$validator
		    ->integer('id')
		    ->allowEmpty('id', 'create');
		
		return $validator;
	}
	
	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['user_id'],'Users'));
		$rules->add($rules->existsIn(['event_id'],'Events'));
		return $rules;
	}
	
}