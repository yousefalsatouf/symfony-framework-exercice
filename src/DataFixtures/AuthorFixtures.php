<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create();
        for ($i=1; $i<10; $i++)
        {
            $author = new Author();
            $content = '<p>'.join($faker->sentence(5).'</p><p>').'</p>';
        }
        $manager->flush();
    }
}
