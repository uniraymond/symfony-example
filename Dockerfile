FROM studionone/apache-php5:base

RUN sudo apt-get update
RUN sudo apt-get -y install php5-intl vim git

ADD code /var/www

RUN usermod -u 1000 www-data
RUN mkdir -p /var/www/app/cache /var/www/app/logs
RUN chown -R www-data:www-data /var/www/app/cache
RUN chown -R www-data:www-data /var/www/app/logs

WORKDIR /

