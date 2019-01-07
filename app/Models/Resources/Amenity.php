<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-11
 * Time: 20:04
 */

namespace App\Models\Resources;

use App\Models\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Amenity extends BaseModel {

	use HasMediaTrait;

	protected $fillable = [
		'name',
		'description'
	];
}