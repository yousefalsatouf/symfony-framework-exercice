<?php

namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class NewsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for($n=1; $n<=10; $n++)
        {
            $news = new News();
            $content = '<p>'.join($faker->paragraphs(5), '</p><p>').'</p>';
            $news->setTitle($faker->sentence())
                 ->setContent($content)
                 ->setImage($faker->imageUrl());
            $manager->persist($news);
        }
        $manager->flush();
    }
}
