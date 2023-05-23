# PROJET RESTAURANT LE QUAI ANTIQUE

Dans le cadre d’une évaluation pour l’obtention du titre Développeur web et web mobile, j’ai décidé de séparer ce projet en deux applications. L’une générant le front-end avec React JS, l’autre générant une API REST et le backend avec le framework Symfony.

Ce dépot concerne la partie réalisée en Symfony.

Pour en savoir plus sur la partie front, vous pouvez allez sur le dépôt suivant : [https://github.com/maeva-lnd/lqa_front-end](https://github.com/maeva-lnd/lqa_front-end)

Les annexes de ce projet se trouvent ici : [https://github.com/maeva-lnd/lqa_annexes](https://github.com/maeva-lnd/lqa_annexes)

## Pré requis

Pour le bon fonctionnement de l'application, vous devez avoir déjà installé :
- git : [Lien de téléchargment](https://git-scm.com/)
- PHP version (>= 8.2.4) [Lien de téléchargement](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.4/xampp-windows-x64-8.2.4-0-VS16-installer.exe/download)
- composer version (>= 2.5.5) [Lien de téléchargement](https://getcomposer.org/download/)
- Symfony version (>= 6.2.9) [Lien de téléchargement](https://symfony.com/download)
- un serveur de base de données relationnelles

## Installation

Dans un premier temps, il va falloir récupérer le projet via git

```bash
git clone https://github.com/maeva-lnd/lqa_back-end
```

Créez un fichier .env.local et mettez y les informations correpondant à la base de données. Par exemple :

```bash
DATABASE_URL="mysql://user:password@127.0.0.1:3306/lqa_back-end"

###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=passphrase à modifier
###< lexik/jwt-authentication-bundle ###
```

Ensuite il faut télécharger les dépendances. Pour cela, placez vous dans le répertoire nouvellement créé et saisissez la commande

```bash
composer install
```

Il faut maintenant préparer la base de données en exécutant les deux commandes suivantes

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```
Pour la partie authentification, il faudra créer le dossier config/jwt et excuter les commandes suivantes

```bash
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

Il faut aussi penser à modifier le fichier .env.local en y mettant la PASSPHRASE utilisée ci-dessus, que vous aurez préalablement choisie.

Pour finir, pour la gestion de la galerie, il faut créer le dossier public/upload/images/gallery

## Demarrer le serveur

Pour demarrer le serveur Symfony, tapez la commande :

```bash
symfony server:start
```

## Création d'un administrateur

Pour créer un admin, il vous suffit de vous connecter sur POSTMAN (application permettant de tester des API) et d'éxécuter la requête POST suivante  :

```bash
url: URL_SYMFONY/api/useradmin
payload: {
    "firstname":"XXX",
    "lastname": "XXX",
    "email":"XXX@xxx.com",
    "phone":"0600000000",
    "password":"xxxxxxxxxxxxxxxxx",
    "default_guest_number": 1,
    "allergy":""
}
```