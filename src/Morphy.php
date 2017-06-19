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
    public function __construct(array $options = array(), $dir = null, $lang = 'ru_RU')
    {
        if ($dir === null)
            $dir = $this->getDefaultDir();
        
        $options['graminfo_as_text'] = true;
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
     * @param mixed $grammers
     * @param int|null $convertMode MB_CASE_UPPER, MB_CASE_LOWER or MB_CASE_TITLE
     * @return string|null
     */
    public function convertWord($word, $grammers, $convertMode = null)
    {
        return (new Word($this, $word))->convert($grammers, $convertMode);
    }
    
    /**
     * @param string $string
     * @param mixed $grammers
     * @param int|null $convertMode MB_CASE_UPPER, MB_CASE_LOWER or MB_CASE_TITLE
     * @return string
     */
    public function convertString($string, $grammers, $convertMode = null)
    {
        $grammers = (array)$grammers;
        $arWords = mb_split("\s", trim($string));
    
        $arNewWords = array_map(function($word) {
            return mb_strtoupper($word, 'UTF-8');
        }, $arWords);
        
        $arResult = [];
        
        foreach ($arNewWords as $i => $word)
        {
            $arForms = $this->getPhpMorphy()->getGramInfoMergeForms($word);
        
            if (in_array($arForms[0]['pos'], [static::P_CONJUNCTION, static::P_INTERJECTION, static::P_PARTICLE], true))
                $arResult[] = $arWords[$i];
            else
                $arResult[] = $this->convertWord($arWords[$i], $grammers, $convertMode);
        }
        
        return implode(' ', $arResult);
    }
}