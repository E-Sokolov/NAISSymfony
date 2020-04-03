<?php

namespace App\Controller;

use App\Entity\ClientType;
use App\Entity\Resource;
use App\Entity\Calls;
use App\Entity\Users;

use App\Form\CallsSearchFormType;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CallsController extends AbstractController
{
    /**
     * @Route("/calls", name="calls")
     *
     * Main page of Calls
     */
    public function index()
    {
        /* set variables and object */
        $callsObj = new Calls;
        $resourceArr = array();
        $clientTypeArr = array();
        $userArr = array();

        $calendar = date('m',mktime(0,0,0,date('m',time())+1,0,date('Y',time())));
        /* get data from db */
        $calls = $this -> getDoctrine()->getRepository(Calls::class)->findBy(array(),array('date' => 'DESC'));
        $paginator = new Paginator($calls);
        var_dump($paginator);
        $resource = $this -> getDoctrine() -> getRepository(Resource::class)->findAll();
        $clientType = $this -> getDoctrine() -> getRepository(ClientType::class)->findAll();
        $users = $this -> getDoctrine() -> getRepository(Users::class) -> findAll();
        /* set array by data from another tables */
        foreach ($calls as $call){
            $resourceEl = $resource[$call ->getResource() -1];
            $resourceArr[$call ->getResource()] = $resourceEl ->getResource();
            $clientTypeEl = $clientType[$call->getClientType() -2];
            $clientTypeArr[$call ->getClientType()] = $clientTypeEl -> getType();
            $userEl = $users[$call->getIngeneer()+1];
            $userArr[$call ->getIngeneer()] = $userEl -> getShortName();

            if(isset($_POST)){
               if($_POST['calls_search_form']['clientType'] == $clientTypeEl->getId())
               {
                   $callsObj-> setClientType($clientTypeEl->getId());
               }
            }

        }
        /* get search form from /src/Form/CallsSearchFormType.php */
        //var_dump($clientType);
        //var_dump($callsObj);
        $searchForm = $this -> createForm(CallsSearchFormType::class,$callsObj);
        //var_dump($_POST);
        /* return data to calls/index template */
        return $this->render('calls/index.html.twig', [
            'controller_name' => 'CallsController',
            'calendar' => $calendar,
            'calls' => $calls,
            'resource' => $resourceArr,
            'clientType' => $clientTypeArr,
            'user' => $userArr,
            'searchForm' => $searchForm -> createView()
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
     *
     * function for migrate calls from old version of app
     * need to create table with old data
     */
    /*
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
        return new Response('Saved new call with id '.$calls->getId());
    }*/
}
