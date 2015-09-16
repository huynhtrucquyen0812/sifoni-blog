<?php

namespace App\Controller;

use Sifoni\Controller\Base;
use App\Model\User;

class UserController extends Base {
	public function indexAction(){
		$users=User::all();
		$data['users']=$users;
		return $this->render('user/index.html.twig', $data);
	}

	public function loginAction(){
		$data = array();
	    if ($this->getPostData()) {
	        $postData = $this->getPostData();
	        if ($user=User::checkLogin($postData['email'], $postData['password'])) {
	        	$this->app['session']->set("logged", $user);
	        	return $this->redirect('entrycontroller_index', array());
	        } else {
	            $data['error'] = 'Login failed! Please try again!';
	        }
	    }
	    return $this->render('user/login.html.twig', $data);
	}

	public function registerAction(){
		$data = array();
	    if ($postData = $this->getPostData()){
	    	if($user=User::register($postData)){
	    		$this->app['session']->set("logged", $user);
	    		return $this->redirect('entrycontroller_index', array());
	    	}else{
	    		$data['error'] = 'Register failed! Please try again!';
	    	}
	    }
	    return $this->render('user/register.html.twig', $data);
	}

	public function logoutAction(){
		$this->app['session']->remove("logged");
        $this->app['session']->clear();
        return $this->redirect('entrycontroller_index', array());
	}
}