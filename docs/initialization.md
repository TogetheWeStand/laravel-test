[« Оглавление](../README.md)

---

## Установка

Для разворачивания проекта должно быть установлено следущее ПО:
- [`make`](https://www.gnu.org/software/make/)
- [`Docker Engine`](https://docs.docker.com/engine/install/)
- [`Docker Compose`](https://docs.docker.com/compose/install/)

Далее выполняем (в директории проекта):

```
make init
```

В файл `/etc/hosts` добавляем запись:

```
127.0.0.1   test-app.loc
```

Если не устраивает имя хоста по умолчанию, заменяем название и в следующих файлах:

```
docker.local/nginx/default.conf
docker.local/php-fpm/Dockerfile
```

---
[« Оглавление](../README.md)
