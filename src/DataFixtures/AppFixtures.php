<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Creating some sample authors
        $authors = [
            ['name' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com'],
            ['name' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com'],
            ['name' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com'],
        ];

        // Looping through each author and persisting them into the database
        foreach ($authors as $authorData) {
            $author = new Author();
            $author->setUsername($authorData['name']);
            $author->setEmail($authorData['email']);
            $manager->persist($author); // Staging the object to be saved
        }

        $manager->flush(); // Writing everything to the database
    }
}
