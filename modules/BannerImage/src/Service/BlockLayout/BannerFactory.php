<?php
namespace BannerImage\Service\BlockLayout;

use Interop\Container\ContainerInterface;
use BannerImage\Site\BlockLayout\Banner;
use Zend\ServiceManager\Factory\FactoryInterface;

class BannerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
	{
		return new Banner(
			$services->get('FormElementManager'),
			$services->get('Config')['DefaultSettings']['BannerBlockForm']
		);
	}
}
?>