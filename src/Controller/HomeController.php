<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */

    public function index(VideoRepository $videoRepository): Response
    {

        // SELECT * FROM video;
        $videos = $videoRepository->findByHome();

        return $this->render('home/index.html.twig', [
            'videos' => $videos,
        ]);
    }
}
