<a href="URL_REDIRECT" target="blank"><img align="center" src="https://github.com/victorFernandez173/filmXtra-vue/blob/main/public/images/logo-blanco.png?raw=true" height="100" /></a>

# filmxtra

Proyecto propio sin animo de lucro y puramente didáctico de una web de cine responsiva con diferentes funcionalidades basada en laravel 11, vue 3 e inertia: 

- Login y registro de usuarios con emails de verificacion, bienvenida, eliminación de cuenta...
- Uso de librerías Node variadas para diferentes funcionalidades: jquery, axios, sweetalert2, flowbite, dayjs...
- Responsividad global para todos los tamaños de pantalla
- Estilos con tailwind
- Control vía middleware de las posibilidades de accion de los usuarios
- Uso de librerias variadas de composer: o'auth para el acceso mediante Google/Git...
- Paginación por scrolling infinita con cursor de laravel en sección top pero también paginación tradicional...
- Elementos reactivos vue3...

Testeada y funcionando


## instalación 
### tienes que tener php, composer, npm y mysql 
#### también puedes hacerlo mediante sail la solución basada en docker de laravel

1. Clona el proyecto (también puedes via ssh dada una configuración adecuada)
```
git clone https://github.com/victorFernandez173/filmXtra-vue.git
```
2. Instalar composer dependencias
```
composer install
```
3. Instalar npm dependencias
```
npm install
```
4. Clona el .env.example
```
cp .env.example .env
```
5. Añade las variables necesarias para la configuración 
(te indico las más importantes para que la app funcione...):
   + DB_USERNAME para tu usuario de bbdd
   + DB_PASSWORD su clave
   + 
7. Genera una clave de app
```
php artisan key:generate
``` 
7. Aplica las migraciones
```
php artisan migrate
``` 
8. Aplica los inserts (necesarios)
+ En el directorio /public encontraras inserts.sql 
9. Arranca el servidor de desarrollo
```
php artisan serve
```
10. Arranca vite para que los assets se compilen en tiempo real
```
npm run dev
```
