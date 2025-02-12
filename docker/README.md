# Enogamma installation guide
## Prerequisites
You need to have `docker` and `docker compose` on your system already installed.
- **Docker** version: e.g. `25.0.0`, `24.0.5` (Tested on)
- **Docker compose** version: e.g. `v2.24.1`, `1.25.0` (Tested on)

Copy `.env.example` file into newly created `.env`.

Choose `Your_Domain` and add it to `/etc/hosts` file on your OS (Tested on: `Ubuntu 22.04`, `Ubuntu 20.04`)

Default domain for the website is: `http://enogamma.loc:8085`

## Installation
1) Change `server_name` in `./docker/nginx/enogamma.conf` to `Your_Domain`.
2) Run `docker compose up -d` for v2+ docker-compose or `docker-compose up -d` for others from `./docker/` directory.
3) Then run some commands in **PHP (enogamma-app)** container. The container is accessed by `docker exec -ti enogamma-app bash` command. P.s. **sammy** is default user as like magento.
4) In the **PHP** container you will be on **root (/)** directory of your project. And firstly run `composer install`. Secondly run `php artisan key:generate` for generation `APP_KEY` variable in the `.env` file.
5) Congrats, you have installed the project.

## Component versions
- **Nginx**: 1.24.0
- **PHP**: 8.3.2
- **Composer**: 2.6.6
