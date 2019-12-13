<?php
namespace App\Controller;
use App\Entity\Checklist;
use App\Entity\Checklistitem;
use App\Entity\Item;
use App\Form\ChecklistType;
use App\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class ChecklistItemController extends AbstractController
{
    /**
     * @Route("/checklist/{id}/item/new", name="checklistitem_new")
     */
    public function new(Checklist $checklist, Request $request)
    {
        $item = new Item();

        $form = $this->createForm(ItemType::class, $item);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $this->addFlash('success', 'Votre produit est ajouté !');

            $em = $this->getDoctrine()->getManager();

            $bddItem = $em->getRepository(Item::class)->findOneByReference($item->getReference());
            $checklistItem = new Checklistitem();
            $checklistItem->setChecklist($checklist);
            $checklistItem->setIsClosed(false);
            if ($bddItem) {
                $checklistItem->setItem($bddItem);
            } else {
                $checklistItem->setItem($item);
                $em->persist($item);
            }

            $em->persist($checklistItem);
            $em->flush();

            return $this->redirectToRoute('checklist_show_new', ['id' => $checklist->getId()]);
        }

        return $this->render('item/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/checklist/shownew/{id}", name="checklistitem_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Checklistitem $checklistitem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$checklistitem->getId(), $request->request->get('_token'))) {
            $this->addFlash('successdelete', 'Votre produit est supprimé !');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($checklistitem);
            $entityManager->flush();
        }
        return $this->redirectToRoute('checklist_show_new');
    }



    /**
     * @Route("/checklist/{id}", name="checklistitem_update", methods={"GET", "POST"})
     */
    public function edit(Checklistitem $checklistitem, Request $request)
    {
        $form = $this->createForm(ChecklistitemType::class, $checklistitem);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($checklistitem);
            $em->flush();
            return $this->redirectToRoute("checklist/show.html.twig");
        }
        return $this->render('checklist/show.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

