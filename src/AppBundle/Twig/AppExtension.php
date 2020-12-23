<?php

namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('tipoMascota', [$this, 'tipoMascota']),
            new TwigFunction('sexoMascota', [$this, 'sexoMascota']),
        ];
    }

    public function tipoMascota(int $tipo)
    {
        $tipos = array(
            '1' => 'Perro',
            '2' => 'Gato',
            '3' => 'Hurón',
            '4' =>'Tortuga'
        );

        return $tipos[$tipo];
    }

    public function sexoMascota(int $sexo)
    {
        $sexos = array(
            '1' => 'Macho',
            '2' => 'Hembra',
        );

        return $sexos[$sexo];
    }
}