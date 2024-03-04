<?php

namespace App\Controller;

use App\Entity\Tipos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;

#[Route('/tipos', name: 'app_tipos_')]
class TiposController extends AbstractController
{
    #[Route('/insertar/{nombreTipo}', name: 'insertar')]
    public function insertar(EntityManagerInterface $gestorEntidades, String $nombreTipo): Response
    {
        // Ejemplo endpoint: http://localhost:8000/tipos/insertar/Eléctrico
        $tipo = new Tipos();
        $tipo->setNombreTipo($nombreTipo);
        $gestorEntidades->persist($tipo);
        $gestorEntidades->flush();
        return $this->redirectToRoute("app_tipos_consultar", []);
        //return new Response("<h1>Tipo insertado, ID= " . $tipo->getId() . "</h1>");
    }

    #[Route('/consultar', name: 'consultar')]
    public function consultar(EntityManagerInterface $gestorEntidades): JsonResponse
    {
        // Ejemplo endpoint: http://localhost:8000/tipos/consultar
        $json = array();
        $tipos = $gestorEntidades->getRepository(Tipos::class)->findAll();
        foreach ($tipos as $tipo) {
            $json[] = array(
                "id" => $tipo->getId(),
                "nombre_tipo" => $tipo->getNombreTipo(),
            );
        }
        return new JsonResponse($json);
    }

    /**
     * Para definir un formulario:
     * 1) Configurar config/packages/twig.yaml para añadir Bootstrap
     * 2) Crear el formulario en el Controlador
     * 3) Recoger los datos del formulario
     * 4) Modificar la Base de datos
     * 5) Agregar el formulario como Widget al Twig asociado al Controlador
     */

    #[Route('/insertar', name: 'insertarTipo')]
    public function insertarTipo(EntityManagerInterface $gestorEntidades, Request $solicitud): Response
    {
        // Ejemplo endpoint: http://localhost:8000/tipos/insertar
        $tipo = new Tipos();

        // Creamos el formulario CAMPO POR CAMPO
        $formulario = $this->createFormBuilder($tipo)
            ->add('nombre_tipo', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('guardar', SubmitType::class, ["label" => "Insertar Tipo", 'attr' => ['class' => 'btn btn-outline-primary']])
            ->getForm();

        // Recogemos los datos del formulario
        $formulario->handleRequest($solicitud);

        // Si el formulario se ha enviado Y es válido
        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $tipo = $formulario->getData();
            $gestorEntidades->persist($tipo);
            $gestorEntidades->flush();
            //$this->addFlash('success', 'Tipo insertado correctamente.');
            //return $this->redirectToRoute("app_tipos_consultar");
            //return $this->redirectToRoute("tipos_consultar");

            $this->addFlash('success_tipo', 'Tipo insertado correctamente.');
        }

        return $this->render('tipos/index.html.twig', [
            'controller_name' => 'TiposController',
            'miForm' => $formulario->createView(),

        ]);
    }
}
