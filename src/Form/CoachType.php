<?php

namespace App\Form;

use App\Entity\Coach;
use App\Repository\CoachRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormError;

class CoachType extends AbstractType
{ private $CoachRepository;
    public function __construct(CoachRepository $CoachRepository){
        $this->CoachRepository = $CoachRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cin')
            ->add('datedinscription', null, [
                'widget' => 'single_text',
            ])
            ->add('specialite')
        ;
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();


            $existingCoach = $this->CoachRepository->findOneBy(['cin' => $data->getCin()]);

            if ($existingCoach) {

                $form->get('cin')->addError(new FormError('Un coach avec ce CIN existe déjà.'));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coach::class,
        ]);
    }
}
