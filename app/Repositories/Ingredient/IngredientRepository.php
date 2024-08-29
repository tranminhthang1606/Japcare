<?php

namespace App\Repositories\Ingredient;

use App\Models\Ingredient;
use App\Repositories\BaseEloquentRepository;

class IngredientRepository extends BaseEloquentRepository implements IngredientRepositoryInterface
{
    public function model()
    {
        return Ingredient::class;
    }
}
