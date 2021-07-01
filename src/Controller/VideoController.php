<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    /**
     * @Route("/video/{id}", name="video")
     */
    public function index(Video $video, VideoRepository $videoRepository): Response
    {
        dump($video);

        // SELECT * FROM video;
        $videos = $videoRepository->findByHome();

        return $this->render('video/index.html.twig', [
            'videos' => $videos,
            'video' => $video,
        ]);
    }

}
