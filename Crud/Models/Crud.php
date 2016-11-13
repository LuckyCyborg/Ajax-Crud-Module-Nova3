<?php
namespace App\Modules\Crud\Models;

use Nova\Database\ORM\Model;
use DB;

class Crud extends Model
{
	protected $table = 'crud';

	public function __construct()
	{
	    DB::statement("CREATE TABLE IF NOT EXISTS `".PREFIX."crud` (
		`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`title` varchar(255) DEFAULT NULL,
		`comment` text DEFAULT NULL,
		`created_at` datetime DEFAULT NULL,
		`updated_at` datetime DEFAULT NULL,
  		PRIMARY KEY (`id`)
		) DEFAULT CHARSET=utf8;");
	}
}