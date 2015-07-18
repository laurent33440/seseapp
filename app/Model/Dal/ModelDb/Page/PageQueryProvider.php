<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Page;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of PageQueryProvider
 *
 * @author laurent
 */
class PageQueryProvider implements IQueryProvider{
    
    static function InsertQuery(){
            return "Insert into Page( id_page, pge_nom_page) values( :id_page, :pge_nom_page)";
    }

    static function SelectByIDQuery(){
        return "Select * from Page where  id_page = :id_page";
    }
    
    static function SelectByValueQuery($column){
            return "Select * from Page where $column=:$column";
	}

    static function SelectAllQuery(){
        return "Select * from Page";
    }

    static function SelectIDQuery(){
        return "Select max(id_page) from Page";
    }

    static function UpdateQuery(){
        return "update Page set pge_nom_page = :pge_nom_page where  id_page = :id_page";
    }

    static function DeleteQuery(){
        return "delete from Page where  id_page = :id_page";
    }
}
