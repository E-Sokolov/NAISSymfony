<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CallsController extends AbstractController
{
    /**
     * @Route("/calls", name="calls")
     */
    public function index()
    {
        return $this->render('calls/index.html.twig', [
            'controller_name' => 'CallsController',
        ]);
    }
    /**
     * @Route("/calls/add", name="callsAdd")
     */
    public function add()
    {
        return $this->render('calls/add.html.twig', [
            'controller_name' => 'CallsController',
        ]);
    }
}
