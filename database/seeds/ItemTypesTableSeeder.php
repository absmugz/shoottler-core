<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-13
 * Time: 17:48
 */

class ItemTypesTableSeeder extends \Illuminate\Database\Seeder {
	public function run(){
		$itemTypes = \HaydenPierce\ClassFinder\ClassFinder::getClassesInNamespace('App\Models\Items\Services');
		foreach($itemTypes as $Type){
			$class = app($Type);
			$model = new $class;
			$modelNames = $model->itemName();
			$modelName = $modelNames['singular'];
			$itemType = new \App\Models\Items\ItemType([
				'name' => $modelName,
				'type' => 'service',
				'class' => $Type
			]);
			$itemType->save();
		}
	}
}