<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;


class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

  public function __construct(PropertyRepository $repository, ObjectManager $em )
  {
     $this->repository = $repository;
     $this->em = $em;
  }
    //affichage des biens visible non vendu function repository 
    public function index(PaginatorInterface $paginator, Request $request ): Response
    { 
        //$repos = $this->getDoctrine()->getRepository(Property::class);
        //$property = $this->$repos->findAllVisibleQuery();
        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
        2
    );
        
          
        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties',
            'properties' => $properties
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