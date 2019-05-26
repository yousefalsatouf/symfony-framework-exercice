<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/authors.html.twig', [
            'title'=> 'Home'
        ]);
    }
    /**
     * @Route("/news", name="news")
     */
    public function news(NewsRepository $repo)
    {
        //replace by NewsRepository $repo =>
        //$repo = $this->getDoctrine()->getRepository(News::class);
        $news = $repo->findAll();

        return $this->render('blog/news.html.twig', [
           'title'=> 'News',
            'news'=> $news
        ]);
    }
    /**
     * @Route("/news/{id}", name="oneNew")
     */
    public function oneNews(News $news)
    {
        //symfony does understand to find the id correspond with the right article ...
        //$repo = $this->getDoctrine()->getRepository(News::class);
        //$news = $repo->find($id);
        return $this->render('blog/oneNews.html.twig', [
            'title'=> 'One News',
            'new'=> $news
        ]);
    }
    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('blog/about.html.twig', [
            'title'=> 'About'
        ]);
    }
}