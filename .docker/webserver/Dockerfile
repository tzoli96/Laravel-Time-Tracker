FROM nginx:stable-alpine

ARG UID=1000
ARG GID=1000

ENV UID=${UID}
ENV GID=${GID}

RUN delgroup dialout

RUN addgroup -g ${GID} --system laravel
RUN adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel
COPY ./.docker/webserver/nginx/default.conf /etc/nginx/conf.d/
RUN sed -i "s/user  nginx/user laravel/g" /etc/nginx/default.conf


RUN mkdir -p /var/www/html