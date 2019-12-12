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
     */
    public function new(Request $request)
    {
        $checklist = new Checklist();

        $form = $this->createForm(ChecklistType::class, $checklist);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $checklist = $form->getData();
            $this->addFlash('successchecklist', 'Votre Liste est transmise !');

            $em = $this->getDoctrine()->getManager();
            $em->persist($checklist);
            $em->flush();

            return $this->redirectToRoute('checklist_show_new', ['id' => $checklist->getId()]);
        }

        return $this->render('checklist/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/checklist/shownew/{id}", name="checklist_show_new", methods={"GET"})
     */
    public function shownew(Checklist $checklist)
    {
        return $this->render('checklist/show.new.html.twig', [
            'checklist' => $checklist
        ]);
    }
    /**
     * @Route("/checklist/{id}", name="checklist_show", methods={"GET"})
     */
    public function show(Checklist $checklist)
    {
        return $this->render('checklist/show.html.twig', [
            'checklist' => $checklist
        ]);
    }

}