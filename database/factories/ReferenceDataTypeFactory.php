<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReferenceDataTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ref_data_code'=>'LANGUAGE_SUPPORT',
            'ref_data_name'=>'LANGUAGE_SUPPORT'
        ];
    }
}
