<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 3:51 AM
 */

namespace App\Traits;

use App\Models\Instructions\Instruction;

trait hasInstructions {

	public function instructions(){
		return $this->hasOne(Instruction::class);
	}
}