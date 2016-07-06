<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/***********************************
**Permet de récupérer des cours et de les mettre a jour / les supprimer
**  Pour l'instant le gère pas les mises a jour / suppression des attributs (horaires, horaires->cours ect.)
*/

class CoursTypeController
{

    protected $typesService;
    protected $horairesService;
    protected $coursService;

    public function __construct($typesService,$horairesService,$coursService)
    {
        $this->typesService = $typesService;
        $this->horairesService = $horairesService;
        $this->coursService = $coursService;
    }

    public function getAll()
    {
        /*Chercher a partir de courType
        **puis cour_horaire
        **puis cours
        ** prof1 et 2 ainsi que les lignes d'eau ne sont pas remplies. Leur IDs sont incluses permettront de les retrouver grace a leur propre controleur (ou service pour ligne d'eau).
        */

        //récupération du tableau, il manque des éléments
        $courType = $this->typesService->getAll();

        //Parcours avec ajout des attributs manquants.
        foreach ($courType as $key => $value){
            $courType[$key]['horaires'] = $this->horairesService->get($value['id']);
            $courType[$key]['horaires']['cour'] = $this->coursService->getByCoursHoraire($value['horaire']["id"]);
        }

        return new JsonResponse($courType);
    }

    public function get($id)
    {
        //Même schema que getAll(), mais avec un seul objet et non un tableau
        $courType = $this->typesService->get($id);

        $courType['horaires'] = $this->horairesService->get($id);
        $courType['horaires']['cour'] = $this->coursService->getByCoursHoraire($courType['horaire']["id"]);

        return new JsonResponse($courType);
    }

    public function save(Request $request)
    {
        $courType = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->typesService->save($courType)));
    }

    public function update($id, Request $request)
    {
        $courType = $this->getDataFromRequest($request);
        $this->typesService->update($id, $courType);
        return new JsonResponse($courType);
    }

    public function delete($id)
    {
        return new JsonResponse($this->typesService->delete($id));
    }

    public function getDataFromRequest(Request $request)
    {
        return json_decode($request->request->get("cour_type"),true);
    }
}
