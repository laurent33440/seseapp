<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
//use Symfony\Component\Routing\RouteCollection;
//use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use \Exception\InternalException;

/**
 * Description of MainSetupRouter
 *
 * @author laurent
 */
class MainRouter {
    
    public function run() {
        try{
            if(UserConnected::getInstance()->isUserConnected()){
                $locator = new FileLocator(array(CONFIG));
                $loader = new YamlFileLoader($locator);
                $routesCollection = $loader->load('routes.yml');
                $context = new RequestContext();
                $context->fromRequest(Request::createFromGlobals());//init context
    //            echo 'Path info : '.$context->getPathInfo().' || ';
    //            echo 'base url : '.$context->getBaseUrl().' || ';
                $matcher = new UrlMatcher($routesCollection, $context);
                $parameters = $matcher->match($context->getPathInfo());
    //            var_dump($parameters);
                //$controllerQualified = APP.'Controller/'.$parameters['_controller'].'Controller.php';
            }else{
                $parameters = array('_controller'=>'Login', '_action'=>'check');
               
            }
            $controllerQualified = APP.'Controller/'.$parameters['_controller'].'Controller.php';
            if (is_file($controllerQualified)){
                $controllerClass = 'Controller\\'.$parameters['_controller'].'Controller';
                $action = $parameters['_action'];
                $controller = new $controllerClass(Request::createFromGlobals(), $action);
                if (method_exists($controller, $action)) {
                      $reflection = new \ReflectionMethod($controller, $action);
                      if (!$reflection->isPublic()) {
                          Logger::getInstance()->logFatal('Class '.__CLASS__. ' - controller trigged : '.$controller.' => can\'t acces to method : '.$action);
                          throw new InternalException('Class '.__CLASS__. ' - controller trigged : '.$controller.' => can\'t acces to method : '.$action);//@header('Location: error404');
                      }
                      Logger::getInstance()->logInfo('Class '.__CLASS__. ' - controller trigged : '.$parameters['_controller'].'::'.$parameters['_action']);
                      $controller->$action(); //exec
                }else{
                    Logger::getInstance()->logFatal('Class '.__CLASS__. ' - controller trigged : '.$controller.' => can\'t find method : '.$action);
                    throw new InternalException('Class '.__CLASS__. ' - controller trigged : '.$controller.' => can\'t find method : '.$action);//@header('Location: error404');
                }
            }else{
                Logger::getInstance()->logFatal('Class '.__CLASS__. ' - controller file : '.$controllerQualified.' => can\'t be found  in : '.ROOT.'/app/Controller/');
                throw new InternalException('Class '.__CLASS__. ' - controller file : '.$controllerQualified.' => can\'t be found  in : '.ROOT.'/app/Controller/');
            }
            Logger::getInstance()->logInfo( 'end Class '.__CLASS__);
        }
        catch (InternalException $ie){
            //nothing to do now, just catch
        }
        catch (ResourceNotFoundException $re){ // If the resource could not be found
            new InternalException($re->getMessage());
        }   
        catch (MethodNotAllowedException $me){ // If the resource was found but the requested method is not allowed
            new InternalException($me->getMessage()); 
        }
    }
    
}

?>
