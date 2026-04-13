<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $title = rtrim($this->faker->sentence(rand(3, 6)), '.');
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraphs(3, true),
            'isbn' => $this->faker->isbn13(),
            'cover_image' => 'https://ui-avatars.com/api/?name=' . urlencode($title) . '&background=1e293b&color=fbbf24&size=400',
            'file_path' => 'books/sample.pdf',
            'borrows' => $this->faker->numberBetween(10, 5000),
        ];
    }
}
