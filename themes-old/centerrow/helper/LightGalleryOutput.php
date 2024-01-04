<?php 
namespace OmekaTheme\Helper;

use Laminas\View\Helper\AbstractHelper;

class LightGalleryOutput extends AbstractHelper
{
    public function __invoke($files = null) 
    {
        $view = $this->getView();
        $view->headScript()->prependFile($view->assetUrl('js/lightgallery.min.js'));
        $view->headScript()->appendFile($view->assetUrl('js/lg-thumbnail.js'));
        $view->headScript()->appendFile($view->assetUrl('js/lg-zoom.js'));
        $view->headScript()->appendFile($view->assetUrl('js/lg-video.js'));
        $view->headScript()->appendFile($view->assetUrl('js/lg-itemfiles-config.js'));
        $view->headLink()->prependStylesheet($view->assetUrl('css/lightgallery.min.css'));
        $escape = $view->plugin('escapeHtml');

        $html = '<ul id="itemfiles" class="media-list">';
        $mediaCaption = $view->themeSetting('media_caption');

        foreach ($files as $file) {
            $media = $file['media'];
            $source = ($media->originalUrl()) ? $media->originalUrl() : $media->source(); 
            $mediaCaptionOptions = [
                'none' => '',
                'title' => 'data-sub-html="' . $media->displayTitle() . '"',
                'description' => 'data-sub-html="'. $media->displayDescription() . '"'
            ];
            $mediaCaptionAttribute = ($mediaCaption) ? $mediaCaptionOptions[$mediaCaption] : '';
            $mediaType = $media->mediatype();
            if (strpos($mediaType, 'video') !== false) {
                $videoSrcObject = [
                    'source' => [
                        [
                            'src' => $source, 
                            'type' => $mediaType,
                        ]
                    ], 
                    'attributes' => [
                        'preload' => false, 
                        'playsinline' => true, 
                        'controls' => true,
                    ],
                ];
                if (isset($file['tracks'])) {
                    foreach ($file['tracks'] as $key => $track) {
                        $label = $track->displayTitle();
                        $srclang = ($track->value('Dublin Core, Language')) ? $track->value('dcterms:language') : '';
                        $type = ($track->value('Dublin Core, Type')) ? $track->value('dcterms:type') : 'captions';
                        $videoSrcObject['tracks'][$key]['src'] = $track->originalUrl();
                        $videoSrcObject['tracks'][$key]['label'] = $label;
                        $videoSrcObject['tracks'][$key]['srclang'] = $srclang;
                        $videoSrcObject['tracks'][$key]['kind'] = $type;
                    }
                }
                $videoSrcJson = json_encode($videoSrcObject);
                $html .=  '<li data-video="' . $escape($videoSrcJson) . '" ' . $mediaCaptionAttribute . 'data-thumb="' . $escape($media->thumbnailUrl('medium')) . '" data-download-url="' . $source . '" class="media resource">';
            } else if ($mediaType == 'application/pdf') {
                $html .=  '<li data-iframe="' . $escape($source) . '" '. $mediaCaptionAttribute . 'data-src="' . $source . '" data-thumb="' . $escape($media->thumbnailUrl('medium')) . '" data-download-url="' . $source . '" class="media resource">';
            } else {
                $html .=  '<li data-src="' . $source . '" ' . $mediaCaptionAttribute . 'data-thumb="' . $escape($media->thumbnailUrl('medium')) . '" data-download-url="' . $source . '" class="media resource">';
            }
            $html .= $media->render();
            $html .= '</li>';
        }
        $html .= '</ul>';

        return $html;
    }
}
