FROM php:7.2-apache
COPY app/ /var/www/html/app
RUN apt update && apt install -y mariadb-server
EXPOSE 80

ADD database/ /
ADD restore_database.sh /

CMD [ "sh", "/restore_database.sh" ]