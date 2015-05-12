<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

use Model\Dal\DbLibrary\DataAccess;
use Logger;

/**
 * Description of WorkDateModel
 *
 * @author laurent
 */
class InternalContactModel extends AModel{
    const EMAIL_DIVIDER = ' -- Mél : ';
    
    //view
    private $_emailToList=array(); //all emails known
    private $_message;
    private $_emailChoosen;
    
    //emailTo
    protected $emailTo;
    
    public function __construct(){
        
        $collection = new DataAccess('Enseignant');
        $elts = $collection->GetAll();
        foreach ($elts as $elt) {
            $this->set_emailToList('Enseignant -- '.$elt->ens_prenom_enseignant.' '.$elt->ens_nom_enseignant.self::EMAIL_DIVIDER.$elt->ens_mel_enseignant);
            
        }
        $collection = new DataAccess('Stagiaire');
        $elts = $collection->GetAll();
        foreach ($elts as $elt) {
            $this->set_emailToList('Stagiaire -- '.$elt->sta_prenom_stagiaire.' '.$elt->sta_nom_stagiaire.self::EMAIL_DIVIDER.$elt->sta_mel_stagiaire);
        }
        $collection = new DataAccess('Collaborateur');
        $elts = $collection->GetAll();
        foreach ($elts as $elt) {
            $this->set_emailToList('Tuteur -- '.$elt->col_prenom.' '.$elt->col_prenom.self::EMAIL_DIVIDER.$elt->col_mel);
            
        }
    }

    public function get_emailToList() {
        return $this->_emailToList;
    }

    public function get_message() {
        return $this->_message;
    }
    
    public function get_emailChoosen() {
        return $this->_emailChoosen;
    }

    public function set_emailToList($_emailTo) {
        $this->_emailToList[] = $_emailTo;
    }

    public function set_message($_message) {
        $this->_message = $_message;
    }
    
    public function set_emailChoosen($_emailChoosen) {
        $this->_emailChoosen = $_emailChoosen;
    }

        
    public function sendMail(){
        $parts = explode(self::EMAIL_DIVIDER, $this->_emailChoosen);
        $this->emailTo= $parts[1];
         Logger::getInstance()->logDebug(__CLASS__.'::'.__METHOD__.'  emailto :'.print_r($this->emailTo, true));
        //check mail to : FIXME useless
        $collection = new DataAccess('Enseignant');
        if(!$collection->GetAllByColumnValue('ens_mel_enseignant', $this->emailTo)){
            $collection = new DataAccess('Stagiaire');
            if(!$collection->GetByColumnValue('sta_mel_stagiaire', $this->emailTo)){
                $collection = new DataAccess('Collaborateur');
                if(!$collection->GetByColumnValue('col_mel', $this->emailTo)){
                    return false;
                }
            }
        }
        //Create a new PHPMailer instance
        $mail = new \PhpMailer\PhpMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        //$mail->Username = \Bootstrap::$_userNameMail;
        $mail->Username = 'authier.lppdg@gmail.com';

        //Password to use for SMTP authentication
        //$mail->Password = \Bootstrap::$_userPasswordMail;
        $mail->Password = 'laurent290867';

        //Set who the message is to be sent from
        $mail->setFrom(\Bootstrap::$session->get('/user/name'), 'First Last');

        //Set an alternative reply-to address
//        $mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        $mail->addAddress($this->emailTo, 'Destination');

        //Set the subject line
        $mail->Subject = 'Test';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($this->_message);

        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

//        //Attach an image file
//        $mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            Logger::getInstance()->logDebug('Class '.__CLASS__. ' -- send mail error : '.$mail->ErrorInfo);
            return false;
        }
        return true;

    }
    
    
    
    
    


    

    

    
    
    
}
