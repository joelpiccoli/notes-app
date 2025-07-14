<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3, 6),
            'description' => fake()->paragraphs(rand(1, 3), true),
            'tags' => fake()->randomElements([
                'work', 'personal', 'ideas', 'todo', 'important',
                'meeting', 'project', 'reminder', 'inspiration', 'notes',
            ], rand(0, 3)),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the note has no description.
     */
    public function withoutDescription(): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => null,
        ]);
    }

    /**
     * Indicate that the note has no tags.
     */
    public function withoutTags(): static
    {
        return $this->state(fn (array $attributes) => [
            'tags' => null,
        ]);
    }
}
