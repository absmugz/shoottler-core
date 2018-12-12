<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 1:47 AM
 */

namespace App\Contracts;


interface TourContract extends ServiceContract {

	public function amenities();

	public function itineraries();

}