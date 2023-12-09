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
    private static $counter = 0;

    public function definition()
    {
        $titleExamples = [
            'The Catcher in the Rye',
            'To Kill a Mockingbird',
            '1984',
            'The Great Gatsby',
            'The Plague Dogs',
            'Outliers: The Story of Success',
            'Great River of the Abyss',
            'No Country for Old Men',
            'All the Pretty Horses',
            'Alyzon Whitestarr',
            'The Ballad of Songbirds and Snakes',
            'The Hunger Games',
            'Catching Fire',
            'Mockingjay',
            'The Maze Runner',
            'The Scorch Trials',
            'The Death Cure',
            'Divergent',
            'Allegiant',
            'Insurgent',
            'It Ends with Us',
            'It Starts with Us',
            'All Your Perfects',
            'Ugly Love',
        ];

        $imageExamples = [];

        $allowedExtensions = ['jpeg', 'jpg', 'png'];
        for ($i = 1; $i <= count($titleExamples); $i++) {
            foreach ($allowedExtensions as $extension) {
                $filename = "Title{$i}.{$extension}";

                // Check if the file exists before adding it to the examples.
                $filePath = public_path("images/books/{$filename}");
                if (file_exists($filePath)) {
                    $imageExamples[] = $filename;
                    break; // Stop loop if file is found.
                }
            }
        }

        $authorExamples = [
            'J.D. Salinger',
            'Harper Lee',
            'George Orwell',
            'F. Scott Fitzgerald',
            'Richard Adams',
            'Malcolm Gladwell',
            'Duncan Wilson',
            'Cormac McCarthy',
            'Ruth Ozeki',
            'Isobelle Carmody',
            'Suzanne Collins',
            'James Dashner',
            'Veronica Roth',
            'Colleen Hoover',
            'Stephen King',
            'J. K. Rowling',
            'Jeff Kinney',
            'Holly Black',
            'Kazuo Ishiguro',
            'Patrick Rothfuss',
            'Charlie Jane Anders',
            'Tahereh Mafi',
            'J. Storer Clouston',
            'Conor McPherson',
        ];

        $price = $this->faker->randomFloat(2, 7, 30); // Random price between 50 and 500.
        $isbn = $this->faker->unique()->isbn13;
        self::$counter++;
        $imagePath = public_path("images/books/{$imageExamples[self::$counter - 1]}");

        return [
            'title' => $titleExamples[self::$counter - 1],
            'author' => $authorExamples[self::$counter - 1],
            'ISBN' => $isbn,
            'price' => $price,
            'image' => $imagePath,
        ];
    }
}
