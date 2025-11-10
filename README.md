# Task service

Для работы на машине требуется Docker и Docker-compose

### Установка локально
Из корня проекта выполнить:
```sh
cp .env.example .env
docker compose up -d
docker compose run composer install --ignore-platform-req=ext-exif
sudo chmod 755 -R ./storage
docker compose run artisan key:generate
docker compose run artisan migrate --seed
```

Если все установлено верно, то можно будет работать с проектом по адресам:
```
приложение - localhost:8000

    "email": "test@example.com",
    "password": "password"


```

### Для удобства тестирования предусмотрена постман коллекция в корне проекта
```
   /tracker.postman_collection.json
```
