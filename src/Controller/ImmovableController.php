<?php

namespace App\Controller;

use App\Entity\Immovable;
use App\Entity\PropertySearch;
use App\Form\ImmovableType;
use App\Form\PropertySearchType;
use App\Repository\ImmovableRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ImmovableController extends AbstractController
{
    /**
     * @Route("/tous-les-biens", name="immovable_index", methods={"GET"})
     * @param ImmovableRepository $immovableRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(ImmovableRepository $immovableRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('immovable/index.html.twig', [
            'form' => $form->createView(),
            'immovables' => $paginator->paginate($immovableRepository->findAllWithPaginator(),
            $request->query->getInt('page', 1),12)
        ]);
    }

    /**
     * @Route("/location", name="locations_index")
     */
    public function indexLocations(ImmovableRepository $immovableRepository, Request $request, PaginatorInterface $paginator)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('immovable/index.html.twig', [
            'form' => $form->createView(),
            'immovables' => $paginator->paginate($immovableRepository->findByPrestationVisibleQuery($search,'location'),
                $request->query->getInt('page', 1),12)
        ]);
    }

    /**
     * @Route("/vente", name="sales_index")
     */
    public function indexSales(ImmovableRepository $immovableRepository, Request $request, PaginatorInterface $paginator)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        return $this->render('immovable/index.html.twig', [
            'form' => $form->createView(),
            'immovables' => $paginator->paginate($immovableRepository->findByPrestationVisibleQuery($search,'vente'),
                $request->query->getInt('page', 1),12)
        ]);
    }

    /**
     * @Route("/new", name="immovable_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $immovable = new Immovable();
        $form = $this->createForm(ImmovableType::class, $immovable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($immovable);
            $entityManager->flush();

            return $this->redirectToRoute('immovable_index');
        }

        return $this->render('immovable/new.html.twig', [
            'immovable' => $immovable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{prestation}/{slug}-{id}", name="immovable_show", requirements={"slug": "[a-z0-9\-]*", "prestation": "[a-z0-9\-]*"}, methods={"GET"})
     * @param Immovable $immovable
     * @param string $slug
     * @return Response
     */
    public function show(Immovable $immovable, string $slug, string $prestation): Response
    {
        if($immovable->getSlug() !== $slug){
            return $this->redirectToRoute('immovable_show', [
                'id' => $immovable->getId(),
                'slug' => $immovable->getSlug(),
                'prestation' => $immovable->getPrestation()
            ], 301);
        }

        if($immovable->getPrestation() !== $prestation){
            return $this->redirectToRoute('immovable_show', [
                'id' => $immovable->getId(),
                'slug' => $immovable->getSlug(),
                'prestation' => $immovable->getPrestation()
            ], 301);
        }

        return $this->render('immovable/show.html.twig', [
            'immovable' => $immovable,
        ]);
    }

    /**
     * @Route("/{prestation}/{slug}-{id}/edit", name="immovable_edit", requirements={"slug": "[a-z0-9\-]*","prestation": "[a-z0-9\-]*"}, methods={"GET","POST"})
     * @param Request $request
     * @param Immovable $immovable
     * @param string $slug
     * @return Response
     */
    public function edit(Request $request, Immovable $immovable, string $slug): Response
    {
        if($immovable->getSlug() !== $slug){
            return $this->redirectToRoute('immovable_edit', [
                'id' => $immovable->getId(),
                'slug' => $immovable->getSlug()
            ], 301);
        }

        $form = $this->createForm(ImmovableType::class, $immovable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('immovable_index');
        }

        return $this->render('immovable/edit.html.twig', [
            'immovable' => $immovable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{{slug}-{id}}", name="immovable_delete", requirements={"slug": "[a-z0-9\-]*"}, methods={"DELETE"})
     * @param Request $request
     * @param Immovable $immovable
     * @return Response
     */
    public function delete(Request $request, Immovable $immovable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$immovable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($immovable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('immovable_index');
    }
}
