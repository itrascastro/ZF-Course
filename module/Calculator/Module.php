<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Calculator;


use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{
//    public function init(ModuleManager $moduleManager)
//    {
//        $sm = $moduleManager->getEvent()->getParam('ServiceManager');
//        $applicationConfig = $sm->get('applicationconfig');
//        var_dump($applicationConfig['modules']);
//    }

    public function onBootstrap(MvcEvent $event)
    {
        $sm = $event->getApplication()->getServiceManager();
        $config = $sm->get('config');
        $title = $config['application']['title'];
        $layout = $event->getViewModel();
        $layout->setVariable('title', $title);

//        $em = $event->getApplication()->getEventManager();
//        $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'));
    }

    public function onDispatch(MvcEvent $event)
    {
        echo 'onDispatch Event ' . $event->getRouteMatch()->getMatchedRouteName();
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
