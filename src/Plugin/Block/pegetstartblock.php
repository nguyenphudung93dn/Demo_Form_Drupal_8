<?php

namespace Drupal\pegetstart\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'PE Get Start' Block.
 *
 * @Block(
 *   id = "pe_getstart",
 *   admin_label = @Translation("PE Get Start"),
 *   category = @Translation("PE Get Start"),
 * )
 */
class pegetstartblock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
     $form = \Drupal::formBuilder()->getForm('\Drupal\pegetstart\Form\PEGetStartForm');
    // return $form;
    return [
      '#theme' => 'pegetstart',
      '#form' => $form,
    ];

  }
 
}
