развертывание

1 docker compose up -d
2 внутри контейнера main выполнить команду composer install
3 скопировать .env.example в .env и заполнить новый файл настоящими данными для подключения (в данном случае бд, данные для подключения к контейнеру базы в явном виде указаны в описании контейнера в docker-compose.yml)
4 можно убедиться, что все прошло правильно (если раннее ошибок не было) зайдя на localhost:3008 и увидев стартовую страницу laravel
5 описание методов api

Пользователь

Создание
localhost:3008/api/users 
метод post
параметры
first_name
surname
phone_number
avatar (не является обязательным)
ответ
пустой json массив, http код 200 - в случае положительном, при ошибках - текст ошибки и соответствующий код ошибки

Удаление
метод delete
localhost:3008/api/users/{id пользователя}
ответ
пустой json массив, http код 200 - в случае положительном, при ошибках - текст ошибки и соответствующий код ошибки

Обновление
метод patch/put
localhost:3008/api/users/{id пользователя}
параметры
first_name
surname
phone_number
avatar (не является обязательным)
ответ
пустой json массив, http код 200 - в случае положительном, при ошибках - текст ошибки и соответствующий код ошибки

Компания

Создание
localhost:3008/api/companies
метод post
параметры
name
description
logo (не является обязательным)
ответ
пустой json массив, http код 200 - в случае положительном, при ошибках - текст ошибки и соответствующий код ошибки

Удаление
метод delete
localhost:3008/api/companies/{id компании}
ответ
пустой json массив, http код 200 - в случае положительном, при ошибках - текст ошибки и соответствующий код ошибки

Обновление
метод patch/put
localhost:3008/api/companies
параметры
name
description
logo (не является обязательным)
ответ
пустой json массив, http код 200 - в случае положительном, при ошибках - текст ошибки и соответствующий код ошибки

Получение списка 10 лучших компаний
метод get
localhost:3008/api/companies/best
ответ json объект с полями - название компании, значением поля - оценкой компании

Получение рейтинга организации
метод get
localhost:3008/api/companies/{id компании}/rating
ответ json объект с полем rating и значением - оценкой

Получение списка отзывов о компании
метод get
localhost:3008/api/companies/{id компании}/comments?page={page}
*добавлена постраничная навигация на случай большого количества комментариев (количество элементов на странице - настраиваемо), пример ответа
```
{
    "current_page": 2,
    "data": [
        {
            "body": "fdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfvfdvdfv"
        }
    ],
    "first_page_url": "http://localhost:3008/api/companies/1/comments?page=1",
    "from": 2,
    "last_page": 4,
    "last_page_url": "http://localhost:3008/api/companies/1/comments?page=4",
    "links": [
        {
            "url": "http://localhost:3008/api/companies/1/comments?page=1",
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:3008/api/companies/1/comments?page=1",
            "label": "1",
            "active": false
        },
        {
            "url": "http://localhost:3008/api/companies/1/comments?page=2",
            "label": "2",
            "active": true
        },
        {
            "url": "http://localhost:3008/api/companies/1/comments?page=3",
            "label": "3",
            "active": false
        },
        {
            "url": "http://localhost:3008/api/companies/1/comments?page=4",
            "label": "4",
            "active": false
        },
        {
            "url": "http://localhost:3008/api/companies/1/comments?page=3",
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": "http://localhost:3008/api/companies/1/comments?page=3",
    "path": "http://localhost:3008/api/companies/1/comments",
    "per_page": 1,
    "prev_page_url": "http://localhost:3008/api/companies/1/comments?page=1",
    "to": 2,
    "total": 4
}
```

Отзыв

Создание
localhost:3008/api/comments
метод post
параметры
user_id
company_id
body
rating
ответ
пустой json массив, http код 200 - в случае положительном, при ошибках - текст ошибки и соответствующий код ошибки

Удаление
метод delete
localhost:3008/api/comments/{id отзыва}
ответ
пустой json массив, http код 200 - в случае положительном, при ошибках - текст ошибки и соответствующий код ошибки

Обновление
метод patch/put
localhost:3008/api/comments/{id отзыва}
параметры
user_id
company_id
body
rating
ответ
пустой json массив, http код 200 - в случае положительном, при ошибках - текст ошибки и соответствующий код ошибки

для примера добавлена postman коллекция laravel 10 crud.postman_collection.json