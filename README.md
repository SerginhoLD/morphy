# phpMorphy

## Установка
```bash
composer require serginhold/morphy
```
[Словари](http://phpmorphy.sourceforge.net/dokuwiki/download)

## Примеры
```php
$oMorphy = new \SerginhoLD\Morphy\Morphy();
var_dump($oMorphy->convertWord('Санкт-Петербург', PMY_RG_LOCATIV, MB_CASE_TITLE));
```
```
string(31) "Санкт-Петербурге"
```
```php
var_dump($oMorphy->convertWord('Набережные Челны', PMY_RG_LOCATIV));
```
```
string(33) "Набережных Челнах"
```
```php
var_dump($oMorphy->convertWord('Краснодар и Краснодарский край', PMY_RG_LOCATIV));
```
```
string(59) "Краснодаре и Краснодарском крае"
```