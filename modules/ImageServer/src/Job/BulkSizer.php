<?php declare(strict_types=1);

namespace ImageServer\Job;

use Omeka\Job\AbstractJob;
use Omeka\Stdlib\Message;

class BulkSizer extends AbstractJob
{
    use SizerTrait;

    /**
     * Limit for the loop to avoid heavy sql requests.
     *
     * @var int
     */
    const SQL_LIMIT = 25;

    /**
     * @var int
     */
    protected $totalImages;

    /**
     * @var int
     */
    protected $totalProcessed;

    /**
     * @var int
     */
    protected $totalToProcess;

    public function perform(): void
    {
        /** @var \Omeka\Api\Manager $api */
        $services = $this->getServiceLocator();
        $api = $services->get('Omeka\ApiManager');

        $query = $this->getArg('query', []);

        $response = $api->search('items', $query);
        $this->totalToProcess = $response->getTotalResults();
        if (empty($this->totalToProcess)) {
            $this->logger->warn(new Message(
                'No item selected. You may check your query.' // @translate
            ));
            return;
        }

        $this->prepareSizer();

        $this->logger->info(new Message(
            'Starting bulk sizing for %1$d items (%2$s media).', // @translate
            $this->totalToProcess, $this->filter
        ));

        $offset = 0;
        $this->totalImages = 0;
        $this->totalProcessed = 0;
        $this->totalSucceed = 0;
        $this->totalFailed = 0;
        $this->totalSkipped = 0;
        while (true) {
            /** @var \Omeka\Api\Representation\ItemRepresentation[] $items */
            $items = $api
                ->search('items', ['limit' => self::SQL_LIMIT, 'offset' => $offset] + $query)
                ->getContent();
            if (empty($items)) {
                break;
            }

            foreach ($items as $key => $item) {
                if ($this->shouldStop()) {
                    $this->logger->warn(new Message(
                        'The job "Bulk Sizer" was stopped: %1$d/%2$d resources processed.', // @translate
                        $offset + $key, $this->totalToProcess
                    ));
                    break 2;
                }

                /** @var \Omeka\Api\Representation\MediaRepresentation $media */
                foreach ($item->media() as $media) {
                    if (strtok((string) $media->mediaType(), '/') === 'image') {
                        ++$this->totalImages;
                        $this->prepareSize($media);
                    }
                    unset($media);
                }
                unset($item);

                ++$this->totalProcessed;
            }

            $this->entityManager->clear();
            $offset += self::SQL_LIMIT;
        }

        $this->logger->notice(new Message(
            'End of bulk sizing: %1$d/%2$d items processed, %3$d files sized, %4$d errors, %5$d skipped on a total of %6$d images.', // @translate
            $this->totalProcessed,
            $this->totalToProcess,
            $this->totalSucceed,
            $this->totalFailed,
            $this->totalSkipped,
            $this->totalImages
        ));
    }
}
