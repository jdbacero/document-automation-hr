<?php

namespace Database\Factories;

use App\Models\DocumentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'document_title' => $this->faker->sentence,
            'document_body' => '<p>' . $this->faker->paragraph . '</p>',
            'document_category_id' => DocumentCategory::factory()
        ];
    }
}
