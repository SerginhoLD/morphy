<?php
namespace SerginhoLD\Morphy;

/**
 * Class Morphy
 * @package SerginhoLD\Morphy
 */
class Morphy
{
    /** Единственное число */
    const G_SINGULAR = 'ЕД';
    
    /** Множественное число */
    const G_PLURAL = 'МН';
    
    /** Именительный падеж */
    const G_CASE_NOMINATIVE = 'ИМ';
    
    /** Родительный падеж */
    const G_CASE_GENITIVE = 'РД';
    
    /** Дательныйпадеж */
    const G_CASE_DATIVE = 'ДТ';
    
    /** Винительный падеж */
    const G_CASE_ACCUSATIVE = 'ВН';
    
    /** Творительный падеж */
    const G_CASE_INSTRUMENTAL = 'ТВ';
    
    /** Предложный падеж */
    const G_CASE_PREPOSITIONAL = 'ПР';
    
    /** @var \phpMorphy */
    private $oPhpMorphy;
    
    /**
     * Morphy constructor.
     * @param array $options
     * @param string $lang
     * @param string $dir
     */
    public function __construct($options = array(), $lang = 'ru_RU', $dir = null)
    {
        if ($dir === null)
            $dir = dirname(__DIR__) . '/dicts';
        
        $this->oPhpMorphy = new \phpMorphy($dir, $lang, $options);
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
        $newWord = isset($arForms[0]) ? $arForms[0] : null;
        
        return ($convertMode === MB_CASE_UPPER) ? $newWord : mb_convert_case($newWord, $convertMode, 'UTF-8');
    }
}