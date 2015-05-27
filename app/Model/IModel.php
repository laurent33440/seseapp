<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

/**
 * generic methods model view (Form) <--> data base  
 * @author laurent
 */
interface IModel {
    public function resetModel();
    public function addBlank();
    public function append();
    public function getAll();
    public function update($property, $val, $id);
    public function deleteFromId($id);
    public function deleteFromProperty($property,$val);
    
   
}
