<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController {
    #[Route("/")]
    public function indexNoLocale(): Response {
        return $this->redirectToRoute("index", ["_locale" => "fr"]);

    }

    #[Route("/{_locale<%locales%>}/", name: "index")]
    public function index(): Response {
        $now = new DateTime();
        return $this->render('index.html.twig', ['name' => "aaa", "number" => $now->getTimestamp()]);
    }
}