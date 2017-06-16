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
        
        /** @link http://phpmorphy.sourceforge.net/dokuwiki/manual-graminfo We use constants */
        /*if (isset($options['graminfo_as_text']) && $options['graminfo_as_text'] === false)
        {
            $this->oPhpMorphy->getBulkMorphier()->getHelper()->getGramTab()->includeConsts();
            require_once dirname(__DIR__) . '/consts/n.php';
        }
        else
        {
            require_once dirname(__DIR__) . '/consts/s.php';
        }*/
        require_once dirname(__DIR__) . '/consts/s.php';
    }
    
    /**
     * @return string
     */
    protected function getDefaultDir()
    {
        return realpath(__DIR__ . '/../../dicts');
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
     * @deprecated
     * @param string $string
     * @param mixed $grammers
     * @param int|null $convertMode MB_CASE_UPPER, MB_CASE_LOWER or MB_CASE_TITLE
     * @return string
     */
    public function convertStringOld($string, $grammers, $convertMode = null)
    {
        $grammers = (array)$grammers;
        $arWords = mb_split("\s", trim($string));
        
        $arNewWords = array_map(function($word) {
            return mb_strtoupper($word, 'UTF-8');
        }, $arWords);
        
        $isPlural = false;
        $oParadigms = $this->getPhpMorphy()->findWord($arNewWords[0]);
        
        foreach ($oParadigms as $oParadigm)
        {
            /** @var \phpMorphy_Paradigm_FsaBased $oParadigm */
            //$isPlural = $oParadigm->hasGrammems([PMY_RG_PLURAL]);
            $wordForm = $oParadigm->getFoundWordForm();
            
            if (isset($wordForm[0]))
                $isPlural = $wordForm[0]->hasGrammems([PMY_RG_PLURAL]);
            
            break;
        }
        
        $grammers[] = $isPlural ? PMY_RG_PLURAL : PMY_RG_SINGULAR;
        $arResult = [];
        
        foreach ($arNewWords as $i => $word)
        {
            $arForms = $this->getPhpMorphy()->getGramInfoMergeForms($word);
            
            if (in_array($arForms[0]['pos'], [PMY_RP_CONJ, PMY_RP_INTERJ, PMY_RP_PARTICLE], true))
                $arResult[] = $arWords[$i];
            else
                $arResult[] = $this->convertWord($arWords[$i], $grammers, $convertMode);
        }
        
        return implode(' ', $arResult);
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
        
            if (in_array($arForms[0]['pos'], [MORPHY_RP_CONJ, MORPHY_RP_INTERJ, MORPHY_RP_PARTICLE], true))
                $arResult[] = $arWords[$i];
            else
                $arResult[] = $this->convertWord($arWords[$i], $grammers, $convertMode);
        }
        
        return implode(' ', $arResult);
    }
    
    /**
     * @param string $word
     * @return int
     */
    public function getPseudoRootLength($word)
    {
        $rootWord = $this->getPhpMorphy()->getPseudoRoot(mb_strtoupper($word, 'UTF-8'));
        return mb_strlen($rootWord[0], 'UTF-8');
    }
}