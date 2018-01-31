
# Distance Mapper

Objetivo: Crear una aplicación WEB que calcule la distancia en millas náuticas entre dos aeropuertos de USA.

## Requisitos para la instalación
La aplicación WEB esta realizado con el framework de php LARAVEL, por tal motivo se necesita los siguientes requisitos para visualizar el proyecto.
- PHP 7
- COMPOSER
- Servidor WEB que soporte PHP
- Base de datos MySQL o PostgreSQL

## Instrucciones para la instalación

- Clonar el repositorio a la PC O MAC.
```
git clone https://github.com/MrDavidChz/distance-mapper.git
```

- Dar permisos a la carpeta STORAGE de nuestro proyecto
```
sudo chmod -R 755 storage
```

- Estando en la raíz del proyecto ejecutar el siguiente comando el cual se va encargar de instalar todas las dependencias de nuestro proyecto.

```
composer install
```

- Definiremos los datos de conexión a la base de datos en el archivo de configuración .env que se encuentra en la raíz de nuestro proyecto.

Ejemplo:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eloquent
DB_USERNAME=root
DB_PASSWORD=dev
```


- Realizar migración y ejecutar los seeders
```
php artisan migrate --seed
```

- En caso de ser necesario hay que Crear un virtualhost que apunte a la carpeta public que se encuentra en la raíz del proyecto para que la URL quede de la siguiente manera. ejemplo: http://distance-mapper.dev


## Instrucciones para el Usuario

- Al entrar a la página podrá ver el mapa de Estados Unidos y se verá un punto en forma de avión, este punto representa el Aeropuero de “Renner Field-Goodland Municipal”; se pudo encontrar un total de 778 aeropuertos de la unión americana, solo se muestra este punto en la pagina inicial con la finalidad de optimizar el tiempo de carga. 

![-](http://i67.tinypic.com/alhlp0.jpg)

- Al dar clic en la imagen en forma de avión nos aparecerá la información del aeropuerto tales como: nombre del aeropuerto,ciudad,país y el código IATA(International Air Transport Association).
- Para cerrar este cuadro basta con dar clic en el tache superior derecho.

![-](http://i67.tinypic.com/2nvgo6t.jpg)




- Para ver todos los aeropuertos de USA basta con dar clic en la leyenda “Ver lista de Aeropuertos”; esperamos unos segundos, debido a que se hace una petición y crea el mapa con sus respectivos puntos.

- Para salir de la lista solo se tiene que dar clic en el tache superior derecho.

![-](http://oi66.tinypic.com/2vb6hkz.jpg)

- Se puede elegir cualquier aeropuerto dando clic en su nombre y se podrá ver la localización exacta de ese aeropuerto.

![-](http://i65.tinypic.com/2d01htj.jpg)

- Para calcular las millas náuticas y trazar la ruta, solo hay que introducir el origen - destino y dar clic en “Calcular RUTA”.

![-](http://i65.tinypic.com/i372mp.jpg)
![-](http://oi63.tinypic.com/intour.jpg)

## Demo

Para ver el funcionamiento de la aplicación WEB, favor de dar clic en [DEMO](https://distance-mapper.herokuapp.com/).
