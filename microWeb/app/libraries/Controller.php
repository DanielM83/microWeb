<?php

/**Base Controller
 * Loads the models and views
 */

 class Controller {
    // Load model
    public function model($model) {
        // Require model file
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
        } else {
            die('<br>Model does not exist');
        }

        // Instantiate the model
        return new $model();
    }

    // Load view
    public function view($view, $data = []) {
        // Check for the view file
        if (file_exists('../app/views/' . $view . '.htm')) {
            require_once '../app/views/includes/header.htm';

            require_once '../app/views/' . $view . '.htm';

            require_once '../app/views/includes/footer.htm';
        } else {
            // View does not exist
            die('<br>View does not exist');
        }
    }
 }
