<?php
namespace SerginhoLD\Morphy;

class Grammers
{
    public static function getGenderList()
    {
        return [
            MORPHY_RG_MASCULINUM,
            MORPHY_RG_FEMINUM,
            MORPHY_RG_NEUTRUM,
            MORPHY_RG_MASC_FEM,
        ];
    }
    
    public static function getCases()
    {
        return [
            MORPHY_RG_NOMINATIV,
            MORPHY_RG_GENITIV,
            MORPHY_RG_DATIV,
            MORPHY_RG_ACCUSATIV,
            MORPHY_RG_INSTRUMENTALIS,
            MORPHY_RG_LOCATIV,
        ];
    }
    
    public static function getSemanticFeatures()
    {
        return [
            MORPHY_RG_NAME,
            MORPHY_RG_SUR_NAME,
            MORPHY_RG_PATRONYMIC,
            MORPHY_RG_TOPONYM,
            MORPHY_RG_INITIALISM,
            MORPHY_RG_ORGANISATION,
            MORPHY_RG_INTERROGATIVE,
            MORPHY_RG_DEMONSTRATIVE,
            MORPHY_RG_SLANG,
            MORPHY_RG_COLLOQUIAL,
            MORPHY_RG_ARCHAISM,
            MORPHY_RG_MISPRINT,
            MORPHY_RG_POETRY,
            MORPHY_RG_PROFESSION,
            //MORPHY_RG_POSITIVE,
        ];
    }
}