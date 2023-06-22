<?php declare(strict_types=1);

namespace PageBlocks;

use Omeka\Module\AbstractModule;
use Laminas\EventManager\SharedEventManagerInterface;
use PageBlocks\Form\TopicsListSidebarForm;

class Module extends AbstractModule
{
    /** Module body **/

    /**
     * Get this module's configuration array.
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function attachListeners(SharedEventManagerInterface $sharedEventManager) 
    {
        $sharedEventManager->attach(
            'Omeka\Controller\SiteAdmin\Page',
            'view.edit.before',
            [$this, 'addSidebar']
        );
    }
    
    function addSidebar($event) {
        $view = $event->getTarget();
        echo $view->sidebar('topic-sidebar', TopicsListSidebarForm::class);
    }
}

?>