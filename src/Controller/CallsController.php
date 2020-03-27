<?php

namespace App\Controller;

use App\Entity\ClientType;
use App\Entity\Resource;
//use Doctrine\DBAL\Types\DateType;
use App\Repository\UsersRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Calls;
use App\Entity\Users;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CallsController extends AbstractController
{
    /**
     * @Route("/calls", name="calls")
     */
    public function index()
    {
        $callsObj = new Calls;
        $resourceArr = array();
        $clientTypeArr = array();
        $userArr = array();
        $calendar = date('m',mktime(0,0,0,date('m',time())+1,0,date('Y',time())));
        $calls = $this -> getDoctrine()->getRepository(Calls::class)->findBy(array(),array('date' => 'DESC'));
        $resource = $this -> getDoctrine() -> getRepository(Resource::class)->findAll();
        $clientType = $this -> getDoctrine() -> getRepository(ClientType::class)->findAll();
        $users = $this -> getDoctrine() -> getRepository(Users::class) -> findAll();
        $searchForm = $this -> createFormBuilder($callsObj)
                                    ->add('date',HiddenType::class,
                                        [
                                            'required' =>false,
                                            'attr' => ['class'=>'form-control']
                                        ])
                                    ->add('clientType', EntityType::class,
                                        [
                                        'class' => clientType::class,
                                        'label' => 'Тип',
                                        'choice_label' => 'type',
                                        'required' =>false,
                                        'attr' => ['class'=>'form-control']
                                        ])
                                    ->add('client',TextType::class,
                                        [
                                            'label' => 'Заявитель','required' =>false,
                                            'attr' => ['class'=>'form-control']
                                        ])
                                    ->add('fio',TextType::class,
                                        [
                                            'label' => 'Ф.И.О',
                                            'required' =>false,
                                            'attr' => ['class'=>'form-control']
                                        ])
                                    ->add('resource', EntityType::class,
                                        [
                                        'class' => Resource::class,
                                        'label' => 'Реестр',
                                        'choice_label'=> 'resource',
                                        'required' =>false,
                                         'attr' => ['class'=>'form-control']
                                    ])
                                    ->add('description',TextType::class,
                                        [
                                            'label' => 'Описание',
                                            'required' =>false,
                                            'attr' => ['class'=>'form-control']
                                        ])
                                    ->add('what_to_do',TextType::class,
                                        ['label' => 'Что сделано',
                                            'required' =>false,
                                            'attr' => ['class'=>'form-control']
                                        ])
                                    ->add('ingeneer',EntityType::class,
                                        [
                                        'class' => Users::class,
                                        'label' => 'Исполнитель',
                                        'query_builder' => function (UsersRepository $usr) {
                                            return $usr->createQueryBuilder('u')
                                                ->where('u.dep=\'ing\'')
                                                ->andWhere('u.password != \'fired\'');
                                        },
                                        'choice_label' => 'short_name',
                                        'required' =>false,
                                        'attr' => ['class'=>'form-control']
                                    ])
                                    ->add('etc_data', TextType::class,
                                        [
                                            'label' => 'Дополнительно',
                                            'required' =>false,
                                            'attr' => ['class'=>'form-control']
                                        ])
                                    ->add('status', CheckboxType::class,
                                        [
                                            'required' =>false,
                                            'attr' => ['class'=>'form-control'],
                                            'label' => 'Актуальные'
                                        ])
                                    ->add('submit',SubmitType::class,
                                        [
                                            'label'=> 'Поиск',
                                            'attr' => ['class'=>'form-control']
                                        ])
                                    ->getForm();
        var_dump($_POST);
        foreach ($calls as $call){
            $resourceEl = $resource[$call ->getResource() -1];
            $resourceArr[$call ->getResource()] = $resourceEl ->getResource();
            $clientTypeEl = $clientType[$call->getClientType() -2];
            $clientTypeArr[$call ->getClientType()] = $clientTypeEl -> getType();
            $userEl = $users[$call->getIngeneer() -1];
            $userArr[$call ->getIngeneer()] = $userEl -> getShortName();
        }
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
        return new Response('Saved new call with id '.$calls->getId());
    }
}
