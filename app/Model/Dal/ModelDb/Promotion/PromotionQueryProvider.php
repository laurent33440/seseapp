<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Model\Dal\ModelDb\Promotion;

use Model\Dal\DbLibrary\IQueryProvider;

/**
 * Description of PromotionQueryProvider
 *
 * @author laurent
 */
class PromotionQueryProvider implements IQueryProvider{
    
	static function InsertQuery(){
            return "Insert into Promotion(pro_reference_promotion,pro_nom_promotion)
                              values(:pro_reference_promotion,:pro_nom_promotion)";
        }

	static function SelectByIDQuery(){
            return "Select * from Promotion where id_promotion=:id_promotion";
	}
        
        static function SelectByValueQuery($column){
            return "Select * from Promotion where $column=:$column";
	}

	static function SelectAllQuery(){
            return "Select * from Promotion";
	}

	static function SelectIDQuery(){
            return "Select max(id_promotion) from Promotion";
	}

	static function UpdateQuery(){
            return "update Promotion set    pro_reference_promotion = :pro_reference_promotion,
                                            pro_nom_promotion = :pro_nom_promotion
                                        where id_promotion=:id_promotion";
	}

	static function DeleteQuery(){
            return "delete from Promotion where id_promotion=:id_promotion";
	}
}
