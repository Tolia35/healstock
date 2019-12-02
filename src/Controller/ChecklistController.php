<?php
namespace App\Controller;
use App\Entity\Checklist;
use App\Entity\Checklistitem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class ChecklistController extends AbstractController
{
    /**
     * @Route("/checklist", name="checklist_show", methods={"GET"})
     */
    public function show(Checklist $checklist)
    {
        $ids = $this->getDoctrine()->getRepository(Id::class)->findBy(['checklist' => $checklist], ['createdAt' => 'DESC']);
        return $this->render('checklist/show.html.twig', [
            'checklist' => $checklist,
        ]);
    }
}