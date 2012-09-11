#!/bin/bash

git commit -a -m "$1"
cp * /usr/share/nginx/www/
chown -R www-data:nginx /usr/share/nginx/www/

exit 0
