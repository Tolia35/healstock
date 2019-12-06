<?php
namespace App\Controller;
use App\Entity\Checklist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="user_profile")
     */
    public function index()
    {
        $checklists = $this->getDoctrine()->getRepository(Checklist::class)->findAll();
        return $this->render('user/profile.html.twig', [
            "checklists" => $checklists
        ]);
    }

}