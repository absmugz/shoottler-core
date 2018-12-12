<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/26/18
 * Time: 8:29 PM
 */

namespace App\Contracts;


interface ResourceContract {

	public function resourceName();

	public function usesHotelRating();

	public function usesFeaturedImage();

	public function usesGallery();

	public function usesAddressable();

	public function mayHaveAmenities();

	public function featuredImage();

	public function gallery();

}