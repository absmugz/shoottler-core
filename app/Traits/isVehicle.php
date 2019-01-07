<?php

namespace App\Traits;


trait isVehicle {

	/**
	 * This resource's name
	 * @return string
	 */
	public function resourceName() {
		return 'Vehicle';
	}

	/**
	 * The units in which this resource's capacity is expressed
	 * @return string
	 */
	public function units(){
		return 'passengers';
	}
	/**
	 * This resource may not have an address
	 * @return bool
	 */
	public function usesAddressable() {
		return false;
	}

	/**
	 * This resource does not uses hotel rating
	 * @return bool
	 */
	public function usesHotelRating() {
		return false;
	}
	/**
	 * This resource uses Gallery
	 * @return bool
	 */
	public function usesGallery() {
		return true;
	}
	/**
	 * This resource may have Amenities
	 * @return bool
	 */
	public function mayHaveAmenities() {
		return true;
	}
	/**
	 * This resource uses Featured Image
	 * @return bool
	 */
	public function usesFeaturedImage() {
		return true;
	}
}