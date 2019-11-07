<?php
/**
 * @file
 * Contains \Drupal\pegetstart\Form\PEGetStartForm.
 */
namespace Drupal\pegetstart\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class PEGetStartForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pegetstart_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['firstName'] = array(
      '#type' => 'textfield',
      '#required' => TRUE,
      '#attributes' => array(
        'placeholder' => t('First Name'),
      ),
    );

    $form['lastName'] = array(
      '#type' => 'textfield',
      '#required' => TRUE,
      '#attributes' => array(
        'placeholder' => t('Last Name'),
      ),
    );

    $form['email'] = array (
      '#type' => 'textfield',
      '#required' => TRUE,
      '#attributes' => array(
        'placeholder' => t('Email'),
      ),
    );

    $form['phone'] = array (
      '#type' => 'textfield',
      '#required' => TRUE,
      '#attributes' => array(
        'placeholder' => t('Phone Number'),
      ),
    );

    $form['data'] = array (
      '#type' => 'textarea',
      '#attributes' => array(
        'placeholder' => t('How can we help you?'),
      ),
    );
    $form['test_CERTIFICATE'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Certificate'),
      '#upload_location' => 'public://sites/default/files/form/',
    ];

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Send'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {

    }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

        // TODO: Implement submitForm() method.
        $data = $_POST;
        $title = $form_state->getValue('firstName') . ' '. $form_state->getValue('lastName');
        $body = array();
        $body[] = array(
            'value' => $form_state->getValue('data'),
            'format' => 'filtered_html',
        );
        
        $form_file = $form_state->getValue('test_CERTIFICATE', 0);
        if (isset($form_file[0]) && !empty($form_file[0])) {
          $file = File::load($form_file[0]);
          $file->setPermanent();
          $file->save();
        }
  

        $node = entity_create('node', array(
            'type' => 'get_start',
            'body' => $body,
            'title' => $title,
            'field_email' => array('value'=>$form_state->getValue('email')),
            'field_phone' => array('value'=>$form_state->getValue('phone')),
            'field_file_image' =>array(
                'target_id' => $file->id(),
                'alt' => 'Alt text Test alt',
                'title' => 'Title tester',
            )
        ));

        $node->save();
        $form_state->setRedirect('pegetstart.thankyou');
   }

}