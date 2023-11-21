<?php

// Database\Factories\BookFactory.php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Book::class;

    public function definition()
    {
        $titleExamples = [
            'The Catcher in the Rye',
            'To Kill a Mockingbird',
            '1984',
            'The Great Gatsby',
        ];

        $authorExamples = [
            'J.D. Salinger',
            'Harper Lee',
            'George Orwell',
            'F. Scott Fitzgerald',
        ];

        $price = $this->faker->randomFloat(2, 7, 30); // Random price between 50 and 500.

        $isbn = $this->faker->unique()->isbn13;

        return [
            'title' => $this->faker->randomElement($titleExamples),
            'author' => $this->faker->randomElement($authorExamples),
            'ISBN' => $isbn,
            'price' => $price,
        ];
    }
}

