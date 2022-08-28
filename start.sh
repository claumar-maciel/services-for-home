#!/bin/bash

if ! [ -d "vendor" ]; then
    echo "Installing dependencies"

    composer install
fi

if [ -e "public/storage" ]; then
    rm public/storage
fi

php artisan storage:link
chmod -R 755 storage

php artisan serve --host 0.0.0.0 --port 8000
