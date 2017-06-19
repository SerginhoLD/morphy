<?php
namespace SerginhoLD\Morphy;

/**
 * Interface MorphyInterface
 * @package SerginhoLD\Morphy
 */
interface MorphyInterface
{
    /** Единственное число */
    const G_SINGULAR = 'ЕД';
    
    /** Множественное число */
    const G_PLURAL = 'МН';
    
    /** Одушевленное */
    const G_ANIMATE = 'ОД';
    
    /** Неодушевленное */
    const G_INANIMATE = 'НО';
    
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
    
    /** Звательный падеж */
    const G_CASE_VOCATIVE = 'ЗВ';
    
    /** Второй родительный или второй предложный падежи */
    const G_CASE_SECOND = '2';
    
    /** Список падежей */
    const G_CASE_LIST = [
        self::G_CASE_NOMINATIVE,
        self::G_CASE_GENITIVE,
        self::G_CASE_DATIVE,
        self::G_CASE_ACCUSATIVE,
        self::G_CASE_INSTRUMENTAL,
        self::G_CASE_PREPOSITIONAL,
        self::G_CASE_VOCATIVE,
        self::G_CASE_SECOND,
    ];
    
    /** Мужской род */
    const G_GENDER_MASCULINE = 'МР';
    
    /** Женский род */
    const G_GENDER_FEMININE = 'ЖР';
    
    /** Средний род */
    const G_GENDER_NEUTER = 'СР';
    
    /** Общий род */
    const G_GENDER_COMMON = 'МР-ЖР';
    
    /** Список полов */
    const G_GENDER_LIST = [
        self::G_GENDER_MASCULINE,
        self::G_GENDER_FEMININE,
        self::G_GENDER_NEUTER,
        self::G_GENDER_COMMON,
    ];
    
    /** Имя */
    const G_SF_NAME = 'ИМЯ';
    
    /** Фамилия */
    const G_SF_SURNAME = 'ФАМ';
    
    /** Отчество */
    const G_SF_PATRONYMIC = 'ОТЧ';
    
    /** Топоним */
    const G_SF_TOPONYM = 'ЛОК';
    
    /** Аббревиатура */
    const G_SF_ABBREVIATION = 'АББР';
    
    /** Организация */
    const G_SF_ORGANISATION = 'ОРГ';
    
    /** Вопросительное наречие */
    const G_SF_INTERROGATIVE = 'ВОПР';
    
    /** Указательное наречие */
    const G_SF_INDICATIVE = 'УКАЗАТ';
    
    /** Жаргонизм */
    const G_SF_SLANG = 'ЖАРГ';
    
    /** Разговорный */
    const G_SF_COLLOQUIAL = 'РАЗГ';
    
    /** Архаизм */
    const G_SF_ARCHAISM = 'АРХ';
    
    /** Опечатка */
    const G_SF_MISPRINT = 'ОПЧ';
    
    /** Поэтическое */
    const G_SF_POETIC = 'ПОЭТ';
    
    /** Профессионализм */
    const G_SF_PROFESSIONALISM = 'ПРОФ';
    
    /** Семантические признаки */
    const G_SF_LIST = [
        self::G_SF_NAME,
        self::G_SF_SURNAME,
        self::G_SF_PATRONYMIC,
        self::G_SF_TOPONYM,
        self::G_SF_ABBREVIATION,
        self::G_SF_ORGANISATION,
        self::G_SF_INTERROGATIVE,
        self::G_SF_INDICATIVE,
        self::G_SF_SLANG,
        self::G_SF_COLLOQUIAL,
        self::G_SF_ARCHAISM,
        self::G_SF_MISPRINT,
        self::G_SF_POETIC,
        self::G_SF_PROFESSIONALISM,
    ];
    
    /** Существительное */
    const P_NOUN = 'C';
    
    /** Прилагательное */
    const P_ADJECTIVE = 'П';
    
    /** Краткое прилагательное */
    const P_ADJECTIVE_SHORT = 'КР_ПРИЛ';
    
    /** Инфинитив */
    const P_INFINITIVE = 'ИНФИНИТИВ';
    
    /** Глагол в личной форме */
    const P_VERB = 'Г';
    
    /** Деепричастие */
    const P_ADVERB_PARTICIPLE = 'ДЕЕПРИЧАСТИЕ';
    
    /** Причастие */
    const P_PARTICIPLE = 'ПРИЧАСТИЕ';
    
    /** Краткое причастие */
    const P_PARTICIPLE_SHORT = 'КР_ПРИЧАСТИЕ';
    
    /** Числительное (количественное) */
    const P_NUMERAL = 'ЧИСЛ';
    
    /** Порядковое числительное */
    const P_NUMERAL_ORDER = 'ЧИСЛ-П';
    
    /** Местоимение-существительное */
    const P_PRONOUN = 'МС';
    
    /** Местоимение-предикатив */
    const P_PRONOUN_PREDICATE = 'МС-ПРЕДК';
    
    /** Наречие */
    const P_ADVERB = 'Н';
    
    /** Предикатив */
    const P_PREDICATE = 'ПРЕДК';
    
    /** Предлог */
    const P_PREPOSITION = 'ПРЕДЛ';
    
    /** Союз */
    const P_CONJUNCTION = 'СОЮЗ';
    
    /** Междометие */
    const P_INTERJECTION = 'МЕЖД';
    
    /** Частица */
    const P_PARTICLE = 'ЧАСТ';
    
    /** Вводное слово */
    const P_INP = 'ВВОДН';
    
    /** Фразеологизм */
    const P_PHRASE = 'ФРАЗ';
    
    /** Части речи */
    const PARTS_OF_SPEECH = [
        self::P_NOUN,
        self::P_ADJECTIVE,
        self::P_ADJECTIVE_SHORT,
        self::P_INFINITIVE,
        self::P_VERB,
        self::P_ADVERB_PARTICIPLE,
        self::P_PARTICIPLE,
        self::P_PARTICIPLE_SHORT,
        self::P_NUMERAL,
        self::P_NUMERAL_ORDER,
        self::P_PRONOUN,
        self::P_PRONOUN_PREDICATE,
        self::P_ADVERB,
        self::P_PREDICATE,
        self::P_PREPOSITION,
        self::P_CONJUNCTION,
        self::P_INTERJECTION,
        self::P_PARTICLE,
        self::P_INP,
        self::P_PHRASE,
    ];
    
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