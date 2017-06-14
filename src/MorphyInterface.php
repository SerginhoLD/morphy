<?php
namespace SerginhoLD\Morphy;

interface MorphyInterface
{
    /** Единственное число */
    const G_SINGULAR = 'ЕД';
    
    /** Множественное число */
    const G_PLURAL = 'МН';
    
    /** Именительный падеж */
    const G_CASE_NOMINATIVE = 'ИМ';
    
    /** Родительный падеж */
    const G_CASE_GENITIVE = 'РД';
    
    /** Дательный падеж */
    const G_CASE_DATIVE = 'ДТ';
    
    /** Винительный падеж */
    const G_CASE_ACCUSATIVE = 'ВН';
    
    /** Творительный падеж */
    const G_CASE_INSTRUMENTAL = 'ТВ';
    
    /** Предложный падеж */
    const G_CASE_PREPOSITIONAL = 'ПР';
    
    /**
     * Morphy constructor.
     * @param array $options
     * @param string $dir
     * @param string $lang
     */
    public function __construct($options = array(), $dir = null, $lang = 'ru_RU');
    
    /**
     * @return \phpMorphy
     */
    public function getPhpMorphy();
    
    /**
     * @param string $word
     * @param array|string $options
     * @param int $convertMode MB_CASE_UPPER, MB_CASE_LOWER or MB_CASE_TITLE
     * @return string|null
     */
    public function convert($word, $options, $convertMode = MB_CASE_LOWER);
}