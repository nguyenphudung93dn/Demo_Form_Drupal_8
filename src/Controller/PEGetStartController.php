<?php
namespace Drupal\pegetstart\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class PEGetStartController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function thankyou() {
    $build = [
      '#markup' => $this->t('Thank You So Much'),
    ];
    return $build;
  }

}