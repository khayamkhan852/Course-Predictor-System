<?php

namespace App\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BranchScope implements Scope {

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check() && ! auth()->user()->hasRole('Admin')) {
            $branch_id = request()->session()->get('branch_id');
            $builder->where('branch_id', $branch_id);
        }
    }

}
