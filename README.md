
#Instrucciones para ejecución del código

Este proyecto se contruyo con docker y se deben ejecutar los siguientes pasos:

## Instalacion

```bash
  git clone https://github.com/nelopez35/cognox-test
  cd cognox-test

  #Se ejecuta toda la instalcion de docker
  docker-compose up -d --build

  #Se ingresa al contenedor de php
  docker exec -it container_name bash

  #Se instalan las dependencias de laravel
  composer install

  #Se renombra archivo env.example por .env
  #La conexion a la BD se configura de la siguiente manera:
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel_local
    DB_USERNAME=phper
    DB_PASSWORD=secret
    
  #Se genera la key necesaria para laravel:
  php artisan key:generate

  #Se ejecutan las migraciones
  php artisan migrate

  #Se ejecutan los seeders para la data inicial:
  php artisan db:seed --class=CreateUserSeeder
  php artisan db:seed --class=CreateUserSeeder
  php artisan db:seed --class=CreateUserAccountSeeder
  php artisan db:seed --class=ExternalAccountsSeeder 
  
  
  #Se compila js y css del frontend:
  npm install && npm run dev

```

Y listo!



## Url del sitio

El sitio esta configurado por defecto en el puerto 8000
```bash
  http://localhost:8000
  
  #Puedes loguearte con el usuario 1234567890 y clave 1234
```


## Extras

Se agregó el patrón service y repositorios a laravel para una mejor organización del
código, se realizaron pruebas unitarias del login, pendientes las restantes vistas.