<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PdoCrudTest
 *
 * @author prog
 */
class PdoCrudTest extends PHPUnit_Framework_TestCase {

    /**
     * @var PdoCrud
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new PdoCrud('localhost', 'root', 'laurent');
        $this->object ->connect('lolobase');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
         $this->object ->closeDataBase();
    }
    
    public function testdbQI(){
        $datas = array('uti_identifiant'=>  'testIdent', 
                        'uti_mot_de_passe'=>  'testPass',
                        'uti_mel' => 'test@test.fr',
                        'uti_etat_compte' => 'actif',
                        'uti_derniere_connexion' => '0',
                        'id_groupe' => '1');
        $datas2 = array('uti_identifiant'=>  'testIdent2', 
                        'uti_mot_de_passe'=>  'testPass2',
                        'uti_mel' => 'test@test.fr2',
                        'uti_etat_compte' => 'actif2',
                        'uti_derniere_connexion' => '0',
                        'id_groupe' => '1');
        $table ='Utilisateurs';
        $lastId = $this->object->dbQI($datas, $table);
        $this->assertNotNull($lastId);
        $lastId = $this->object->dbQI($datas2, $table);
        $this->assertNotNull($lastId);
        return $lastId;
    }
    
    /**
     * @depends testdbQI
     */
    public function testdbQS(){
        $table ='Utilisateurs';
        $r = $this->object->dbQS($table, array('uti_mel'));
//        var_dump($r);
        $this->assertEquals(array(array('uti_mel' => 'test@test.fr'), array('uti_mel' => 'test@test.fr2')), $r);
        $r = $this->object->dbQS($table, array('uti_mel', 'uti_identifiant'));
        $this->assertEquals(array(
                                array('uti_mel' => 'test@test.fr', 'uti_identifiant'=>  'testIdent'), 
                                array('uti_mel' => 'test@test.fr2', 'uti_identifiant'=>  'testIdent2')
                            ), $r);
        $r = $this->object->dbQS($table, array('uti_mel'), 'uti_identifiant = \'testIdent2\'');
        $this->assertEquals(array(array('uti_mel' => 'test@test.fr2')), $r);
    }
    
    /**
     * @depends testdbQI
     */
//    public function testdbQD(){
//        $table ='Utilisateurs';
//        $r = $this->object->dbQD($table);
//        $this->assertEquals(2, $r);
//    }
}
