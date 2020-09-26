# LARATUBE #

### DESCRIPCION ###

Aplicacion web que muestra los videos en categorias like Netflix.
Tiene un panel, donde se pueden agregar canales de youtube, despues una cron job, recuperara todos los videos y datos de los videos del canal mediante la API v3 dee Youtube. 
Tambien en dicho panel, se podran añadir categorias, y posteriormente etiquetar los videos que pertenecen a ciertas categorias. Finalmente esos videos son los que se veran en nuestro raiz

### CONFIGURACION ###

Crear una base de datos en local y un usuario:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelvue
DB_USERNAME=laravel_user
DB_PASSWORD=123456

// Levantar la base de datos

Usar a continuacion:

// Para instalar crear las tablas
php artisan migrate

// Para añadir un usuario previo creado
php artisan db:seed


// Levantar el servidor
php artisan serve


### RUTAS ###

http://127.0.0.1:8000/ --> Raiz, donde se veran lo videos categorizados

http://127.0.0.1:8000/login --> donde se efectua el login

	user:kalua66@gmail.com
	pass:12345678

http://127.0.0.1:8000/home
http://127.0.0.1:8000/channels --> Aqui podemos añadir los canales de youtube, por el momento solo con el id de youtube channel: 
	
	id-channel:UCjMtc3v7g-jrAquecbt7OyA
	link-completo:https://www.youtube.com/channel/UCjMtc3v7g-jrAquecbt7OyA

	(sino se pone un CRON: se debe simular el cron:php artisan schedule:run)
	llamando hasta que registre los videos.

http://127.0.0.1:8000/videos --> Aqui podemos categorizar los videos, y obtener los datos del video si no se tienen.


### CONTACTO ###

kalua66@gmail.com