<?php declare(strict_types=1);

return [
    'owner' => null,
    'label' => 'TSV (tab-separated values) - Item sets', // @translate
    'config' => [],
    'readerClass' => \BulkImport\Reader\TsvReader::class,
    'readerConfig' => [
        'separator' => '|',
    ],
    'processorClass' => \BulkImport\Processor\ItemSetProcessor::class,
    'processorConfig' => [
        'entries_to_skip' => 0,
        'entries_max' => null,
        'o:resource_template' => '',
        'o:resource_class' => '',
        'o:owner' => "current",
        'o:is_public' => null,
        'action' => 'create',
        'action_unidentified' => 'skip',
        'identifier_name' => [
            'o:id',
        ],
        'allow_duplicate_identifiers' => false,
        'resource_name' => '',
    ],
];
