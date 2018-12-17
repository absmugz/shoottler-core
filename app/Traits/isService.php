<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 4:07 AM
 */

namespace App\Traits;


trait isService {
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular' => 'Service','plural' => 'Services'];
	}
	/**
	 * This item uses Gallery
	 * @return bool
	 */
	public function usesGallery() {
		return true;
	}
	/**
	 * This item uses Featured Image
	 * @return bool
	 */
	public function usesFeaturedImage() {
		return true;
	}
	/**
	 * This item may have Amenities
	 * @return bool
	 */
	public function mayHaveAmenities() {
		return true;
	}
	/**
	 * This item has instructions for the user
	 * @return bool
	 */
	public function hasInstructions() {
		return true;
	}
}