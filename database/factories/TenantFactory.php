<?php

namespace Spatie\Multitenancy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Tests\TestClasses\User;

class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'domain' => $this->faker->unique()->domainName,
            'database' => $this->faker->userName,
        ];
    }

    protected function createChildren(Model $model): void
    {
        if ($model instanceof Tenant) {
            $model->execute(function() use ($model) {
                parent::createChildren($model);
            });
        } else {
            parent::createChildren($model);
        }
    }
}
