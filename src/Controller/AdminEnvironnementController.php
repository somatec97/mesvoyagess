<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;

use App\Entity\Environnement;
use App\Repository\EnvironnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


/**
 * Description of AdminEnvironnementController
 *
 * @author BEN BAHA
 */
class AdminEnvironnementController extends AbstractController{
    /**
     * 
     * @param EnvironnementRepository $repository
     */
    public function __construct(EnvironnementRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * @Route("/amin/environnements", name="admin.environnements")
     * @return Response
     */
    public function index(): Response {
        $environnements = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return$this->render("admin/admin.environnements.html.twig", [
            'environnements' => $environnements
        ]);
        
    }
    /**
     * @Route("/admin/environnement/suppr/{id}", name="admin.environnement.suppr")
     * @param Environnement $environnemnt
     * @return Response
     */
     public function suppr(Environnement $environnemnt):Response {
        $this->repository->remove($environnemnt, true);
        return $this->redirectToRoute('admin.voyages');
        
    }
    /**
     * @Route("/admin/environnement/ajout", name="admin.environnement.ajout")
     * @param Request $request
     * @return Response
     */
    
    public function ajout(Request $request): Response {
        $nomEnvironnement = $request->get("nom");
        $environnement = new Environnement();
        $environnement->setNom($nomEnvironnement);
        $this->repository->add($environnement, true);
        return $this->redirectToRoute('admin.environnements');
        
    }
}
