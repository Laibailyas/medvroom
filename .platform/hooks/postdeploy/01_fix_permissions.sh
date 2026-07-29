#!/bin/bash

mkdir -p /var/app/current/storage/framework/views
mkdir -p /var/app/current/storage/framework/cache
mkdir -p /var/app/current/storage/framework/sessions
mkdir -p /var/app/current/storage/logs
mkdir -p /var/app/current/bootstrap/cache

chown -R webapp:webapp /var/app/current/storage /var/app/current/bootstrap/cache /var/app/current/database
chmod -R 775 /var/app/current/storage /var/app/current/bootstrap/cache

if [ -f /var/app/current/database/database.sqlite ]; then
    chmod 664 /var/app/current/database/database.sqlite
fi

cd /var/app/current
su webapp -c 'php artisan config:clear'
su webapp -c 'php artisan cache:clear'
su webapp -c 'php artisan view:clear'
su webapp -c 'php artisan config:cache'