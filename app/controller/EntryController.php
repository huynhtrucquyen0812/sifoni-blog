<?php

namespace App\Controller;

use Sifoni\Controller\Base;
use App\Model\Entry;
use App\Model\User;
use App\Model\Comment;

class EntryController extends Base {
	public function indexAction(){
		$entrys=Entry::getItems(10, 0);
		foreach ($entrys as $key => $entry) {
			$entrys[$key]['username']=User::where('id', strval($entry['user_id']))->first()['name'];
		}
		$data['entrys']=$entrys;
		$data['pages']=1;
		$data['type']='entrys';
		return $this->render('entry/list.html.twig', $data);
	}

	public function turnPageAction($page){
		$entrys=Entry::getItems(10, $page);
		foreach ($entrys as $key => $entry) {
			$entrys[$key]['username']=User::where('id', strval($entry['user_id']))->first()['name'];
		}
		$data['entrys']=$entrys;
		$count=Entry::all()->count();
		if($count%10==0)
			$page=$count/10;
		else
			$page=intval($count/10)+1;
		$data['pages']=$page;
		$data['type']='entrys';
		return $this->render('entry/list.html.twig', $data);
	}

	public function manageAction($page){
		$user=$this->app['session']->get("logged");
		if($user){
			$entrys=Entry::getItemsBy('user_id', $user['id'], 10, $page);
			$data['entrys']=$entrys;
			$count=Entry::getCountBy('user_id', $user['id']);
			if($count%10==0)
				$page=$count/10;
			else
				$page=intval($count/10)+1;
			$data['pages']=$page;
			$data['type']='entrymanager';
		}else{
			$data['error']='Vui lòng đăng nhập!';
		}
		return $this->render('entry/manage.html.twig', $data);
	}

	public function createAction(){
		$user=$this->app['session']->get("logged");
		$data=array();
		if($user){
			if ($postData = $this->getPostData()){
				$postData['user_id']=$user['id'];
		    	if(Entry::create($postData)){
		    		return $this->redirect('entrymanage', array());
		    	}else{
		    		$data['error'] = 'Create failed! Please try again!';
		    	}
		    }
		}else{
			$data['error']='Vui lòng đăng nhập!';
		}
		return $this->render('entry/create.html.twig', $data);
	}

	public function updateAction($id){
		$user=$this->app['session']->get("logged");
		$data=array();
		if($user){
			if ($postData = $this->getPostData()){
		    	if(Entry::where('id', $id)
          				->update($postData)){
		    		return $this->redirect('entrymanage', array());
		    	}else{
		    		$data['error'] = 'Update failed! Please try again!';
		    	}
		    }else{
		    	$data['entry']=Entry::findOrFail($id);
		    }
		}else{
			$data['error']='Vui lòng đăng nhập!';
		}
		return $this->render('entry/update.html.twig', $data);
	}

	public function deleteAction($id){
		$user=$this->app['session']->get("logged");
		$data=array();
		if($user){
		    if(Comment::where('entry_id', $id)->delete() && Entry::destroy($id)){
		    	return $this->redirect('entrymanage', array());
		    }else{
		    	$data['error'] = 'Delete failed! Please try again!';
		    }
		}else{
			$data['error']='Vui lòng đăng nhập!';
		}
		return $this->redirect('entrymanage', array());
	}

	public function singleAction($id){
		if($entry=Entry::findOrFail($id)){
			if($postData = $this->getPostData()){
				$postData['entry_id']=$id;
				Comment::create($postData);
				return $this->redirect('singleEntry', array('id'=>$id));
			}
			$entry['username']=User::where('id', strval($entry['user_id']))->first()['name'];
			$data['entry']=$entry;

			$data['comments']=Comment::where('entry_id', $id)->get();
		}else{
			$data['error']='Không tìm thấy bài viết';
		}
		return $this->render('entry/single.html.twig', $data);
	}
}