FROM php:7.0-fpm-alpine

RUN apk add --update curl openssl zlib-dev apache2-proxy git && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

RUN docker-php-ext-install zip

RUN sed -i -r 's/(LoadModule.*mod_mpm_prefork.so)/#\1/' /etc/apache2/httpd.conf
RUN sed -i -r 's/#(LoadModule.*mod_mpm_event.so)/\1/' /etc/apache2/httpd.conf
RUN sed -i -r 's/#(LoadModule.*mod_rewrite.so)/\1/' /etc/apache2/httpd.conf

RUN echo "php_admin_value[date.timezone] = \"America/Sao_Paulo\"">>/usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_value[display_errors] = On">>/usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_value[error_reporting] = E_ALL & ~E_DEPRECATED">>/usr/local/etc/php-fpm.d/www.conf
RUN echo "LoadModule slotmem_shm_module modules/mod_slotmem_shm.so">/etc/apache2/conf.d/slotmem_shm.conf

ADD ./default.apache.conf /etc/apache2/conf.d/www.conf
ADD ./app.ini /usr/local/etc/php/conf.d/
ADD ./www.pool.conf /usr/local/etc/php-fpm.d/

EXPOSE 80

RUN mkdir /run/apache2

ENTRYPOINT httpd && php-fpm -F
