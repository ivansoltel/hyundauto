<?php

namespace App\Controller;

use App\Entity\Modelos;
use App\Entity\Tipos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/modelos', name: 'app_modelos_')]
class ModelosController extends AbstractController
{
    #[Route('/insertar', name: 'insertar')]
    public function index(EntityManagerInterface $gestorEntidades): Response
    {
        // Ejemplo endpoint: http://localhost:8000/modelos/insertar
        $modelos = array (
            "m1" => array(
                "nombre_modelo" => "Kona EV 2024 115Kw Flexx",
                "id_tipo" => 1
            ),
            "m2" => array(
                "nombre_modelo" => "Tucson 1.6 TGDI HEV",
                "id_tipo" => 2
            ),
        );

        foreach ($modelos as $nuevoModelo) {
            $modelo = new Modelos();
            $modelo->setNombreModelo($nuevoModelo["nombre_modelo"]);
            /*
            $repotipos = $gestorEntidades->getRepository(Tipos::class);
            $tipo = $repotipos->findOneBy(["id" => $nuevoModelo["id_tipo"]]);
            */
            $repotipos = $gestorEntidades->getRepository(Tipos::class);
            $tipo = $repotipos->find($nuevoModelo["id_tipo"]);

            $modelo->setIdTipo($tipo);
            $gestorEntidades->persist($modelo);
            $gestorEntidades->flush();
        }
        return new Response("<h1> Insertados Modelos <h1>");
    }
}
