<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends AbstractController
{
    /**
     * @Route("/faq", name="faq"))
     */
    public function index(): Response
    {
        return $this->render('faq/faq.html.twig', [
            'controller_name' => 'FaqController',
        ]);
    }

}