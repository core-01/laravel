<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReferenceDataFactory extends Factory
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
            'src_value'=>'H',
            'mapped_value'=>'Hindi'
        ];
    }
}
