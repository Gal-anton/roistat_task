# Тестовое задание Roistat
## Галичин Антон galichin-anton@yandex.ru

## Задание 
Имеется обычный http access_log файл.
Требуется написать PHP скрипт, обрабатывающий этот лог и выдающий информацию о нём в json виде.
Требуемые данные: количество хитов/просмотров, количество уникальных url, объем трафика, количество строк всего, количество запросов от поисковиков, коды ответов. Пример лог файла и ожидаемый вывод можно посмотреть здесь: https://gist.github.com/flrnull/7304afeb9e8a1f4faec3

# USAGE
## Запустите скрипт parser.php с одним агрументом - путь к файлу
```php parser.php access_log.txt```

# Покрытие тестов можно посмотреть здесь
```coverage/index.html```

# Результат команды 
```php parser.php access_log.txt```

```{"view":16,"url_count":5,"traffic":212816,"crawlers":{"Google":2,"Bing":0,"Baidu":0,"Yandex":0},"statusCode":{"200":14,"301":2}}```

# Диаграмма классов 
![img.png](img.png)
