<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Zend\ServiceManager\Di',
    'Zend\Session',
    'Zend\Mvc\Plugin\Prg',
    'Zend\Mvc\Plugin\Identity',
    'Zend\Mvc\Plugin\FlashMessenger',
    'Zend\Mvc\Plugin\FilePrg',
    'Zend\Mvc\I18n',
    'Zend\Mvc\Console',
    'Zend\Log',
    'Zend\Form',
    'Zend\Db',
    'Zend\Cache',
    'Zend\Router',
    'Zend\Validator',
    'ZendDeveloperTools',
    'Application',
    'Carteira',
];
