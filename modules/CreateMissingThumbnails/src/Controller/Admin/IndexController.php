<?php

namespace CreateMissingThumbnails\Controller\Admin;

use CreateMissingThumbnails\Form\Admin\CreateMissingThumbnailsForm;
use CreateMissingThumbnails\Job\CreateMissingThumbnails;
use Omeka\Stdlib\Message;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $form = $this->getForm(CreateMissingThumbnailsForm::class);

        if ($this->getRequest()->isPost()) {
            $query = $this->params()->fromPost();

            $job = $this->jobDispatcher()->dispatch(CreateMissingThumbnails::class, ['query' => $query]);

            $jobUrl = $this->url()->fromRoute('admin/id', [
                'controller' => 'job',
                'action' => 'show',
                'id' => $job->getId(),
            ]);

            $message = new Message(
                $this->translate('Thumbnails creation has started. %s'),
                sprintf(
                    '<a href="%s">%s</a>',
                    htmlspecialchars($jobUrl),
                    $this->translate('Go to background job')
                )
            );
            $message->setEscapeHtml(false);
            $this->messenger()->addSuccess($message);
            return $this->redirect()->toRoute(null, [], [], true);
        }
    }
}
