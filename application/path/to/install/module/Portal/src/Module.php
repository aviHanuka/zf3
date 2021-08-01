<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Portal;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\I18n\Translator\Translator;

class Module implements ConfigProviderInterface, BootstrapListenerInterface
{
    const VERSION = '3.1.3';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap( EventInterface $e ) {
//	    $translator = new Translator();
//	    $type = "Gettext";
//	    $textDomain = "Portal";
//	    $pattern = '%s/text.mo';
//	    $translator->addTranslationFilePattern($type, __DIR__ . '/../language', $pattern, $textDomain);

	    // TODO: Implement onBootstrap() method.
    }
}
