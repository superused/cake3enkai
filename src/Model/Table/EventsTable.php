<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EventsTable extends Table
{
	
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->table('events');
		$this->displayField('name');
		$this->primaryKey('id');
		
		$this->addBehavior('Timestamp');
		
		$this->hasMany('EventUsers', [
				'foreignKey' => 'event_id'
		]);
		$this->hasMany('Chats', [
				'foreignKey' => 'event_id'
		]);
		$this->belongsTo('Users', [
				'foreignKey' => 'user_id',
				'joinType' => 'INNER'
		]);
		$this->belongsTo('Categories', [
				'foreignKey' => 'category_id',
				'joinType' => 'INNER'
		]);
	}
	
	public function validationDefault(Validator $validator)
	{
		$validator
		    ->integer('id')
		    ->allowEmpty('id', 'create');
		
		$validator
		    ->requirePresence('name', 'create')
		    ->notEmpty('name');
		
	    $validator
		    ->requirePresence('detail', 'create')
		    ->notEmpty('detail');
		    
		$validator
		    ->integer('max_participant')
		    ->requirePresence('max_participant', 'create')
		    ->notEmpty('max_participant');
		
		return $validator;
	}
	
	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['user_id'],'Users'));
		$rules->add($rules->existsIn(['category_id'],'Categories'));
		return $rules;
	}
	
}