<?php declare(strict_types=1);

namespace AdvancedResourceTemplate\Service\Controller\Admin;

use AdvancedResourceTemplate\Controller\Admin\IndexController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new IndexController(
            $services->get('Autofiller\Manager'),
            $services->get('Omeka\EntityManager')
        );
    }
}
