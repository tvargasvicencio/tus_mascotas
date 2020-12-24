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

use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
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
            ->add('fechaNacimiento', TextType::class, [
                'attr' => [
                    'class' => 'js-datepicker',
                    'autocomplete' => "off"
                ],
            ])
            ->add('raza', TextType::class)
            ->add('esterilizada', ChoiceType::class, [
                'choices'  => [
                    'Sí' => true,
                    'No' => false,
                ],
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
                $fechaNacimiento = explode("/",$mascota->getFechaNacimiento());
                $mascota->setFechaNacimiento(new \DateTime($fechaNacimiento[2].'-'.$fechaNacimiento[1].'-'.$fechaNacimiento[0]));
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

        return $this->render('default/formulario-mascota.html.twig', [
            'form' => $form->createView(),
            'objetivo' => 'Crear'
        ]);
    }

    /**
     * @Route("/editar-mascota/{id}", name="editar_mascota")
     */
    public function editarMascotaAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Mascota::class);
        $mascota = $repository->find($id);

        if ($mascota) {
            $form = $this->createFormBuilder($mascota)
                ->add('chip', IntegerType::class, [
                    'disabled' => true
                ])
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
                ->add('fechaNacimiento', TextType::class, [
                    'data' => $mascota->getFechaNacimiento()->format('d/m/Y'),
                    'attr' => [
                        'class' => 'js-datepicker',
                        'autocomplete' => "off"
                    ],
                ])
                ->add('raza', TextType::class)
                ->add('esterilizada', ChoiceType::class, [
                    'choices'  => [
                        'Sí' => true,
                        'No' => false,
                    ],
                ])
                ->add('humano_id', EntityType::class, [
                    'disabled' => true,
                    'label' => 'Humano responsable',
                    'class' => 'AppBundle:Humano',
                    'choice_label' => 'nombre',
                ])
                ->add('observaciones', TextareaType::class)
                ->add('save', SubmitType::class, ['label' => 'Modificar Mascota'])
                ->getForm();

            if ($request->isMethod('POST')) {
                $form->submit($request->request->get($form->getName()));
        
                if ($form->isSubmitted() && $form->isValid()) {
                    $mascota = $form->getData();
                    $fechaNacimiento = explode("/",$mascota->getFechaNacimiento());
                    $mascota->setFechaNacimiento(new \DateTime($fechaNacimiento[2].'-'.$fechaNacimiento[1].'-'.$fechaNacimiento[0]));
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($mascota);
                    $entityManager->flush();

                    $this->addFlash(
                        'success',
                        'Mascota editada con éxito'
                    );
        
                    return $this->redirectToRoute('listado_mascotas');
                }
            }

            return $this->render('default/formulario-mascota.html.twig', [
                'form' => $form->createView(),
                'objetivo' => 'Modificar'
            ]);
        }
        else{
            $this->addFlash(
                'danger',
                'Mascota no encontrada'
            );
            return $this->redirectToRoute('listado_mascotas');
        }
    }

    /**
     * @Route("/eliminar-mascota/{id}", name="eliminar_mascota")
     */
    public function eliminarMascotaAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Mascota::class);
        $mascota = $repository->find($id);

        if ($mascota) {
            $entityManager->remove($mascota);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Mascota eliminada con éxito'
            );
        }
        else{
            $this->addFlash(
                'danger',
                'Mascota no encontrada'
            );
        }
        return $this->redirectToRoute('listado_mascotas');
    }

    /**
     * @Route("/listado-mascotas", name="listado_mascotas")
     */
    public function listadoMascotasAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $query = 'SELECT m.id, m.chip, m.nombre, m.apellido, m.tipo, m.sexo, m.raza, m.fecha_registro, 
            m.humano_id, h.nombre as nombre_humano, h.rut as rut_humano 
            FROM mascota m 
            JOIN humano h on m.humano_id = h.id;';
        
        $statement = $entityManager->getConnection()->prepare($query);
        $statement->execute();

        $mascotas = $statement->fetchAll();
        
        return $this->render('default/listado-mascotas.html.twig', [
            'mascotas' => $mascotas
        ]);
    }

    /**
     * @Route("/api/1.0/mascota/{chip}", name="api_mascota")
     */
    public function apiMascota($chip)
    {
        $mascota = $this->getDoctrine()
            ->getRepository(Mascota::class)
            ->findByChip($chip);

        if ($mascota == null) {
            $response = new JsonResponse([
                'mascota'=>null, 
                'msg' => 'Mascota no encontrada'
            ]);
            return $response;
        }

        $response = new JsonResponse([
            'mascota' => $mascota,
            'msg' => 'Mascota encontrada'
        ]);
        return $response;
    }
}
