<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/27/18
 * Time: 1:49 AM
 */

namespace App\Contracts;


interface ItemContract {

	public function itemName();

	public function usesFeaturedImage();

	public function featuredImage();

	public function usesGallery();

	public function gallery();

}