<?php declare(strict_types=1);

namespace Shortcode;

use Omeka\Module\Exception\ModuleCannotInstallException;
use Omeka\Stdlib\Message;

/**
 * @var Module $this
 * @var \Laminas\ServiceManager\ServiceLocatorInterface $services
 */

if (!method_exists($this, 'getInstallResources')) {
    throw new ModuleCannotInstallException((string) new Message(
        'This module requires module %s version %s or greater.', // @translate
        'Generic',
        '3.3.30'
    ));
}

$installResources = $this->getInstallResources();

$module = __NAMESPACE__;
$filepath = dirname(__DIR__, 2) . '/data/vocabularies/curation.json';
$data = file_get_contents($filepath);
$data = json_decode($data, true);
$installResources->createOrUpdateVocabulary($data, $module);

$messenger = $services->get('ControllerPluginManager')->get('messenger');
$message = new Message(
    'The vocabulary "%s" was updated successfully.', // @translate
    pathinfo($filepath, PATHINFO_FILENAME)
);
$messenger->addSuccess($message);
