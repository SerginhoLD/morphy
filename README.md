# phpMorphy

## Установка
```bash
composer require serginhold/morphy
```
[Словари](http://phpmorphy.sourceforge.net/dokuwiki/download)

## Пример
```php
$oMorphy = new \SerginhoLD\Morphy\Morphy();
var_dump($oMorphy->convert('Санкт-Петербург', $oMorphy::G_CASE_PREPOSITIONAL, MB_CASE_TITLE));
```
```
string(31) "Санкт-Петербурге"
```