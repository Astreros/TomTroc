<?php

abstract class AbstractEntity
{
    // Par défaut l'id est égal à -1, ce qui permet de vérifier facilement si l'entité est nouvelle ou pas.
    protected int $id = -1;
    protected ?DateTime $creationDate = null;

    /**
     * Constructeur de la classe.
     * Si un tableau associatif est passé en paramètre, on hydrate l'entité.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Système d'hydratation de l'entité.
     * Permet de transformer les données d'un tableau associatif.
     * Les noms ded champs de la table doivent correspondre aux noms des attributs de l'entité.
     * Les underscores sont transformés en camelCase (Exemple : date_creation devient setDateCreation).
     *
     * @param array $data
     * @return void
     *
     * @author dpierru
     */
    protected function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {

            $method = 'set' . str_replace('_', '', ucwords($key, '_'));

            if (method_exists($this, $method)) {
                    $this->$method($value);
            }
        }
    }

    /**
     * Défini la date de création de l'utilisateur.
     *
     * @param string|DateTime $creationDate La date de création à définir. Il peut s'agir d'une chaîne ou d'un objet DateTime.
     * @param string $format Le format de la représentation sous forme de chaîne de la date lorsque $creationDate est une chaîne.
     * @retour void
     * @throws InvalidArgumentException Si $creationDate est une chaîne et que le format n'est pas valide.
     */
    public function setCreationDate(string|DateTime $creationDate, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($creationDate)) {
            $parsedDate = DateTime::createFromFormat($format, $creationDate);

            if ($parsedDate === false) {
                throw new InvalidArgumentException("Format de date invalide. Le format attendu est $format");
            }

            $creationDate = $parsedDate;
        }
        $this->creationDate = $creationDate;
    }

    public function getCreationDateString(): string
    {
        return $this->creationDate->format('Y-m-d H:i:s');
    }

    public function getTimeSinceRegistration(): string
    {
        $now = new DateTime();
        $registrationDate = $this->getCreationDate();

        if ($registrationDate instanceof DateTime) {

            $interval = $registrationDate->diff($now);

            if ($interval->y > 0) {
                $timeSinceRegistration = $interval->format('%y année(s)');
            } elseif ($interval->m > 0) {
                $timeSinceRegistration = $interval->format('%m mois');
            } else {
                $timeSinceRegistration = $interval->format('%d jours');
            }
            return $timeSinceRegistration;
        }

        return "Date d'inscription non disponible";
    }

    public function getCreationDate(): ?DateTime
    {
        return $this->creationDate;
    }

    /**
     * Setter pour l'id.
     *
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter pour l'id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
