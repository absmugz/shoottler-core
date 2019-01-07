<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/26/18
 * Time: 4:55 PM
 */

namespace App\Traits;


trait hasGallery {
	/**
	 * Get the gallery for this resource
	 * @return array
	 */
	public function gallery(){
		$gallery = $this->getMedia('Gallery');
		$files = [];
		foreach ($gallery as $image) {
			$files[] = [
				'id' => $image->id,
				'name' => $image->name,
				'url' => $image->getFullUrl()];
		}
		return $files;
	}
}