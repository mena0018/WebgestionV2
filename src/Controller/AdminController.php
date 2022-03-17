<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\MatiereGroupe;
use App\Form\GroupeFormType;
use App\Form\MatiereGroupeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/addGroupe', name: 'addGroupe')]
    public function addGroupe(Request $request, EntityManagerInterface $entityManager): Response
    {
        $groupe = new Groupe();
        $form = $this->createForm(GroupeFormType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($groupe);
            $groupeDejaExistant = $entityManager->getRepository(Groupe::class)->findOneBy(['libelle' => $groupe->getLibelle()]);
            if ($groupeDejaExistant){
                $this->addFlash('error', 'Groupe déja existant.');
            }
            else{
                $entityManager->flush();
                $this->addFlash('message', 'Groupe ajouté avec succès.');
            }
            return $this->redirectToRoute('addGroupe');
        }

        return $this->render('admin/addGroupe.html.twig', [
            'addGroupe' => $form->createView(),
        ]);
    }

    #[Route('/addMatiereGroupe', name: 'addMatiereGroupe')]
    public function addMatiereGroupe(Request $request, EntityManagerInterface $entityManager): Response
    {
        $matiereGroupe = new MatiereGroupe();
        $form = $this->createForm(MatiereGroupeFormType::class, $matiereGroupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($matiereGroupe);
            $groupeDejaExistant = $entityManager->getRepository(MatiereGroupe::class)->findOneBy(
                [
                    'groupe' => $matiereGroupe->getGroupe(),
                    'matiere' => $matiereGroupe->getMatiere()
                ]);
            if ($groupeDejaExistant){
                $this->addFlash('error', 'Le groupe possède déja cette matière.');
            }
            else{
                $entityManager->flush();
                $this->addFlash('message', 'Matière ajoutée avec succès au groupe.');
            }
            return $this->redirectToRoute('addMatiereGroupe');
        }

        return $this->render('admin/addMatiereGroupe.html.twig', [
            'addMatiereGroupe' => $form->createView(),
        ]);
    }
}
