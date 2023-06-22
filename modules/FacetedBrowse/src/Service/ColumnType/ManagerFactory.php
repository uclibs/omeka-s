<?php
namespace FacetedBrowse\Service\ColumnType;

use FacetedBrowse\ColumnType\Manager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $config = $services->get('Config');
        return new Manager($services, $config['faceted_browse_column_types']);
    }
}
