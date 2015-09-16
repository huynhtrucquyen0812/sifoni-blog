<?php

namespace App\Model;

use Sifoni\Model\Base;
use App\Model\User;

class Entry extends Base {
	protected $table = 'entrys';
	public $timestamps=false;
	protected $fillable = ['title', 'content', 'user_id'];
}