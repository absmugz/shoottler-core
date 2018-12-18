<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-17
 * Time: 20:29
 */

class CustomerTypesTableSeeder extends \Illuminate\Database\Seeder {
	public function run(){
		$customerTypes = \HaydenPierce\ClassFinder\ClassFinder::getClassesInNamespace('App\Models\Customer');
		foreach($customerTypes as $Type){
			$class = app($Type);
			$model = new $class;
			$modelNames = $model->customerTypeName();
			$modelName = $modelNames['singular'];
			$customerType = new \App\Models\Customer\Type\CustomerType([
				'name' => $modelName,
				'type' => 'customer',
				'class' => $Type
			]);
			$customerType->save();
		}
	}
}