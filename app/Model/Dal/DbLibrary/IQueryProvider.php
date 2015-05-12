<?php

namespace Model\Dal\DbLibrary;

/**
* Description of IQueryProvider
*
* @author laurent
*/
   
interface IQueryProvider{
    public static function InsertQuery();
    public static function SelectIDQuery();
    public static function SelectAllQuery();
    public static function SelectByIDQuery();
    public static function UpdateQuery();
    public static function DeleteQuery();    
}
?>
