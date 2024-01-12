<?php

// Inclusion des fichiers nécessaires
include 'DBConnect.php';
include 'ContactManager.php';
include 'Contact.php';
include 'Command.php';

// Création d'une instance de ContactManager
$contactManager = new ContactManager();

// Création d'une instance de Command en passant le ContactManager en paramètre
$commandHandler = new Command($contactManager);

// Boucle pour attendre les commandes de l'utilisateur en continu
while (true) {
    // Lecture de la commande depuis l'entrée utilisateur
    $line = readline("Entrez votre commande : ");

    // Exécution de la commande à l'aide de l'instance de Command
    $commandHandler->execute($line);
}
