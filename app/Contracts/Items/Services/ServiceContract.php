<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 1:46 AM
 */

namespace App\Contracts;


interface ServiceContract extends ItemContract {

	public function hasInstructions();

	public function mayHaveAmenities();
}