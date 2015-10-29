<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use exception\InternalException;
use Logger;

/**
 * Description of TestjAjaxController
 *
 * @author laurent
 */
class TestAjaxController extends AControllerState{
    
    /**
     * response 
     * @var use Symfony\Component\HttpFoundation\RedirectResponse;
     */
    private $_response; 
    
    public function __construct(Request $request, $action) {
        parent::__construct($request, $action);
    }
    
    public function run(){
        try{
            switch ($this->_state){
                case self::IDLE :
                   //show view
                   $this->sendTestAjaxView();
                   $this->_state = self::RUNNING;  
                   break;
                case self::RUNNING:
                    if($this->_request->isMethod('POST')){
                        if($this->_request->isXmlHttpRequest()){ 
                            //if AJAX don't send view to client -- controller still running
                            $this->computeXmlHttpRequest($this->_request->request->all());
                        }else{
                            //submit post
                        }
                    }else {
                        // no POST.  GET or else... do something
                         $this->sendTestAjaxView();
                    }
                    break;
                case self::STOPPED:
                    break;
                case self::TERMINATED:
                    $this->_state = self::IDLE;
                    break;
                case self::ON_INPUT_ERROR:
                    break;
                default :
                    throw new InternalException('Unknom state in '.__CLASS__. ' State Unknown :  '.$this->_state);
            }
        }catch (Exception $e){
            $this->_state = self::ON_CRITICAL_ERROR;
            $this->_error = $e;
            throw $e;
        }
        
    }
    
    public function sendTestAjaxView(){
        $this->_modelView['head']['INDEX']= $this->_index;
        $this->_modelView['footer']['INDEX']= $this->_index;
        $this->sendModelView();
    }


    public function computeXmlHttpRequest(array $datas){
        if (!empty($datas['AJAX_VAL'])){
            $val = $datas['AJAX_VAL'];
        }else{
            $val = 'valeur non transmise ou hors contexte';
        }
        switch ($datas['AJAX_UPDATE']){
            case 'init_content_editor':
                $send = json_encode(array('title'=> 'titre du document', 'doc'=> 'voici le document ........etc.'));
                break;
            case 'document_change':
                $send = json_encode(array('title'=> 'Le document change: '.$val, 'doc'=> 'Votre document change et fait référence à : '.$val));
                break;
            case 'texte_change':
            case 'select_change':
            case 'mouse_over' :
            case 'date_change':
                $send = json_encode(array('change'=> $datas['AJAX_UPDATE'],'identificateur'=> $datas['AJAX_ID'], 'valeur'=> $val));
                break;
            default :
                $send = json_encode(array('change'=> 'AJAX_UPDATE inconnu !!! : '.$datas['AJAX_UPDATE'],'identificateur'=> $datas['AJAX_ID'], 'valeur'=> $val));
        }     
        //retour au client
        echo $send;
    }
    
    
}
