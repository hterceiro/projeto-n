#!/bin/sh

composer install

exec /usr/sbin/apachectl -DFOREGROUND