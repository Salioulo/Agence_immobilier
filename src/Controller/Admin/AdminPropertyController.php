<?php
namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use App\Form\PropertyType;
use App\Entity\Property;


class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    // la methode compact rnvoie un tableau de properties raccourci
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Créer avec succee');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView() 
        ]);
    }

    /**
     * @param Property $property
     */
    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() )
        {
            $this->em->flush();
            $this->addFlash('success', 'Editer avec succee');
            return $this->redirectToRoute('admin.property.index');
        }
        
        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView() 
        ]);
    }
/* verification de la validite du token avec l'id 
    et le token grace request
*/
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token') ))
        {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('Success', 'Supprimer avec succee');
        }

        return $this->redirectToRoute('admin.property.index');

    }

}