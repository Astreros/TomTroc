<?php

/**
 * Classe abstraite qui représente un manager. Elle récupère automatiquement le gestionnaire de base de données.
 *
 * @author dpierru
 */
abstract class AbstractEntityManager {

    protected DatabaseManager $database;

    /**
     * Constructeur de la classe.
     * Il récupère automatiquement l'instance de DatabaseManager.
     */
    public function __construct()
    {
        $this->database = DatabaseManager::getInstance();
    }
}