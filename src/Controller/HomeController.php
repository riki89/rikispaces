<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController {

    /**
    * @var Environement
    */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function index(): Response
    {
        //return new Response("Salut les gens");
        return new Response($this->twig->render('pages/home.html.twig'));
    }
}
