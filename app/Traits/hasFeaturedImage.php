<?php

namespace App\Traits;

trait hasFeaturedImage {
	/**
	 * Get the Featured Image for this resource
	 * @return array
	 */
	public function featuredImage(){
		$featuredImages = $this->getMedia('Featured');
		$files = [];
		foreach ($featuredImages as $featuredImage) {
			$files[] = [
				'id' => $featuredImage->id,
				'name' => $featuredImage->name,
				'url' => $featuredImage->getFullUrl()];
		}
		return $files;
	}

}