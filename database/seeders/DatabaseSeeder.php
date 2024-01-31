<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Course::factory()->create([
            'name' => 'Introduction to Computer Science',
            'code' => 'CS101',
            'body' => 'This course will introduce you to the world of computer science. Topics include computational thinking, problem-solving, data representation, abstraction, procedures/algorithms, and more.',
            // 'image' => 'intro_to_cs.jpg',
            'status' => 'published',
            'price' => 1998.99,
            'published_at' => now(),
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Data Structures and Algorithms',
            'code' => 'CS102',
            'body' => 'This course will teach you about various data structures and algorithms used in computer science. Topics include arrays, linked lists, stacks, queues, trees, sorting, searching, and more.',
            // 'image' => 'data_structures.jpg',
            'status' => 'draft',
            'price' => 0,
            'published_at' => null,
            'is_free' => true
        ]);

        \App\Models\Course::factory()->create([
            'name' => 'Web Development',
            'code' => 'CS103',
            'body' => 'This course will teach you how to build websites using HTML, CSS, and JavaScript. Topics include responsive design, front-end libraries, back-end servers, databases, and more.',
            // 'image' => 'web_development.jpg',
            'status' => 'pending_review',
            'price' => 187.50,
            'published_at' => now(),
        ]);

        \App\Models\Course::factory(92)->create();
    }
}
