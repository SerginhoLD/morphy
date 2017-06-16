<?php
namespace SerginhoLD\Morphy;

/**
 * Interface MorphyInterface
 * @package SerginhoLD\Morphy
 */
interface MorphyInterface
{
    /**
     * @return \phpMorphy
     */
    public function getPhpMorphy();
    
    /**
     * @param string $word
     * @param mixed $grammers
     * @param int|null $convertMode MB_CASE_UPPER, MB_CASE_LOWER or MB_CASE_TITLE
     * @return string|null
     */
    public function convertWord($word, $grammers, $convertMode = null);
    
    /**
     * @param string $string
     * @param mixed $grammers
     * @param int|null $convertMode MB_CASE_UPPER, MB_CASE_LOWER or MB_CASE_TITLE
     * @return string
     */
    public function convertString($string, $grammers, $convertMode = null);
}