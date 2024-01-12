<?php

class ContactManager
{
    // L'instance de la base de données
    public $db;

    /**
     * Constructeur de la classe ContactManager
     */
    public function __construct()
    {
        // Initialisation de la base de données
        $this->db = DBConnect::getInstance()->getPDO();
    }

    /**
     * Retourne tous les contacts de la base de données
     *
     * @return array La liste des contacts
     */
    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM contact");
        $query->execute();

        $contacts = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = Contact::fromArray($row);
        }

        return $contacts;
    }

    /**
     * Retourne un contact en fonction de son identifiant
     *
     * @param int $id L'identifiant du contact
     * @return Contact|null Le contact trouvé ou null s'il n'existe pas
     */
    public function findByID(int $id): ?Contact
    {
        $query = $this->db->prepare("SELECT * FROM contact WHERE `id` = ?");
        $query->execute([$id]);

        $contactData = $query->fetch(PDO::FETCH_ASSOC);

        if (!$contactData) {
            return null; // Retourne null si le contact n'est pas trouvé
        }

        return Contact::fromArray($contactData);
    }

    /**
     * Crée un nouveau contact dans la base de données
     *
     * @param Contact $contact Le contact à créer
     * @return int|null L'identifiant du contact créé ou null en cas d'échec
     */
    public function createContact(Contact $contact): ?int
    {
        $query = $this->db->prepare(
            "INSERT INTO `contact` (`name`, `email`, `phone_number`) VALUES (?, ?, ?)"
        );
        $query->execute([
            $contact->getName(),
            $contact->getEmail(),
            $contact->getPhone(),
        ]);
        $id = $this->db->lastInsertId();

        if (!$id) {
            return null; // Retourne null si le contact n'a pas été créé
        }

        return $id;
    }

    /**
     * Supprime un contact de la base de données en fonction de son identifiant
     *
     * @param int $id L'identifiant du contact à supprimer
     * @return int|null Le nombre de lignes affectées par la suppression ou null en cas d'échec
     */
    public function deleteContact(int $id): ?int
    {
        $query = $this->db->prepare("DELETE FROM `contact` WHERE `id` = ?");
        $query->execute([$id]);
        $rowCount = $query->rowCount();

        if (!$rowCount) {
            return null; // Retourne null si le contact n'a pas été supprimé
        }

        return $rowCount;
    }
}
