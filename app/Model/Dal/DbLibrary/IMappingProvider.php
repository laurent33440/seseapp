<?php

namespace Model\Dal\DbLibrary;   
   
/**
 * Description of IMappingProvider
 *
 * @author laurent
 */
   
interface IMappingProvider{
    public static function MapFromRow( $row , $item );
    public static function MapToRowGetByID( $id );
    public static function MapToRowInsert( $item );
    public static function MapToRowUpdate( $item );
    public static function GetID( $item );
    public static function SetID( $item , $id );
}
?>