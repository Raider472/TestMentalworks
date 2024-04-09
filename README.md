# Documentation

## Installer le projet
- prérequis:
    - IDE avec un terminal (Visual Studio Code) ou un terminal de commande
    - Docker
    - Ports disponibles: 80, 1080

- à la racine du projet, exécuter la commande suivante: -> `docker compose up -d`
    - cela permet de créer les conteneurs nécessaires avec les images requis pour le fonctionnement du projet.

- une fois les conteneurs créent, exécuter les commandes suivantes: -> `docker exec -it php sh` -> `composer i`
    - grâce à la commande ci-dessus, composer sera installé dans notre conteneur php.

## Accéder au projet
- Une fois les conteneurs docker lancé, on peut accéder au site à partir de ce lien: http://localhost/ ou http://127.0.0.1/
- Pour accéder au mailcatcher: http://localhost:1080/
