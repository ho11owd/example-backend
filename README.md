# Example Backend (example-backend)

Laravel 7+ project to use with a Quasar app.

## Local setup

### Install the dependencies

```bash
composer ins
npm install
```

### Setup `.env` file

```bash
cp .env.example .env
##
# adjust database settings to use sqlite or mysql
##
vim .env
##
# generate APP_KEY
##
php artisan key:generate
```

### Run migrations + seeding

```bash
php artisan migrate --seed
```

### Setup in webserver and `/etc/hosts`

-   Add a VirtualHost for `example.local` in your Apache or nginx configuration.
-   Add the mapping in `etc/hosts` or `C:\Windows\System32\drivers\etc\hosts`(in Windows).

### Almost there

Next set up the Quasar app from [here](https://github.com/training-yoyosan/example-frontend).

Now access the application at http://localhost:8080.

## Deployment in production

### Setup

```bash
# install dependencies
composer ins
yarn

# setup env
cp .env.production .env
##
# Adjust the following:
# - APP_URL
# - SANCTUM_STATEFUL_DOMAINS
# - SESSION_DOMAIN
# - Database related vars
##
vim .env
php artisan key:generate

# run migrations
php artisan migrate --seed
```

**Note**: You're going to use a subdomain for the backend.

That's it.
