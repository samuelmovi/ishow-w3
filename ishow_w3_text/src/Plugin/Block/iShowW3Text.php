<?php

namespace Drupal\ishow_w3_text\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * A text bubble block module, powered by W3.CSS
 *
 * @Block(
 *   id = "ishow_w3_text",
 *   admin_label = @Translation("iShow-W3 Text"),
 *   category = @Translation("iShow-W3 Text"),
 * )
 */
class iShowW3Text extends BlockBase implements BlockPluginInterface{

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    $text = '';

    if (!empty($config['text'])) {
      $text = $config['text'];
    }
    else {
      $text = $this->t('Lorem Ipsum y todas esas cosas. Lorem Ipsum y todas esas cosas. Lorem Ipsum y todas esas cosas. Lorem Ipsum y todas esas cosas. Lorem Ipsum y todas esas cosas. Lorem Ipsum y todas esas cosas. Lorem Ipsum y todas esas cosas. Lorem Ipsum y todas esas cosas. ');
    }

    return array(
      '#markup' => $this->t('<div class="w3-panel w3-border w3-border-red w3-round-xlarge w3-hover-border-blue w3-justify" style="font-size:20px;"><p>'.$text.'<br></div>'),
    );
  }

  /**
  * {@inheritdoc}
  */
  public function blockForm($form, FormStateInterface $form_state) {
   $form = parent::blockForm($form, $form_state);

   $config = $this->getConfiguration();

   $form['text'] = [
     '#type' => 'textarea',
     '#title' => $this->t('Texto para el bloque'),
     '#default_value' => isset($config['text']) ? $config['text'] : '',
   ];

   return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function blockSubmit($form, FormStateInterface $form_state) {
      parent::blockSubmit($form, $form_state);
      $values = $form_state->getValues();
      $this->configuration['text'] = $values['text'];
    }
}
