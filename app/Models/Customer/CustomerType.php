<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-17
 * Time: 20:43
 */

namespace App\Models\Customer\Type;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class CustomerType extends Model {
	use Eloquence;
	protected $table = 'customer_types';
	protected $fillable = [
		'type',
		'name',
		'class'
	];
	public $searchableColumns = [
		'name','type'
	];
}