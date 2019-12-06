<?php
namespace App\Controller;
use App\Entity\Checklist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $checklists = $this->getDoctrine()->getRepository(Checklist::class)->findAll();
        /* dump($checklist); */
        return $this->render('default/homepage.html.twig',  [
            "checklists" => $checklists
        ]);
    }

}