Karika
======

## How to install

1. Clone this repository `git clone git@github.com:Qeti/Karika.git`
1. Setup permissions with [following way](http://symfony.com/doc/current/setup/file_permissions.html#using-acl-on-a-system-that-supports-setfacl-linux-bsd):

    ~~~
    $ HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
    # if this doesn't work, try adding `-n` option
    $ sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX /var/www
    $ sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX /var/www
    ~~~
1. Install dependencies and setup local environment: `composer install`
1. Create database manually with PostgreSQL or with command: `php bin/console doctrine:database:create`
1. Create database schema with command: `php bin/console doctrine:migrations:migrate`
1. Setup web server (root directory is `web`)
1. Open url <karika_url>/api/doc to view methods description.
1. Optionally for development environment. Fill database with fixtures: `php bin/console doctrine:fixtures:load`
1. For development: install node modules with `npm install`
1. For development: run `npm start`

