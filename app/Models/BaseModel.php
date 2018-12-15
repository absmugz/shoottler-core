<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;
use Sofa\Eloquence\Eloquence;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Base class for all models in the system *
 * @author Luis Atencio
 */
abstract class BaseModel extends Model implements HasMedia {

	use HasMediaTrait;
	use SingleTableInheritanceTrait;
	use Eloquence;
	/**
	 * The type field for single table inheritance
	 * @var string
	 */
	protected static $singleTableTypeField = 'type';

}

