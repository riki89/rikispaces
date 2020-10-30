<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use App\Repository\PropertyRepository;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
    */
    private $repository;

    public function __construct(PropertyRepository $repository){
        $this->repository = $repository;
    }

    /**
     * @Route("/biens", name="property.index")
     * Return Response
     */

    public function index(PropertyRepository $repository): Response
    {
        /*
        $property = new Property();
        $property->setTitle('Mon premier bien')
                ->setPrice(20000)
                ->setRooms(4)
                ->setBedRooms(12)
                ->setPostalCode('11000')
                ->setSurface(2)
                ->setFloor(4)
                ->setHeat(1)
                ->setCity("Montpellier")
                ->setAdress("Monn adress")
                ->setPostalCode("11000")
                ;
        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();
        */
        //$repository = $this->getDoctrine()->getRepository(Property::class);
        $repository = $this->repository->findById(1);
        //dump($repository);

        return $this->render('pages/home.html.twig', [
            'properties'=> $repository
        ]);
        //return new Response('Les biens');
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
     * Return Response
     */
    public function show(Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug) {
            # code...
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug'=> $property->getSlug()
            ], 301);
        }
      return $this->render('property/show.html.twig', [
          'property'=> $property,
          'current_menu'=> 'properties'
      ]);
    }
}