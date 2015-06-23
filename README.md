Test Application


1) Dowload Composer to bin directory:
 curl -sS https://getcomposer.org/installer | php -- --install-dir=bin

2) Intall dependencies via composer:
 php bin/composer.phar install

3) Run tests:
 bin/phpunit -c test/phpunit.xml
