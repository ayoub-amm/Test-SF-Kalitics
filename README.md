
Test SF Kalitics
========================


Installation
----------------------------------

### Environnement Technique

    Symfony version : 4.4
    PHP version : 7.4.9
    Mysql : 5.7.24 

    
### Composer


Pour installer les dépendances nécessaires, téléchargez [Composer](https://getcomposer.org/)
 et exécutez la commande suivante :

    composer install


### Configuration


Pour créer la base de données exécutez la commande  suivante :

    php app/console doctrine:database:create

Puis pour générer les tables et le schéma :

    php bin/console doctrine:migration:migrate

### Run Serve

    symfony serve




