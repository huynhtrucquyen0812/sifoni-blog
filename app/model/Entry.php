<?php

namespace App\Model;

use Sifoni\Model\Base;
use App\Model\User;

class Entry extends Base {
	protected $table = 'entrys';
	public $timestamps=false;
	protected $fillable = ['title', 'content', 'user_id'];

	public static function getItems($limit, $page)
	{
		$entrys=Entry::orderBy('posted_day', 'desc')->skip($limit*$page)->take($limit);
		return $entrys->get();
	}

	public static function getItemsBy($field, $value, $limit, $page)
	{
		$entrys=Entry::where($field, $value)
					->orderBy('posted_day', 'desc')->skip($limit*$page)->take($limit);
		return $entrys->get();
	}

	public static function getCountBy($field, $value)
	{
		$entrys=Entry::where($field, $value);
		return $entrys->count();
	}
}