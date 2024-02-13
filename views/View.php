<?php

/**
 * Cette classe génère les vues en fonction de ce que chaque controller passe en paramètre.
 *
 * @author dpierru
 */
class View
{
    // Titre de la page.
    private string $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Rend la vue spécifiée avec des paramètres facultatifs.
     *
     * @param string $viewName Le chemin de la vue demandée par le controller.
     * @param array $params Les paramètres facultatifs que le controller a envoyé à la vue.
     * @throws Exception
     * @return void
     *
     * @author dpierru
     */
    public function render(string $viewName, array $params = []): void
    {
        $viewPath = $this->buildViewPath($viewName);

        $content = $this->_renderViewFromTemplate($viewPath, $params);
        $title = $this->title;

        ob_start();

        require(MAIN_VIEW_PATH);

        echo ob_get_clean();
    }

    /**
     * Rend la vue spécifiée à partir du chemin du template avec des paramètres facultatifs.
     *
     * @param string $viewPath Le chemin de la vue demandée par le controller.
     * @param array $params Les paramètres facultatifs que le controller a envoyé à la vue.
     * @throws Exception Si la vue spécifiée est introuvable.
     * @return string Le contenu de la vue.
     *
     * @author dpierru
     */
    private function _renderViewFromTemplate(string $viewPath, array $params = []) : string
    {
        if (file_exists($viewPath)) {
            // Cela transforme les diverses variables stockées dans le tableau "params" en véritables variables qui pourront être lues dans le template.
            extract($params);
            ob_start();
            require($viewPath);
            return ob_get_clean();
        }

        throw new \RuntimeException("La vue '$viewPath' est introuvable.");
    }

    /**
     * Cette méthode construit le chemin vers la vue demandée.
     *
     * @param string $viewName Le nom de la vue demandée.
     * @return string Le chemin vers la vue demandée.
     *
     * @author dpierru
     */
    private function buildViewPath(string $viewName): string
    {
        return TEMPLATE_VIEW_PATH . $viewName . '.php';
    }
}