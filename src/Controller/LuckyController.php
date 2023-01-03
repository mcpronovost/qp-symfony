<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class LuckyController extends AbstractController {
    #[Route('/{_locale}/lucky', name: 'lucky_number')]
    public function index(TranslatorInterface $translator, $locales, $defaultLocale) {
        $name = $translator->trans("Luckynumber");
        return $this->render('index.html.twig', ['name' => $name, "number" => 34987543587]);
    }
}
