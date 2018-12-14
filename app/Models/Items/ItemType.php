<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-13
 * Time: 17:53
 */

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model {
	protected $table = 'item_types';
	protected $fillable = [
		'name',
		'type'
	];
}