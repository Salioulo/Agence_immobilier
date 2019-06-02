<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
//use Twig\Environment;

class HomeController extends AbstractController
{

    public function index(PropertyRepository $repository): Response
    {
        // affichage seulelemnt de 4 biens dans la pages function findlatest in repository
        $properties = $repository->findLatest();

        return $this->render('pages/home.html.twig',[
            'properties' => $properties
        ]);
    }
}