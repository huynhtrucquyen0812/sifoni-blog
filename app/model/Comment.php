<?php

namespace App\Model;

use Sifoni\Model\Base;
use App\Model\User;

class Comment extends Base {
	public $timestamps=false;
	protected $fillable = ['name', 'comment', 'entry_id'];
}