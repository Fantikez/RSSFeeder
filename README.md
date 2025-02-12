# Installation guide
You need to have `docker` and `docker compose` on your system already installed.

Copy `.env.example` file into newly created `.env`.

Choose `127.0.0.1 rssfeeder.loc` and add it to `/etc/hosts` file on your OS (Tested on: `Ubuntu 22.04`, `Ubuntu 20.04`)

Default domain for the website is: `http://rssfeeder.loc:8082/`

## Installation
1) Change `server_name` in `./docker/nginx/rssfeeder.conf` to `Your_Domain`.
2) Run `docker compose up -d` for v2+ docker-compose or `docker-compose up -d` for others from `./docker/` directory.
3) Then run some commands in **PHP (php)** container. The container is accessed by `docker exec -ti php bash` command. P.s. **sammy** is default user.
4) In the **PHP** container you will be on **root (/)** directory of your project. And firstly run `composer install`. Secondly run `php artisan key:generate` for generation `APP_KEY` variable in the `.env` file. Next run `php artisan migrate`.
5) To generate Swagger api documentation run `php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"` after that `php artisan l5-swagger:generate`
6) Congrats, you have installed the project.

## NPM container commands
`docker compose run --rm npm run build` - to build Vue.js.

`docker compose run --rm npm install` - to install all packages.

`docker compose run --rm npm run dev` - to run in develop mode without build (seems like not working).

## Component versions
- **Nginx**: 1.24.0-alpine
- **PHP**: 8.3.3
- **NPM**: 10.5.0
- **MariaDB**: 11.3.2
- **Composer**: 2.7.1


# About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
