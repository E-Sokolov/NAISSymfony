<?php

namespace App\Controller;

use App\Entity\ClientType;
use App\Entity\Resource;
use App\Entity\Calls;
use App\Entity\Users;

use App\Form\CallsSearchFormType;
use Doctrine\ORM\Tools\Pagination\Paginator;
use phpDocumentor\Reflection\Types\String_;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
        $filter = (isset($_POST['calls_search_form'])) ? $_POST['calls_search_form']: array();
        $calendar = date('m',mktime(0,0,0,date('m',time())+1,0,date('Y',time())));
        /* get data from db */
        $calls = $this -> getDoctrine()->getRepository(Calls::class)->getFilteredCalls($filter);

        $resource = $this -> getDoctrine() -> getRepository(Resource::class)->findAll();
        $clientType = $this -> getDoctrine() -> getRepository(ClientType::class)->findAll();
        $users = $this -> getDoctrine() -> getRepository(Users::class) -> findAll();
        /* set array by data from another tables */
        foreach ($calls as $call){
            $resourceEl = $resource[$call ->getResource() -1];
            $resourceArr[$call ->getResource()] = $resourceEl ->getResource();
            $clientTypeEl = $clientType[$call->getClientType() -2];
            $clientTypeArr[$call ->getClientType()] = $clientTypeEl -> getType();
            $userEl = $users[$call->getIngeneer()];
            $userArr[$call ->getIngeneer()] = $userEl -> getShortName();
        }
        /* get search form from /src/Form/CallsSearchFormType.php */

        $searchForm = $this -> createForm(CallsSearchFormType::class,$callsObj);
        

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
        $callObj = new Calls;
        $addForm = $this ->createForm(\App\Form\AddCallType::class,$callObj);
        /* if get data from form */
        $errors = array();
        if(isset($_POST['add_call']))
        {
            //print_r($errors);
            $errors = $this ->getDoctrine()->getRepository(Calls::class)->addCall($_POST['add_call']);
            if(count($errors) == 0){
                return $this ->redirectToRoute('calls');
            }
        }
        return $this->render('calls/add.html.twig', [
            'controller_name' => 'CallsController',
            'addForm'=> $addForm ->createView(),
            'errors' => $errors
        ]);
    }
    /**
     * @Route("/calls/autocomplete/[col]/[q]")
     * Generete pdge for jQuery Autocomplete
     */
    function autocomplete()
    {
        
        return $this->render('calls/autocomlete.html.twig');
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
            $telCodes = ['048','097','068','067','093','063','066','094','050'];
            foreach ($telCodes as $needle){
                $str = preg_replace("/[^0-9]/", '',$oldcall['etc_data']);
                echo $str.' - ';
                $phone = strstr($str,$needle);
                echo $phone.'<br>';
                if($phone != ''){
                    break;
                }
            }

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
    */
}
