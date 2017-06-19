# Обертка для phpMorphy

## Установка
```bash
composer require serginhold/morphy
```
[Словари](http://phpmorphy.sourceforge.net/dokuwiki/download)

## Примеры
```php
$oMorphy = new \SerginhoLD\Morphy\Morphy();
var_dump($oMorphy->convertWord('Санкт-Петербург', $oMorphy::G_CASE_PREPOSITIONAL, MB_CASE_TITLE));
```
```
string(31) "Санкт-Петербурге"
```
```php
var_dump($oMorphy->convertWord('Набережные Челны', $oMorphy::G_CASE_PREPOSITIONAL));
```
```
string(33) "Набережных Челнах"
```
```php
var_dump($oMorphy->convertWord('Краснодар и Краснодарский край', $oMorphy::G_CASE_PREPOSITIONAL));
```
```
string(59) "Краснодаре и Краснодарском крае"
```