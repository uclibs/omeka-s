<?php declare(strict_types=1);

namespace BulkImport\Form\Reader;

use BulkImport\Form\Element as BulkImportElement;
use Laminas\Form\Element;

class OpenDocumentSpreadsheetReaderConfigForm extends AbstractReaderConfigForm
{
    public function init(): void
    {
        parent::init();

        $this
            ->add([
                'name' => 'url',
                'type' => BulkImportElement\OptionalUrl::class,
                'options' => [
                    'label' => 'Spreadsheet url', // @translate
                ],
                'attributes' => [
                    'id' => 'url',
                    'required' => false,
                ],
            ])
            ->add([
                'name' => 'multisheet',
                'type' => Element\Radio::class,
                'options' => [
                    'label' => 'Sheets', // @translate
                    'value_options' => [
                        'active' => 'Active', // @translate
                        'first' => 'First', // @translate
                        'all' => 'All', // @translate
                    ],
                ],
                'attributes' => [
                    'id' => 'multisheet',
                    'required' => false,
                    'value' => 'active',
                ],
            ])
            ->add([
                'name' => 'separator',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Multi-value separator', // @translate
                    'info' => 'If cells are multivalued, it is recommended to use a character that is never used, like "|" or a random string.', // @translate
                ],
                'attributes' => [
                    'id' => 'separator',
                    'value' => '',
                ],
            ]);
    }
}
