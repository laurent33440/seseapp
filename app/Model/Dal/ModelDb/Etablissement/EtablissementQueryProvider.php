<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Etablissement;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of EtablissementQueryProvider
 *
 * @author laurent
 */
class EtablissementQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
            return "Insert into Etablissement (eta_nom_etablissement,eta_siret_etablissement,eta_adresse1_etablissement,eta_adresse2_etablissement,eta_ville_etablissement,
                                            eta_cp_etablissement,eta_url_etablissement,eta_mel_etablissement,eta_telephone_etablissement) "
                                  . "values(:eta_nom_etablissement,:eta_siret_etablissement,:eta_adresse1_etablissement,:eta_adresse2_etablissement,:eta_ville_etablissement,
                                            :eta_cp_etablissement,:eta_url_etablissement,:eta_mel_etablissement,:eta_telephone_etablissement) ";
    }

    static function SelectByIDQuery(){
        return "Select * from Etablissement where id_etablissement = :id_etablissement";
    }

    static function SelectAllQuery(){
        return "Select * from Etablissement";
    }

    static function SelectIDQuery(){
        return "Select max(id_etablissement) from Etablissement";
    }

    static function UpdateQuery(){
        return "update Etablissement set    eta_nom_etablissement=:eta_nom_etablissement,eta_siret_etablissement=:eta_siret_etablissement,
                                            eta_adresse1_etablissement=:eta_adresse1_etablissement,eta_adresse2_etablissement=:eta_adresse2_etablissement,
                                            eta_ville_etablissement=:eta_ville_etablissement,eta_cp_etablissement=:eta_cp_etablissement,
                                            eta_url_etablissement=:eta_url_etablissement,eta_mel_etablissement=:eta_mel_etablissement,
                                            eta_telephone_etablissement=:eta_telephone_etablissement"
            . "where id_etablissement = :id_etablissement";
    }

    static function DeleteQuery(){
        return "delete from Etablissement where id_etablissement = :id_etablissement";
    }
}
