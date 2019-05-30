<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;


class PropertyController extends AbstractController
{
    public function index(): Response
    { 
        $repo = $this->getDoctrine()->getRepository(Property::class);
        $property = $repo->findAllVisible();

        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties'
        ]);
    }
}