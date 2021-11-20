<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin_dashboard_show")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
