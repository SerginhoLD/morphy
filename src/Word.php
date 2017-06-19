<?php
namespace SerginhoLD\Morphy;

/**
 * Class Word
 * @package SerginhoLD\Morphy
 */
class Word
{
    /** @var MorphyInterface */
    private $oMorphy;
    
    /** @var string */
    private $realWord;
    
    /** @var string */
    private $word;
    
    /** @var \phpMorphy_WordForm_WithFormNo */
    private $oForm = null;
    
    /**
     * Word constructor.
     * @param MorphyInterface $oMorphy
     * @param string $word
     */
    public function __construct(MorphyInterface $oMorphy, $word, $grammers = null)
    {
        $this->oMorphy = $oMorphy;
        $this->realWord = $word;
        $this->word = mb_strtoupper($word, 'UTF-8');
        $this->analyze();
    }
    
    /**
     * analyze
     */
    protected function analyze()
    {
        $arParadigms = $this->getPhpMorphy()->findWord($this->getWord());
        
        /** @var \phpMorphy_Paradigm_FsaBased $oParadigm */
        foreach ($arParadigms as $oParadigm)
        {
            /** @var \phpMorphy_WordForm_WithFormNo $oWordForm */
            foreach ($oParadigm as $oWordForm)
            {
                if ($oWordForm->getWord() === $this->getWord())
                {
                    //$this->arGrammers = $oWordForm->getGrammems();
                    $this->oForm = $oWordForm;
                    return;
                }
            }
        }
    }
    
    /**
     * @return string
     */
    public function getRealWord()
    {
        return $this->realWord;
    }
    
    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }
    
    /**
     * @return MorphyInterface
     */
    public function getMorphy()
    {
        return $this->oMorphy;
    }
    
    /**
     * @return \phpMorphy
     */
    public function getPhpMorphy()
    {
        return $this->oMorphy->getPhpMorphy();
    }
    
    /**
     * @return \phpMorphy_WordForm_WithFormNo
     * @throws \Exception
     */
    public function getForm()
    {
        if ($this->oForm instanceof \phpMorphy_WordForm_WithFormNo)
            return $this->oForm;
        
        throw new \Exception('form');
    }
    
    /**
     * @return array
     */
    public function getGrammers()
    {
        return $this->getForm()->getGrammems();
    }
    
    /**
     * @return bool
     */
    public function isSingular()
    {
        return in_array($this->getMorphy()::G_SINGULAR, $this->getGrammers(), true);
    }
    
    /**
     * @return bool
     */
    public function isPlural()
    {
        return in_array($this->getMorphy()::G_PLURAL, $this->getGrammers(), true);
    }
    
    /**
     * @return bool Одушевленное?
     */
    public function isAnimated()
    {
        return in_array($this->getMorphy()::G_ANIMATE, $this->getGrammers(), true);
    }
    
    /**
     * @return mixed
     */
    public function getGender()
    {
        $arGender = $this->getMorphy()::G_GENDER_LIST;
        
        $arGrammers =  array_values(array_filter($this->getGrammers(), function ($gender) use ($arGender) {
            return in_array($gender, $arGender, true);
        }));
        
        return !empty($arGrammers[0]) ? $arGrammers[0] : null;
    }
    
    /**
     * @return mixed Падеж
     */
    public function getCase()
    {
        $arCases = $this->getMorphy()::G_CASE_LIST;
        
        return array_values(array_filter($this->getGrammers(), function ($case) use ($arCases) {
            return in_array($case, $arCases, true);
        }))[0];
    }
    
    /**
     * @return mixed Семантический признак
     */
    public function getSemanticFeature()
    {
        $arFeatures = $this->getMorphy()::G_SF_LIST;
        
        $arGrammers = array_values(array_filter($this->getGrammers(), function ($feature) use ($arFeatures) {
            return in_array($feature, $arFeatures, true);
        }));
        
        return !empty($arGrammers[0]) ? $arGrammers[0] : null;
    }
    
    /**
     * @param mixed $grammers
     * @param int|null $convertMode MB_CASE_UPPER, MB_CASE_LOWER or MB_CASE_TITLE
     * @return string|null
     */
    public function convert($grammers, $convertMode = null)
    {
        $grammers = (array)$grammers;
        $oWord = $this;
        
        if (empty(array_intersect($grammers, $this->getMorphy()::G_GENDER_LIST)))
            $grammers = array_merge($grammers, (array)$oWord->getGender());
        
        if (empty(array_intersect($grammers, $this->getMorphy()::G_CASE_LIST)))
            $grammers = array_merge($grammers, (array)$oWord->getCase());
        
        if (empty(array_intersect($grammers, $this->getMorphy()::G_SF_LIST)))
            $grammers = array_merge($grammers, (array)$oWord->getSemanticFeature());
        
        $SINGULAR = $this->getMorphy()::G_SINGULAR;
        $PLURAL = $this->getMorphy()::G_PLURAL;
        
        if (empty(array_intersect($grammers, [$SINGULAR, $PLURAL])))
            $grammers[] = $oWord->isSingular() ? $SINGULAR : $PLURAL;
        
        $arForms = $this->getPhpMorphy()->castFormByGramInfo($oWord->getWord(), null, $grammers, false);
        
        if (empty($arForms))
            return null;//var_dump($arForms);
        
        $arFormWord = $arForms[0];
        
        if (count($arForms) > 1)
        {
            foreach ($arForms as $arForm)
            {
                if (count($arFormWord['grammems']) > count($arForm['grammems']))
                    $arFormWord = $arForm;
            }
        }
        
        $newWord = $arFormWord['form'];
        
        if ($convertMode !== null)
            return ($convertMode === MB_CASE_UPPER) ? $newWord : mb_convert_case($newWord, $convertMode, 'UTF-8');
        
        $pseudoRootLength = $this->getPhpMorphy()->getPseudoRoot($this->getWord());
        $pseudoRootLength = isset($pseudoRootLength[0]) ? mb_strlen($pseudoRootLength[0], 'UTF-8') : 0;
        return mb_substr($this->getRealWord(), 0, $pseudoRootLength, 'UTF-8') . mb_substr(mb_strtolower($newWord, 'UTF-8'), $pseudoRootLength, null, 'UTF-8');
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->realWord;
    }
}