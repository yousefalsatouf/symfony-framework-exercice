<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/authors", name="authors")
     */
    public function authors()
    {
        return $this->render('author/authors.html.twig', [
            'title' => 'Authors'
        ]);
    }
    /**
     * @Route("/author", name="author")
     */
    public function author()
    {
        return $this->render('author/author.html.twig', [
            'title'=> "About this Author"
        ]);
    }
}
