<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreateAdminAccountModelTest
 *
 * @author prog
 */
class CreateAdminAccountModelTest extends PHPUnit_Framework_TestCase{
     /**
     * @var CreateAdminAccountModel
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new CreateAdminAccountModel();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
//    public function testCreateAdmin(){
//        $this->object->delAdminFromDataBase();
//        $this->object->set_adminName('dieu');
//        $this->object->set_adminEmail('dieu@ciel.org');
//        $this->object->createAdmin();
//        //see db
//    }
//    
//    /**
//     * @depends testCreateAdmin
//     */
//    public function testGetAdminFromDataBase(){
//        $this->object->getAdminFromDatabase();
//        $this->assertEquals('dieu', $this->object->get_adminName());
//        $this->assertEquals('dieu@ciel.org', $this->object->get_adminEmail());
//    }
    
    public function testFindInMultiArray(){
        $tst= array(
                        array('id_groupe' => '1', 'grp_nom_groupe'=>  'administrateur'), 
                        array('id_groupe' => '2', 'grp_nom_groupe'=>  'enseignant')
                    );
        $found=false;
        foreach ($tst as $row){
            if($row['grp_nom_groupe']== 'administrateur'){
                $found=true;
                break;
            }
        }
        $this->assertEquals(true,$found);
    }


    public function testCreateAdminAndGroupAdmin(){
        // remove groupe administrateur from 'Groupe' table in db
        $this->object->delAdminFromDataBase();
        $this->object->set_adminName('dieu2');
        $this->object->set_adminEmail('dieu2@ciel.org');
        $this->object->createAdmin();
        //see db
    }
    
    /**
     * @depends testCreateAdminAndGroupAdmin
     */
    public function testGetAdminFromDataBase2(){
        $this->object->getAdminFromDatabase();
        $this->assertEquals('dieu2', $this->object->get_adminName());
        $this->assertEquals('dieu2@ciel.org', $this->object->get_adminEmail());
    }
    
    public function testCreateAdmin(){
        $this->object->delAdminFromDataBase();
        $this->object->set_adminName('dieu');
        $this->object->set_adminEmail('dieu@ciel.org');
        $this->object->createAdmin();
        //see db
    }
    
    /**
     * @depends testCreateAdmin
     */
    public function testGetAdminFromDataBase(){
        $this->object->getAdminFromDatabase();
        $this->assertEquals('dieu', $this->object->get_adminName());
        $this->assertEquals('dieu@ciel.org', $this->object->get_adminEmail());
    }
    
    
}
