#!/bin/bash

docker stop my-dictionary-container || true
docker rm my-dictionary-container || true

sed -i 's/$host = "localhost";/$host = "172.17.0.1";/g' index.php

echo "FROM php:8.2-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
COPY . /var/www/html/
EXPOSE 80" > Dockerfile

docker build -t my-dictionary-image .

docker run -d -p 8081:80 --name my-dictionary-container my-dictionary-image
