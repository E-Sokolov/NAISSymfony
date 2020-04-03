<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        $calendar = date('m',mktime(0,0,0,date('m',time())+1,0,date('Y',time())));
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'calendar' => $calendar
        ]);
    }
    /**
     * @Route("/user/migrate", name="userMigrate")
     */
    /*
    public function migrateUser()
    {
        $conn = $this->getDoctrine()->getConnection('glb');
        $q = 'SELECT * FROM users_old';
        $res = $conn -> prepare($q);
        $res -> execute();
        $users_old = $res -> fetchAll();


        $entity = $this->getDoctrine()->getManager('glb');
        foreach ($users_old as $olduser)
        {
            $users = new Users();
            if(!empty($olduser['birthday']))
            {
                $new_birthday = new \DateTime('@'.strtotime($olduser['birthday']));
            }
            if(!empty($olduser['jobday']))
            {
                $new_jobday = new \DateTime('@'.strtotime($olduser['jobday']));
            }

            $users -> setFilial($olduser['filial']);
            $users -> setShortName($olduser['short_name']);
            $users -> setFullName($olduser['full_name']);
            $users -> setBirthday($new_birthday);
            $users -> setJobday($new_jobday);
            $users ->setLevelAccess($olduser['level_access']);
            $users -> setPosition($olduser['position']);
            $users -> setEmail($olduser['email']);
            $users -> setPhone($olduser['phone']);
            $users -> setVphone($olduser['vphone']);
            $users -> setDep($olduser['dep']);
            $users -> setLogin($olduser['login']);
            $users -> setPassword($olduser['pass']);
            $users -> setAvatar($olduser['avatar']);

            $entity -> persist($users);
            $entity -> flush();
        }
        return new Response('Saved new user with id '.$users->getId());
    }*/
}
