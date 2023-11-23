<?php

namespace Drupal\several_forms\Controller;

use Drupal\Core\Controller\ControllerBase;

class CustomController extends ControllerBase {

    public function modalLink() {
        $build['#attached']['library'][] = 'core/drupal.dialog.ajax';
        $build = [
            '#markup' => '<a href="/drupalworld/web/get-user-details" class="use-ajax" data-dialog-type="modal">Click here</a>',
        ];
        return $build;
    }

}
