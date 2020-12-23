<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Mascota;
use AppBundle\Entity\Humano;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/crear-mascota", name="crear_mascota")
     */
    public function crearMascotaAction(Request $request)
    {
        // Se crea el formulario para renderizar
        $mascota = new Mascota();
        $form = $this->createFormBuilder($mascota)
            ->add('chip', IntegerType::class)
            ->add('nombre', TextType::class)
            ->add('tipo', ChoiceType::class, [
                'choices'  => [
                    'Perro' => 1,
                    'Gato' => 2,
                    'Hurón' => 3,
                    'Tortuga' => 4,
                ],
            ])
            ->add('apellido', TextType::class, [
                'required' => false
            ])
            ->add('sexo', ChoiceType::class, [
                'choices'  => [
                    'Macho' => 1,
                    'Hembra' => 2,
                ],
            ])
            ->add('color', TextType::class)
            ->add('fechaNacimiento', DateType::class)
            ->add('raza', TextType::class)
            ->add('esterilizada', CheckboxType::class, [
                'required' => false
            ])
            ->add('humano_id', EntityType::class, [
                'label' => 'Humano responsable',
                'class' => 'AppBundle:Humano',
                'choice_label' => 'nombre',
            ])
            ->add('observaciones', TextareaType::class)
            ->add('save', SubmitType::class, ['label' => 'Crear Mascota'])
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));
    
            if ($form->isSubmitted() && $form->isValid()) {
                $mascota = $form->getData();
                $mascota->setFechaRegistro(new \DateTime('NOW'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($mascota);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    'Mascota guardada con éxito'
                );
    
                return $this->redirectToRoute('crear_mascota');
            }
        }

        return $this->render('default/crear-mascota.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
