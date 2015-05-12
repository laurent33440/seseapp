<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Finally, A light, permissions-checking logging class. 
	 * 
	 * Author	: Kenneth Katzgrau < katzgrau@gmail.com >
	 * Date	: July 26, 2008
	 * Comments	: Originally written for use with wpSearch
	 * Website	: http://codefury.net
	 * Version	: 1.0
	 *
	 * Usage: 
	 *		$log = Logger::getInstance();
         *              $log->setLogFile( "log.txt");
         *              $log->setPriority( Logger::INFO );
	 *		$log->LogInfo("Returned a million search results");	//Prints to the log file
	 *		$log->LogFATAL("Oh dear.");				//Prints to the log file
	 *		$log->LogDebug("x = 5");				//Prints nothing due to priority setting
 * modified by:
 * @author laurent
 */
class Logger {
	
        const DEBUG 	= 1;	// Most Verbose
        const INFO 	= 2;	// ...
        const WARN 	= 3;	// ...
        const ERROR 	= 4;	// ...
        const FATAL 	= 5;	// Least Verbose
        const OFF       = 6;    // nothing

        const LOG_OPEN 		= 1;
        const OPEN_FAILED 	= 2;
        const LOG_CLOSED 	= 3;

        //singleton
        private static $_instance=null;

        private $Log_Status 	= Logger::LOG_CLOSED;
        private $DateFormat	= "d-m-Y G:i:s";
        private $MessageQueue;

        private $log_file='UnameLogFile.txt';
        private $priority = Logger::INFO;

        private $file_handle;

        final private function __construct(){
            $this->MessageQueue = array();
            $this->Log_Status = Logger::LOG_CLOSED;
        }
        
        final public static function getInstance () {
            if (!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        final public function __destruct(){
                if ( $this->file_handle )
                        fclose( $this->file_handle );
                if ($this->Log_Status === Logger::OPEN_FAILED && count($this->MessageQueue)>0)
                    foreach ($this->MessageQueue as $msg)
                        echo '</br>'.$msg;
        }

        public function setLogFile($log_file, $append=true) {
            $this->log_file = $log_file;
            if ( file_exists( $this->log_file ) ){
                    if(!$append){
                        unlink($this->log_file); //erase file for each run
                    }
                    else{
                        if ( !is_writable($this->log_file) ){
                                $this->Log_Status = Logger::OPEN_FAILED;
                                $this->MessageQueue[] = "The file exists, but could not be opened for writing. Check that appropriate permissions have been set.";
                                return;
                        }
                    }
            }
            if ( $this->file_handle = fopen( $this->log_file , "a" ) ){
                    $this->Log_Status = Logger::LOG_OPEN;
                    $this->MessageQueue[] = "The log file was opened successfully.";
            }
            else{
                    $this->Log_Status = Logger::OPEN_FAILED;
                    $this->MessageQueue[] = "The file could not be opened. Check permissions.";
            }
        }

        public function setPriority($priority) {
            $this->priority = $priority;
        }

        public function logInfo($line){
                $this->log( $line , Logger::INFO );
        }

        public function logDebug($line){
                $this->log( $line , Logger::DEBUG );
        }

        public function logWarn($line){
                $this->log( $line , Logger::WARN );	
        }

        public function logError($line){
                $this->log( $line , Logger::ERROR );		
        }

        public function logFatal($line){
                $this->log( $line , Logger::FATAL );
        }

        public function log($line, $priority){
                if ( $this->priority <= $priority ){
                        $status = $this->getTimeLine( $priority );
                        $this->WriteFreeFormLine ( "$status $line \n" );
                }
        }

        public function WriteFreeFormLine( $line ){
                if ( $this->Log_Status == Logger::LOG_OPEN && $this->priority != Logger::OFF ){
                    if (fwrite( $this->file_handle , $line ) === false) {
                        $this->Log_Status = Logger::OPEN_FAILED;
                        $this->MessageQueue[] = "The file could not be written to. Check that appropriate permissions have been set.";
                    }
                }
        }

        private function getTimeLine( $level ){
                $time = date( $this->DateFormat );

                switch( $level ){
                        case Logger::INFO:
                                return "$time - INFO  -->";
                        case Logger::WARN:
                                return "$time - WARN  -->";				
                        case Logger::DEBUG:
                                return "$time - DEBUG -->";				
                        case Logger::ERROR:
                                return "$time - ERROR -->";
                        case Logger::FATAL:
                                return "$time - FATAL -->";
                        default:
                                return "$time - LOG   -->";
                }
        }
}

?>
