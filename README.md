
Test SF Kalitics
========================


Installation
----------------------------------

### Composer


Pour installer les dépendances nécessaires, téléchargez [Composer](https://getcomposer.org/)
 et exécutez la commande suivante :

    composer install


### Configuration


Pour créer la base de données exécutez la commande  suivante :

    php app/console doctrine:database:create

Puis pour générer les tables et le schéma :

    php bin/console doctrine:migration:migrate

### demostration

    symfony serve



