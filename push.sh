#!/bin/bash

git commit -a -m "$1"
cp index.html flickr.php site.css /usr/share/nginx/www/
chown -R www-data:nginx /usr/share/nginx/www/

exit 0
