#!/bin/sh

composer install
php bin/console doctrine:mongodb:schema:update

chmod 777 -R var/

exec /usr/sbin/apachectl -DFOREGROUND