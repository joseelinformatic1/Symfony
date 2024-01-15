<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContacteController
{
    private $equips = array(
        array(
            "codi" => "1",
            "nom" => "Equip Roig",
            "cicle" => "DAW",
            "curs" => "22/23",
            "membres" => array("Elena", "Vicent", "Joan", "Maria")
        )
    );

    #[Route('/equip/{codi}', name: 'dades_equip')]

    public function fitxa($codi)
    {
        $resultat = array_filter(
            $this->equips,
            function ($equip) use ($codi) {
                return $equip["codi"] == $codi;
            }
        );
        if (count($resultat) > 0) {
            $resposta = "";
            $resultat = array_shift($resultat); #torna el primer element
            $resposta .= "<ul><li>" . $resultat["nom"] . "</li>" .
            "<li>" . $resultat["cicle"] . "</li>" .
            "<li>" . $resultat["curs"] . "</li>" .
            "<li>Membres:</li><ul>";

        foreach ($resultat["membres"] as $membre) {
            $resposta .= "<li>$membre</li>";
        }

        $resposta .= "</ul></ul>";
            return new Response("<html><body>$resposta</body></html>");
        } else
            return new Response("No s'ha trobat l'equip: " + $codi);
    }

    //#[Route('/contacte/{text}', name: 'buscar_equip')]

}
