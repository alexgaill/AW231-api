# TP 
Ce tp se fait en groupe de 4

## Général

Vous allez réaliser une api pour un restaurant

Le client souhaite proposer un système de commande pour la vente à emporter.

Vous aurez donc à gérer les plats et menus du restaurant.

Un client peut aller sur le site, commander ses plats et ira les chercher au restaurant (Pas de livraison à gérer). Le règlement de la commande ne nécessite pas de passer par un tier. Vous enregistrerez les paiements directement passés sur le site avec une fausse carte.

Le client du restaurant peut également réserver une table dans le restaurant.

Le site du restaurant contient une partie admin pour le responsable afin qu'il puisse gérer ses plats, ses commandes (modifier le statut à en cours de préparation, prête, récupérée) et les réservations de table (ajout de table, suppression, ...) Chaque table peut avoir entre 2 et 4 personnes. Pour une réservation de 8 il faut donc bloquer 2 tables de 4 ou 4 tables de 2.

Un utilisateur n'a pas besoin de s'incrire pour commander ses plats mais doit renseigner ses infos (nom, prenom, n°tel, mail)

## Partie 1

Vous démarrez la réalisation de l'api (et du front) pour prévoir toutes les routes permettant le CRUD des différentes entités
