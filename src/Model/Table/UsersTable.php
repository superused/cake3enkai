<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
	
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->table('users');
		$this->displayField('email');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		
		$this->hasMany('Events', [
				'foreignKey' => 'user_id'
		]);
		
		$this->hasMany('EventUsers', [
				'foreignKey' => 'user_id'
		]);
		
		$this->hasMany('Chats', [
				'foreignKey' => 'user_id'
		]);
	}
	
	public function validationDefault(Validator $validator)
	{
		$validator
			->integer('id')
			->allowEmpty('id', 'create');
		
		$validator
			->email('email')
			->requirePresence('email', 'create')
			->notEmpty('email')
			->add('email', 'unique', [
					'rule' => 'validateUnique',
					'provider' => 'table',
					'message' => '登録できません'
			]);
		    
		$validator
			->requirePresence('password', 'create')
			->notEmpty('password');
		
		return $validator;
	}
	
	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->isUnique(['email'],["message" => "登録できません"]));
		return $rules;
	}
	
}
