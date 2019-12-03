<?php
namespace App\Controller;

use App\Entity\Checklist;
use App\Entity\Item;
use App\Form\ItemType;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    /**
     * @Route("/item", name="item_index", methods={"GET"})
     */
    public function index(ItemRepository $itemRepository): Response
    {
        return $this->render('item/index.html.twig', [
            'items' => $itemRepository->findAll(),
        ]);
    }
    /**
     * @Route("/{id}/new", name="item_new", methods={"GET","POST"})
     */
    public function new(Checklist $checklist, Request $request): Response
    {
        $item = new Item();
        $actionUrl = $this->generateUrl('item_new', ['id' => $checklist->getId()]);
        $form = $this->createForm(ItemType::class, $item, ['action' => $actionUrl]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $item->setChecklist($checklist);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($item);
            $entityManager->flush();
            return $this->redirectToRoute('item_show', ['id' => $checklist->getId()]);
        }
        return $this->render('checklist/new.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="item_show", methods={"GET"})
     */
    public function show(Item $item): Response
    {
        return $this->render('item/show.html.twig', [
            'item' => $item,
        ]);
    }
    /**
     * @Route("/{id}/edit", name="item_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Item $item): Response
    {
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('item_index', [
                'id' => $item->getId(),
            ]);
        }
        return $this->render('item/edit.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="item_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Item $item): Response
    {
        if ($this->isCsrfTokenValid('delete'.$item->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($item);
            $entityManager->flush();
        }
        return $this->redirectToRoute('item_index');
    }
}