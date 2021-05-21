//check symfony version
php bin/console --version

//setup
composer install

php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate

