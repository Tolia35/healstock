<?php
namespace App\Controller;

use App\Entity\Checklist;
use App\Entity\Item;
use App\Form\ChecklistType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChecklistController extends AbstractController
{

    /**
     * @Route("/checklist/new", name="checklist_new")
     */public function new(Request $request)
{
    $article = new Checklist();
    $form = $this->createForm(ChecklistType::class);

    if ($request->isMethod('POST')) {
        $form->submit($request->request->get($form->getName()));

        if ($form->isSubmitted() && $form->isValid()) {
            // perform some action...

            return $this->redirectToRoute('checklist_show');
        }
    }

    return $this->render('checklist/new.html.twig', [
        'form' => $form->createView(),
    ]);
}

    /**
     * @Route("/checklist/{id}", name="checklist_show", methods={"GET"})
     */
    public function show(Checklist $checklist)
    {
        $items = $this->getDoctrine()->getRepository(Item::class)->findAll();
        return $this->render('checklist/show.html.twig', [
            'checklist' => $checklist,
            'items' => $items
        ]);
    }

}