service mysql start

mysql -u root -e "CREATE DATABASE test"

mysql -u root test < /database.sql

mysql -u root -e "CREATE USER 'user1' IDENTIFIED BY '123' WITH MAX_QUERIES_PER_HOUR 500 "
mysql -u root -e "GRANT SELECT, INSERT, UPDATE ON test.* TO user1;"

docker-php-ext-install pdo_mysql


apache2-foreground