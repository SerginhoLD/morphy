<?php
namespace SerginhoLD\Morphy;

/**
 * Class Morphy
 * @package SerginhoLD\Morphy
 */
class Morphy implements MorphyInterface
{
    /** @var \phpMorphy */
    private $oPhpMorphy;
    
    /**
     * Morphy constructor.
     * @param array $options
     * @param string $dir
     * @param string $lang
     */
    public function __construct($options = array(), $dir = null, $lang = 'ru_RU')
    {
        if ($dir === null)
            $dir = $this->getDefaultDir();
        
        $this->oPhpMorphy = new \phpMorphy($dir, $lang, $options);
    }
    
    /**
     * @return string
     */
    protected function getDefaultDir()
    {
        return dirname(__DIR__) . '/dicts';
    }
    
    /**
     * @return \phpMorphy
     */
    public function getPhpMorphy()
    {
        return $this->oPhpMorphy;
    }
    
    /**
     * @param string $word
     * @param array|string $options
     * @param int $convertMode MB_CASE_UPPER, MB_CASE_LOWER or MB_CASE_TITLE
     * @return string|null
     */
    public function convert($word, $options, $convertMode = MB_CASE_LOWER)
    {
        $word = mb_strtoupper($word, 'UTF-8');
        $options = (array)$options;
        $arForms = $this->getPhpMorphy()->castFormByGramInfo($word, null, $options, true);
        
        if (!isset($arForms[0]))
            return null;
        
        return ($convertMode === MB_CASE_UPPER) ? $arForms[0] : mb_convert_case($arForms[0], $convertMode, 'UTF-8');
    }
}