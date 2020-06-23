<?php
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('MyAuth');
    }

    public function beforeFilter(Event $event)
    {
    	parent::beforeFilter($event);
    	// 認証している場合は、メニューを「admin」用にする
    	$user = $this->MyAuth->user();
    	
    	$menu = "default";
    	if ($user) {
    		// Viewに認証済みユーザ情報を渡す
    		$this->set("auth",$user);
    		$menu = "admin";
    	}
    	$this->set("menu", $menu);
    }
    
    // 認証用メソッド（正当なユーザであれば「true」を返す）
    public function isAuthorized($user = null)
    {
    	if ($user !== null) {
    		return true;
    	}
    	return false;
    }
}
