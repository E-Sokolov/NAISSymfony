<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Modules;
class SiteController extends AbstractController
{
    /**
     * @Route("/", name="siteIndex")
     */
    public function index()
    {
        $modules = $this -> getDoctrine()->getRepository(Modules::class)->findAll();
        $calendar = date('m',mktime(0,0,0,date('m',time())+1,0,date('Y',time())));
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'calendar' => $calendar,
            'modules' =>$modules
        ]);
    }
}
