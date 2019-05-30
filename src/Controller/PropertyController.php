<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use Symfony\Component\HttpFoundation\RedirectResponse;




class PropertyController extends AbstractController
{
  
    public function index(): Response
    { 
        $repos = $this->getDoctrine()->getRepository(Property::class);
        $property = $repos->findAllVisible();

        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @param Property $property
     */
    public function show(Property $property, $id, string $slug): Response
    {
        if ($property->getSlug() !== $slug)
        {
            $this->redirectToRoute('property.show',[
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