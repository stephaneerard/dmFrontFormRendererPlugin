<?php
/**
 * Description of dmFrontFormRendererPlugin
 *
 * @author TheCelavi
 */
class dmFrontFormRenderer {
    
    public static $TWO_COLUMNS_TABULAR = "twoColumnsTabular";

    protected $sections;
    protected $form;


    public function __construct(array $sections, $form) {
        $this->sections = $sections;
        $this->form = $form;
    }
    
    public function render($layout = "") {
        $helper = dm::getHelper();
        if ($layout == "") $layout = dmFrontFormRenderer::$TWO_COLUMNS_TABULAR;        
        return $helper->renderPartial('dmFrontFormRenderer', $layout, array(
            'sections'=>$this->sections, 
            'form'=>$this->form
                ));  
    }
    
    public static function getJavascripts($layout = "") {
        if ($layout == "") $layout = dmFrontFormRenderer::$TWO_COLUMNS_TABULAR;
        switch ($layout) {
            case dmFrontFormRenderer::$TWO_COLUMNS_TABULAR: {
                return array(
                    'lib.ui-tabs',
                    'core.tabForm',
                    '/dmFrontFormRendererPlugin/js/twoColumnsTabular.js'
                );
            } break;
        }
    }
    
    public static function getStylesheets($layout = "") {
        if ($layout == "") $layout = dmFrontFormRenderer::$TWO_COLUMNS_TABULAR;
        switch ($layout) {
            case dmFrontFormRenderer::$TWO_COLUMNS_TABULAR: {
                return array(
                    'lib.ui',
                    'lib.ui-tabs',
                    '/dmFrontFormRendererPlugin/css/dmFrontFormRenderer.css',
                    '/dmFrontFormRendererPlugin/css/twoColumnsTabular.css'
                );
            } break;            
        }
    }
}