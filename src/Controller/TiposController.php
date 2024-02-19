<?php

namespace App\Controller;

use App\Entity\Tipos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tipos', name: 'app_tipos_')]
class TiposController extends AbstractController
{
    #[Route('/insertar/{nombreTipo}', name: 'insertar')]
    public function index(EntityManagerInterface $gestorEntidades, String $nombreTipo): Response
    {
        // Ejemplo endpoint: http://localhost:8000/tipos/insertar/Eléctrico
        $tipo = new Tipos();
        $tipo->setNombreTipo($nombreTipo);
        $gestorEntidades->persist($tipo);
        $gestorEntidades->flush();

        return new Response("<h1>Tipo insertado, ID= " . $tipo->getId() . "</h1>");
    }
}
