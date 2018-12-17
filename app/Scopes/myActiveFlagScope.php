<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/30/18
 * Time: 8:32 PM
 */

namespace App\Scopes;


use Cog\Flag\Scopes\Classic\ActiveFlagScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class myActiveFlagScope extends ActiveFlagScope {

	/**
	 * Apply the scope to a given Eloquent query builder.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function apply(Builder $builder, Model $model)
	{
		if (method_exists($model, 'shouldApplyActiveFlagScope') && !$model->shouldApplyActiveFlagScope()) {
			return $builder;
		}
		return $builder->where('is_active', 1);
	}

}