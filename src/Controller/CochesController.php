<?php

namespace App\Controller;

use App\Entity\Coches;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class CochesController extends AbstractController
{
    #[Route('/coches/consultar', name: 'app_coches_consultar')]
    public function consultar(EntityManagerInterface $gestorEntidades): JsonResponse
    {
        // Endpoint de ejemplo: http://localhost:8000/coches/consultar
        $repoCoches = $gestorEntidades->getRepository(Coches::class);
        $coches = $repoCoches->findAll();

        // por capricho del front...
        $json = [];
        foreach ($coches as $coche) {
            $json[] = [
               "matricula" => $coche->getMatricula(), 
               "caracteristicas" => [
                    "precio" => $coche->getPrecio(),
                    "estado" => $coche->isEstado(),
                    "kms" => $coche->getKms(),
               ],
               "fecha" => $coche->getFecha(),
               "modelo" => $coche->getIdModelo()->getNombreModelo(),
            ];
        }

        //return new Response("" . var_dump($coches));
        return new JsonResponse($json);
    }

    #[Route('/coches/insertar', name: 'app_coches_insertar')]
    public function insertar(EntityManagerInterface $gestorEntidades, Request $solicitud): Response
    {
        // Endpoint de ejemplo: http://localhost:8000/coches/insertar
        // Vamos a usar por consola php bin/console make:form
        $coche = new Coches();


        return $this->render('coches/index.html.twig', [
            'controller_name' => 'CochesController',
        ]);
    }



}
