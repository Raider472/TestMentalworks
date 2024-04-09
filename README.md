# Documentation

## Installer le projet
- prérequis:
    - IDE avec un terminal (Visual Studio Code) ou un terminal de commande
    - Docker

- à la racine du projet, exécuter la commande suivante: -> docker compose up
    - cela permet de créer les conteneurs nécessaires avec les images requis pour le fonctionnement du projet.

- une fois les conteneurs créent, exécuter les commandes suivantes: -> docker exec -it php sh -> composer i
    - Grâce à la commande ci-dessus, composer sera installé dans notre conteneur php.