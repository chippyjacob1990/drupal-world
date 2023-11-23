<?php

namespace Drupal\students\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for books routes.
 */
class StudentsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
