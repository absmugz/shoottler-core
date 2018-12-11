<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

/**
 * Base class for all models in the system *
 * @author Luis Atencio
 */
abstract class BaseModel extends Model {

	use SingleTableInheritanceTrait;

	/**
	 * The type field for single table inheritance
	 * @var string
	 */
	protected static $singleTableTypeField = 'type';

}

