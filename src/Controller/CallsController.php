<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Calls;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;

class CallsController extends AbstractController
{
    /**
     * @Route("/calls", name="calls")
     */
    public function index()
    {
        $calendar = date('m',mktime(0,0,0,date('m',time())+1,0,date('Y',time())));
        $calls = $this -> getDoctrine()->getRepository(Calls::class)->findBy(array(),array('date' => 'DESC'));
        return $this->render('calls/index.html.twig', [
            'controller_name' => 'CallsController',
            'calendar' => $calendar,
            'calls' => $calls
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
    /**
     * @Route("/calls/migrate", name="callsMigrate")
     */
    public function callsOld()
    {
        $conn = $this->getDoctrine()->getConnection('od');
        $q = 'SELECT * FROM calls_old';
        $res = $conn -> prepare($q);
        $res -> execute();
        $calls_old = $res -> fetchAll();


        $entity = $this->getDoctrine()->getManager('od');
        foreach ($calls_old as $oldcall)
        {
            $calls = new Calls();
            $phone = strstr($oldcall['etc_data'],'048');
            $newdate = new \DateTime('@'.strtotime($oldcall['date'].' '.$oldcall['time']));
            if(!empty($oldcall['date_success']))
            {
                $new_date_success = new \DateTime('@'.strtotime($oldcall['date_success']));
            }
            if($oldcall['service'] == 'Так')
            {
                $service = 1;
            }else{
                $service = 0;
            }
            if($oldcall['trip'] == 'Так')
            {
                $trip = 1;
            }else{
                $trip = 0;
            }

           $calls -> setRegion($oldcall['region']);
           $calls -> setStatus($oldcall['status']);
           $calls -> setDate($newdate);
           $calls -> setType($oldcall['type']);
           $calls -> setClientType($oldcall['client_type']);
           $calls -> setClient($oldcall['client']);
           $calls -> setFio($oldcall['fio']);
           $calls -> setResource($oldcall['resource']);
           $calls -> setDescription($oldcall['description']);
           $calls -> setWhatToDo($oldcall['what_to_do']);
           $calls -> setIngeneer($oldcall['ingeneer']);
           $calls -> setDateSuccess($new_date_success);
           $calls -> setService($service);
           $calls -> setTrip($trip);
           $calls -> setEtcData($oldcall['etc_data']);
           $calls -> setPhone($phone);
            $entity -> persist($calls);
            $entity -> flush();
        }
        return new Response('Saved new product with id '.$calls->getId());
    }
}
