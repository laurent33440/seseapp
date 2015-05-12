<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Referentiel_de_formation;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of Referentiel_de_formationQueryProvider
 *
 * @author laurent
 */
class Referentiel_de_formationQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
            return "Insert into Referentiel_de_formation (rdf_nom_formation,rdf_domaine_formation,rdf_reference,rdf_intitule,rdf_descriptif,rdf_duree_formation,rdf_nombre_jours_stage) "
                                  . "values(:rdf_nom_formation,:rdf_domaine_formation,:rdf_reference,:rdf_intitule,:rdf_descriptif,:rdf_duree_formation,:rdf_nombre_jours_stage) ";
    }

    static function SelectByIDQuery(){
        return "Select * from Referentiel_de_formation where id_referentiel_de_formation = :id_referentiel_de_formation";
    }

    static function SelectAllQuery(){
        return "Select * from Referentiel_de_formation";
    }

    static function SelectIDQuery(){
        return "Select max(id_referentiel_de_formation) from Referentiel_de_formation";
    }

    static function UpdateQuery(){
        return "update Referentiel_de_formation set    rdf_nom_formation=:rdf_nom_formation,rdf_domaine_formation=:rdf_domaine_formation,"
        . "rdf_reference=:rdf_reference,rdf_intitule=:rdf_intitule,rdf_descriptif=:rdf_descriptif,rdf_duree_formation=:rdf_duree_formation,rdf_nombre_jours_stage=:rdf_nombre_jours_stage"
            . "where id_referentiel_de_formation = :id_referentiel_de_formation";
    }

    static function DeleteQuery(){
        return "delete from Referentiel_de_formation where id_referentiel_de_formation = :id_referentiel_de_formation";
    }
}
