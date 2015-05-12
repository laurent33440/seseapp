<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Enseignant;

use Model\Dal\DbLibrary\IMappingProvider;

/**
 * Description of EnseignantMappingProvider
 *
 * @author laurent
 */
class EnseignantMappingProvider implements IMappingProvider{
    
    static function MapFromRow( $row , $item ){
        $item->id_enseignant=$row['id_enseignant'];
        $item->ens_civilite_enseignant=$row['ens_civilite_enseignant'];
        $item->ens_nom_enseignant= $row['ens_nom_enseignant'];
        $item->ens_prenom_enseignant=  $row['ens_prenom_enseignant'];
        $item->ens_mel_enseignant=$row['ens_mel_enseignant'];
        $item->ens_adresse1_enseignant= $row['ens_adresse1_enseignant'];
        $item->ens_adresse2_enseignant= $row['ens_adresse2_enseignant'];
        $item->ens_url_enseignant=$row['ens_url_enseignant'];
        $item->ens_cp_enseignant= $row['ens_cp_enseignant'];
        $item->ens_discipline= $row['ens_discipline'];
        $item->ens_role=$row['ens_role'];
        $item->ens_est_referant= $row['ens_est_referant'];
        $item->ens_compte_enseignant= $row['ens_compte_enseignant'];
    }

    static function MapToRowGetByID( $id ){
        $retval [':id_enseignant']=$id;
        return $retval;
    }
    
    static function MapToRowGetByValue( $column, $val ){
        $retval [":$column"]=$val;
        return $retval;
    }

    Static function MapToRowInsert($item){
        $retval['ens_civilite_enseignant']=$item->ens_civilite_enseignant;
        $retval['ens_nom_enseignant']=$item->ens_nom_enseignant;
        $retval['ens_prenom_enseignant']=$item->ens_prenom_enseignant;
        $retval['ens_mel_enseignant']=$item->ens_mel_enseignant;
        $retval['ens_adresse1_enseignant']=$item->ens_adresse1_enseignant;
        $retval['ens_adresse2_enseignant']=$item->ens_adresse2_enseignant;
        $retval['ens_url_enseignant']= $item->ens_url_enseignant;
        $retval['ens_cp_enseignant']=$item->ens_cp_enseignant;
        $retval['ens_discipline']=$item->ens_discipline;
        $retval['ens_role'] =$item->ens_role;
        $retval['ens_est_referant'] =$item->ens_est_referant;
        $retval['ens_compte_enseignant']= $item->ens_compte_enseignant;
        return $retval;
    }

    static function MapToRowUpdate($item){
        $retval['id_enseignant']=$item->id_enseignant;
        $retval['ens_civilite_enseignant']=$item->ens_civilite_enseignant;
        $retval['ens_nom_enseignant']=$item->ens_nom_enseignant;
        $retval['ens_prenom_enseignant']=$item->ens_prenom_enseignant;
        $retval['ens_mel_enseignant']=$item->ens_mel_enseignant;
        $retval['ens_adresse1_enseignant']=$item->ens_adresse1_enseignant;
        $retval['ens_adresse2_enseignant']=$item->ens_adresse2_enseignant;
        $retval['ens_url_enseignant']= $item->ens_url_enseignant;
        $retval['ens_cp_enseignant']=$item->ens_cp_enseignant;
        $retval['ens_discipline']=$item->ens_discipline;
        $retval['ens_role'] =$item->ens_role;
        $retval['ens_est_referant'] =$item->ens_est_referant;
        $retval['ens_compte_enseignant']= $item->ens_compte_enseignant;
        return $retval;
    }

    static function MapToRowDelete($item){
        $retval[':id_enseignant'] = $item->id_enseignant;
        return $retval;
    }

    static function GetID($item){
        return $item->id_enseignant;
    }

    static function SetID($item,$id){
        $item->id_enseignant=$id;
    }
    
}
