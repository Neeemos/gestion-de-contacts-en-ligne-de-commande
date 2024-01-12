<?php

/**
 * Class Command
 * Cette classe a toute la logique d'execution
 */
class Command
{
    private $contactManager; // Variable pour stocker l'instance de ContactManager

    public $methodList = ["list", "detail", "create", "delete", "help"]; // Liste des méthodes disponibles

    /**
     * Constructeur de la classe Command
     *
     * @param ContactManager $contactManager L'instance de ContactManager à utiliser
     */
    public function __construct(ContactManager $contactManager)
    {
        $this->contactManager = $contactManager;
    }

    /**
     * Exécute la commande donnée
     *
     * @param string $command La commande à exécuter
     * @return void
     */
    public function execute(string $command): void
    {
        $parts = explode(" ", $command);
        $action = strtolower($parts[0]);

        switch ($action) {
            case "list":
                $this->listContacts();
                break;
            case "detail":
                $this->detailContact($command);
                break;
            case "create":
                $this->createContact($command);
                break;
            case "delete":
                $this->deleteContact($command);
                break;
            case "quit":
                $this->quit();
                break;
            case "help":
                $this->help();
                break;
            default:
                echo "Commande non reconnue\n";
        }
    }

    /**
     * Affiche les détails d'un contact
     *
     * @param string $command La commande complète
     * @return void
     */
    private function detailContact(string $command): void
    {
        if (!preg_match("/^detail (\d+)$/", $command, $matches)) {
            echo "Format de commande incorrect. Utilisation : detail [id]\n";
            return;
        }

        $id = (int) $matches[1];
        $contact = $this->contactManager->findByID($id);
        if ($contact) {
            echo "Détails du contact avec l'ID $id \n";
            echo "id | nom | email | telephone | \n";
            echo $contact->toString() . "\n";
        } else {
            echo "Aucun contact trouvé avec l'ID $id\n";
        }
    }

    /**
     * Crée un nouveau contact
     *
     * @param string $command La commande complète
     * @return void
     */
    private function createContact(string $command): void
    {
        if (!preg_match("/^create (\S+), (\S+), (\S+)$/", $command, $matches)) {
            echo "Format de commande incorrect. Utilisation : create [name], [email], [phone]\n";
            return;
        }

        $contact = new Contact();
        $contact->setName($matches[1]);
        $contact->setEmail($matches[2]);
        $contact->setPhone($matches[3]);

        $result = $this->contactManager->createContact($contact);
        if (!$result) {
            echo "Format de commande incorrect. Utilisation : create [name], [email], [phone]\n";
        } else {
            echo "Votre contact a été ajouté à l'ID : $result \n";
        }
    }

    /**
     * Affiche la liste de tous les contacts
     *
     * @return void
     */
    private function listContacts(): void
    {
        $contacts = $this->contactManager->findAll();
        if (empty($contacts)) {
            echo "Aucun contact\n";
            return;
        }

        echo "Liste des contacts : \n";
        echo "id, nom, email, telephone\n";
        foreach ($contacts as $contact) {
            echo $contact->toString();
        }
    }

    /**
     * Supprime un contact en fonction de l'ID
     *
     * @param string $command La commande complète
     * @return void
     */
    private function deleteContact(string $command): void
    {
        if (!preg_match("/^delete (\d+)$/", $command, $matches)) {
            echo "Format de commande incorrect. Utilisation : delete [id] \n";
            return;
        }

        $id = (int) $matches[1];
        $result = $this->contactManager->deleteContact($id);

        if (!$result) {
            echo "Le contact n'existe pas \n";
        } else {
            echo "Votre contact a été supprimé \n";
        }
    }

    /**
     * Quitte le programme
     *
     * @return void
     */
    private function quit(): void
    {
        echo "Fin du programme\n";
        exit();
    }

    /**
     * Affiche les méthodes disponibles
     *
     * @return void
     */
    private function help(): void
    {
        echo "Voici les méthodes disponibles : \n";
        foreach ($this->methodList as $method) {
            echo $method . "\n";
        }
    }
}
