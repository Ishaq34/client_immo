<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\ImmovableRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ImmovableRepository $immovableRepository, Request $request, PaginatorInterface $paginator)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'immovables' => $paginator->paginate($immovableRepository->findAllVisibleQuery($search),
                $request->query->getInt('page', 1),12),
            'controller_name' => 'HomeController',
        ]);
    }
}
