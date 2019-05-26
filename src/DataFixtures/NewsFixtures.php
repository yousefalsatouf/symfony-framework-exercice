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
        //create 3 fake categories
        for ($c=1; $c<=3; $c++)
        {
            $cat = new Category();
            $cat->setTitle($faker->sentence())
                ->setDescription($faker->paragraph());

            $manager->persist($cat);

            //now create between 3 and 6 articles ...
            for ($a=1; $a<=mt_rand(4, 6); $a++)
            {
                $prod = new News();

                $content = '<p>'.join($faker->paragraphs(5), '</p><p>').'</p>';

                $prod->setTitle($faker->sentence)
                    ->setContent($content)
                    ->setImage($faker->imageUrl(250))
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($cat);

                $manager->persist($prod);

                // create the comments ...
                for ($m=1; $m<=mt_rand(4, 10); $m++)
                {
                    $com = new Comment();
                    $content = '<p>'.join($faker->paragraphs(2), '</p><p>').'</p>';
                    $now = new \DateTime();
                    $interval = $now->diff($prod->getCreatedAt());
                    $days = $interval->days;
                    $min = '-'.$days.'days';

                    $com->setAuthor($faker->name)
                        ->setContent($content)
                        ->setCreatedAt($faker->dateTimeBetween($min))
                        ->setProduct($prod);

                    $manager->persist($com);
                }
            }
        }

        $manager->flush();
    }
}
