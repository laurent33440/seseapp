<?php

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Model\Dal\ModelDb\Enseignant\EnseignantObject;
use Model\Dal\ModelDb\Promotion\PromotionObject;
use Model\Dal\ModelDb\Intervenir\IntervenirObject;
use Model\Dal\ModelDb\Utilisateurs\UtilisateursObject;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-06-26 at 16:06:50.
 */
class TeacherDefinitionModelTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var TeacherDefinitionModel
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new TeacherDefinitionModel;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Model\TeacherDefinitionModel::set_teachersList
     * @todo   Implement testSet_teachersList().
     */
    public function testSet_teachersList() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::set_promotionsList
     * @todo   Implement testSet_promotionsList().
     */
    public function testSet_promotionsList() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::set_teacherLastName
     * @todo   Implement testSet_teacherLastName().
     */
    public function testSet_teacherLastName() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::set_teacherFirstName
     * @todo   Implement testSet_teacherFirstName().
     */
    public function testSet_teacherFirstName() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::set_teacherMail
     * @todo   Implement testSet_teacherMail().
     */
    public function testSet_teacherMail() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::set_teacherSkill
     * @todo   Implement testSet_teacherSkill().
     */
    public function testSet_teacherSkill() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::set_editFormVisible
     * @todo   Implement testSet_editFormVisible().
     */
    public function testSet_editFormVisible() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::set_teacherId
     * @todo   Implement testSet_teacherId().
     */
    public function testSet_teacherId() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::get_teachersList
     * @todo   Implement testGet_teachersList().
     */
    public function testGet_teachersList() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::get_promotionsList
     * @todo   Implement testGet_promotionsList().
     */
    public function testGet_promotionsList() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::get_teacherLastName
     * @todo   Implement testGet_teacherLastName().
     */
    public function testGet_teacherLastName() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::get_teacherFirstName
     * @todo   Implement testGet_teacherFirstName().
     */
    public function testGet_teacherFirstName() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::get_teacherMail
     * @todo   Implement testGet_teacherMail().
     */
    public function testGet_teacherMail() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::get_teacherSkill
     * @todo   Implement testGet_teacherSkill().
     */
    public function testGet_teacherSkill() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::get_editFormVisible
     * @todo   Implement testGet_editFormVisible().
     */
    public function testGet_editFormVisible() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::get_teacherId
     * @todo   Implement testGet_teacherId().
     */
    public function testGet_teacherId() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::addBlank
     * @todo   Implement testAddBlank().
     */
    public function testAddBlank() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }
    
    public function testAppend(){
        $this->object->set_teachersList('new');
        $this->object->set_teacherFirstName('ada');
        $this->object->set_teacherLastName('ada');
        $this->object->append();
        
        
    }

    /**
     * @covers Model\TeacherDefinitionModel::append
     * @todo   Implement testAppend().
     */
    public function testAppend_update() {
        $this->object->getAll();
        //
        $collection = new DataAccess('Enseignant');
        $kt=array_keys($this->object->get_teachersList());// id of teacher edited
        $teacher = $collection->GetByID($kt[0]);
        //
//        $t=  $this->object->get_teachersList();
//        $kt = array_flip($t);
        //var_dump($kt);
        $this->object->append();
//        // Remove the following lines when you implement this test.
//        $this->markTestIncomplete(
//                'This test has not been implemented yet.'
//        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::deleteFromId
     * @todo   Implement testDeleteFromId().
     */
    public function testDeleteFromId() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::deleteFromProperty
     * @todo   Implement testDeleteFromProperty().
     */
    public function testDeleteFromProperty() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::getAll
     * @todo   Implement testGetAll().
     */
    public function testGetAll() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::resetModel
     * @todo   Implement testResetModel().
     */
    public function testResetModel() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::update
     * @todo   Implement testUpdate().
     */
    public function testUpdate() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::selectTeacher
     * @todo   Implement testSelectTeacher().
     */
    public function testSelectTeacher() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::getAllPromotion
     * @todo   Implement testGetAllPromotion().
     */
    public function testGetAllPromotion() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Model\TeacherDefinitionModel::addToTable
     * @todo   Implement testAddToTable().
     */
    public function testAddToTable() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}
