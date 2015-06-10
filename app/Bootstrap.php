<?php


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Bootstrap
 *
 * @author laurent
 */
class Bootstrap {
    //const CONFIG_DIR = ROOT.'/app/config';
    const APP_URL='/seseapp';
    const ENTRY_SCRIPT = 'index.php';
    const APPLICATION_NAME = 'SESE';
    const COMPANY_NAME = 'AVALONE';
    const COMPANY_URI = 'www.avalone-fr.com';
    //const DATA_BASE_FILE = 'mpd_sese_310714.sql.tar.gz';
    
    // DEBUG
    const DEBUG_SESE= true; //dev/debug/testing activate 
    
    //db test
    public static $_dbSrv="localhost";
    public static $_dbUser="root";
    public static $_dbPass="laurent";
    public static $_dbName="lolobase";
    
    //php mailer
    public static $_transportMail='gmail';
    public static $_userNameMail = 'authier.lppdg@gmail.com';
    public static $_userPasswordMail='laurent290867';
       
    public static function autoload($className){
        //echo(__CLASS__.' <pre>Autoload : ' . $className);
        $tab = explode('\\', $className);
        $path = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $tab) . '.php';
        //echo("\n    =&gt; $path</pre>");
        require $path;
    }

    public static function run() {
      //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_COMPILE_ERROR);
      error_reporting(-1);
      
      // Autoload
      spl_autoload_register(array(__CLASS__, "autoload"));

      //log
      $log = Logger::getInstance();
      $log->setLogFile("log_sese.txt", !self::DEBUG_SESE); //erase log each run
      $log->setLogFile("log_sese.txt");
      $log->setPriority(Logger::DEBUG);
      $log->logInfo("\n======== Log SESE Start ========\n---------------------------------");

      //Session
      $session = SeseSession::getInstance(self::DEBUG_SESE);
      $session->setName(self::APPLICATION_NAME);
      $session->start();
      if(!$session->has(self::APPLICATION_NAME)){
          $session->set(self::APPLICATION_NAME, 'started');
          $session->set('state_history', '');
          //echo $session->getId();
      }
      
      // Route
      $mainRouter = new MainRouter();
      $mainRouter->run();
   }
   
   public static function getEntryScript(){
       return self::ENTRY_SCRIPT;
   }

}

?>
