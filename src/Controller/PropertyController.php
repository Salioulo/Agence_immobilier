<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use Symfony\Component\HttpFoundation\RedirectResponse;


class PropertyController extends AbstractController
{
  
    //affichage des biens visible non vendu function repository
    public function index(): Response
    { 
        $repos = $this->getDoctrine()->getRepository(Property::class);
        $property = $repos->findAllVisible();

        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties',
            'property' => $property
        ]);
    }

    /**
     * @param Property $property
     */
    public function show(Property $property, $id, string $slug): Response
    {
        if ($property->getSlug() !== $slug)
        {
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug'=> $property->getSlug()
            ],301);
        }
        $repo = $this->getDoctrine()->getRepository(Property::class);
        $property = $repo->find($id);

        return $this->render('property/show.html.twig',[
            'current_menu' => 'properties',
            'property' => $property
        ]);
    }
}