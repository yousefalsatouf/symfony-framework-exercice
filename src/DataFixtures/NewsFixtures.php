<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class NewsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        //create 3 fake categories
        for ($c=1; $c<=3; $c++)
        {
            $cat = new Category();
            $cat->setTitle($faker->sentence())
                ->setDescription($faker->paragraph());

            $manager->persist($cat);

            // create the Authors ...
            for ($a=1; $a<=mt_rand(2, 4); $a++)
            {
                $auth = new Author();
                $content = '<p>'.join($faker->paragraphs(2), '</p><p>').'</p>';
                $auth->setName($faker->name)
                    ->setImage($faker->imageUrl(300, 300))
                    ->setDescription($content);

                $manager->persist($auth);
                //now create between 3 and 6 articles ...
                for ($a=1; $a<=mt_rand(4, 6); $a++)
                {
                    $news = new News();

                    $content = '<p>'.join($faker->paragraphs(5), '</p><p>').'</p>';

                    $news->setTitle($faker->sentence)
                        ->setContent($content)
                        ->setImage($faker->imageUrl(250))
                        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                        ->setCategory($cat);

                    $manager->persist($news);
                }
            }
        }
        $manager->flush();
    }
}
