<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    #[Route('/', name: 'report_home', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/about', name: 'report_about', methods: ['GET'])]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route('/report', name: 'report_report', methods: ['GET'])]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }
}
