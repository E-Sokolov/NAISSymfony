<?php

namespace App\Form;

use App\Entity\Calls;
use App\Entity\ClientType;
use App\Entity\Resource;
use App\Entity\Users;
use App\Repository\UsersRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CallsSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        var_dump($options);
        $builder
            ->add('date',HiddenType::class,
            [
                'required' =>false,
                'attr' => ['class'=>'form-control','value' => (isset($_POST['calls_search_form']['date'])) ? $_POST['calls_search_form']['date']:'']
            ])
            ->add('clientType', EntityType::class,
            [
                'class' => clientType::class,
                'label' => 'Тип',
                'choice_label' => 'type',
                'required' =>false,
                'attr' => ['class'=>'form-control', 'value' => (isset($_POST['calls_search_form']['clientType'])) ? $_POST['calls_search_form']['clientType']:''],
                'choice_value' => $options['data'] -> getClientType($_POST['calls_search_form']['clientType'])
            ])
        ->add('client',TextType::class,
            [
                'label' => 'Заявитель','required' =>false,
                'attr' => ['class'=>'form-control','value' => (isset($_POST['calls_search_form']['client'])) ? $_POST['calls_search_form']['client']:'']
            ])
        ->add('fio',TextType::class,
            [
                'label' => 'Ф.И.О',
                'required' =>false,
                'attr' => ['class'=>'form-control','value' =>(isset( $_POST['calls_search_form']['fio'])) ?  $_POST['calls_search_form']['fio']:'']
            ])
        ->add('resource', EntityType::class,
            [
                'class' => Resource::class,
                'label' => 'Реестр',
                'choice_label'=> 'resource',
                'required' =>false,
                'attr' => ['class'=>'form-control','value' => (isset( $_POST['calls_search_form']['resource'])) ?  $_POST['calls_search_form']['resource']:'']
            ])
        ->add('description',TextType::class,
            [
                'label' => 'Описание',
                'required' =>false,
                'attr' => ['class'=>'form-control','value' => (isset( $_POST['calls_search_form']['description'])) ?  $_POST['calls_search_form']['description']:'']
            ])
        ->add('what_to_do',TextType::class,
            [
                'label' => 'Что сделано',
                'required' =>false,
                'attr' => ['class'=>'form-control','value' => (isset( $_POST['calls_search_form']['what_to_do'])) ?  $_POST['calls_search_form']['what_to_do']:'']
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
                'attr' => ['class'=>'form-control','value' => (isset( $_POST['calls_search_form']['ingeneer'])) ?  $_POST['calls_search_form']['ingeneer']:'']
            ])
        ->add('etc_data', TextType::class,
            [
                'label' => 'Дополнительно',
                'required' =>false,
                'attr' => ['class'=>'form-control',
                            'value' => (isset( $_POST['calls_search_form']['etc_data'])) ?  $_POST['calls_search_form']['etc_data']:'']
            ])
        ->add('status', CheckboxType::class,
            [
                'required' =>false,
                'attr' => ['class'=>'form-control',
                            'value' => (isset( $_POST['calls_search_form']['status'])) ?  '1':'0',
                            'data' => (isset( $_POST['calls_search_form']['status'])) ? 'checked':''
                            ],
                'label' => 'Актуальные'
            ])
        ->add('submit',SubmitType::class,
            [
                'label'=> 'Поиск',
                'attr' => ['class'=>'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calls::class,
        ]);
    }
}
