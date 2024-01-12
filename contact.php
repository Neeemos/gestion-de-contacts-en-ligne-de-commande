<?php

/**
 * Class Contact
 * Cette classe représente un contact
 */
class Contact
{
    // Identifiant du contact
    private ?int $id;

    // Nom du contact
    private ?string $name;

    // Adresse email du contact
    private ?string $email;

    // Numéro de téléphone du contact
    private ?string $phone_number;

    /**
     * Constructeur de la classe Contact, tous les champs sont optionnels
     *
     * @param int|null $id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $phone_number
     */
    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?string $email = null,
        ?string $phone_number = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    /**
     * Cette méthode permet de créer un contact à partir d'un tableau associatif,
     * typiquement, le résultat d'un fetch sur une table SQL
     *
     * @param array $array Le tableau associatif représentant les données du contact
     * @return Contact
     */
    public static function fromArray(array $array): Contact
    {
        $contact = new Contact();
        $contact->setId($array["id"]);
        $contact->setName($array["name"]);
        $contact->setEmail($array["email"]);
        $contact->setPhone($array["phone_number"]);
        return $contact;
    }

    /**
     * Retourne une représentation textuelle du contact
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->id .
            ", " .
            $this->name .
            ", " .
            $this->email .
            ", " .
            $this->phone_number .
            "\n";
    }

    // Liste des setters et getters

    /**
     * Retourne l'identifiant du contact
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Définit l'identifiant du contact
     *
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Retourne le nom du contact
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Définit le nom du contact
     *
     * @param string|null $name
     * @return void
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * Retourne l'adresse email du contact
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Définit l'adresse email du contact
     *
     * @param string|null $email
     * @return void
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * Retourne le numéro de téléphone du contact
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone_number;
    }

    /**
     * Définit le numéro de téléphone du contact
     *
     * @param string|null $phone_number
     * @return void
     */
    public function setPhone(?string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }
}
