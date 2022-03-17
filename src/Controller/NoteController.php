<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\Note;
use App\Entity\Matiere;
use App\Form\NoteFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/note')]
class NoteController extends AbstractController
{
    #[Route('/bulletin', name: 'noteBulletin')]
    public function noteBulletin(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Note::class);
        $notesUser = $repository->findBy([], ['id'=> 'ASC']);
        $repository = $doctrine->getRepository(Matiere::class);
        $matiere = $repository->findBy([], ['id'=> 'ASC']);


        return $this->render('note/noteBulletin.html.twig', [
            'notesUser' => $notesUser,
            'matiere' => $matiere,
        ]);

    }

    #[Route('/add', name: 'addNote')]
    public function addNote(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Note::class);
        $notes = $repository->findBy([], ['id'=> 'DESC'], 5);

        $note = new Note();
        $form = $this->createForm(NoteFormType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($note);
            $entityManager->flush();
            $this->addFlash('message', 'Note ajouté avec succès');
            return $this->redirectToRoute('addNote');
        }

        return $this->render('note/addNote.html.twig', [
            'noteForm' => $form->createView(),
            'notes' => $notes,
        ]);
    }

    #[Route('/delete/{id}', name: 'deleteNote')]
    public function deleteNote(ManagerRegistry $doctrine, Note $note = null): RedirectResponse
    {
        if ($note) {
            $manager = $doctrine->getManager();
            $manager->remove($note);
            $manager->flush();
            $this->addFlash('success', "Note supprimé avec succès");
        } else {
            $this->addFlash('error', "Note inexistante");
        }
        return $this->redirectToRoute('addNote');
    }
}
