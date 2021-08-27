<?php 

namespace CSSEditor;

use Omeka\Module\AbstractModule;
use Zend\EventManager\Event;
use Zend\EventManager\SharedEventManagerInterface;

class Module extends AbstractModule 
{
    public function getConfig()
    {
        return include __DIR__.'/config/module.config.php';
    }

    public function addCSS(Event $event) 
    {
        $view = $event->getTarget();
        $view->headLink()->appendStylesheet($view->url('site/css-editor', [
            'site-slug' => $view->site->slug(),
        ]));

        $services = $this->getServiceLocator();
        $siteSettings = $services->get('Omeka\Settings\Site');
        $externalCss = $siteSettings->get('css_editor_external_css');
        if ($externalCss) {
            foreach ($externalCss as $uri) {
                $view->headLink()->appendStylesheet($uri);
            }
        }
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $controllers = [
            'Omeka\Controller\Site\Index',
            'Omeka\Controller\Site\Item',
            'Omeka\Controller\Site\ItemSet',
            'Omeka\Controller\Site\Media',
            'Omeka\Controller\Site\Page',
        ];

        foreach ($controllers as $controller) {          
            $sharedEventManager->attach($controller, 'view.layout', [$this, 'addCSS']);
        }
    }
} 

?>
