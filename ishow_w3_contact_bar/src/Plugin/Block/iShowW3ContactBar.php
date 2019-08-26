<?php

namespace Drupal\ishow_w3_contact_bar\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Contact Bar with home, telephone and social media shortcuts.
 *
 * @Block(
 *   id = "ishow_w3_contact_bar",
 *   admin_label = @Translation("iShow-W3 Contact Bar Block"),
 *   category = @Translation("iShow-W3 Contact Bar Block"),
 * )
 */
class iShowW3ContactBar extends BlockBase implements BlockPluginInterface{

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
	$content = "";
	// we add the left-side bar content
    $content = $content.'
    <div id="ishow-w3-contact-bar" class="contact-bar w3-bar w3-top">
		';

	// now we add the right-side content

    if (!empty($config['telephone'])) {
      $telephone = $config['telephone'];
      $content = $content.'
		<a href="https://wa.me/'.$telephone.'." class="w3-bar-item  w3-hover-cyan" target="_blank" title="Twitter"> <i class="fa fa-whatsapp"></i> </a>';
    }
    else {
      $telephone = $this->t('XX-XXX-XXX-XXX');
    }

    if(!empty($config['twitter'])){
      $content = $content.'
		<a href="'.$config['twitter'].'" class=" w3-bar-item  w3-hover-cyan" target="_blank" title="Twitter"> <i class="fa fa-twitter"></i> </a>';
    }
    if(!empty($config['facebook'])){
      $content = $content.'
		<a href="'.$config['facebook'].'" class="w3-bar-item  w3-hover-cyan" target="_blank" title="Facebook"> <i class="fa fa-facebook-square"></i> </a>';
    }
    if(!empty($config['instagram'])){
      $content = $content.'
		<a href="'.$config['instagram'].'" class="w3-bar-item  w3-hover-cyan" target="_blank" title="Instagram"> <i class="fa fa-instagram"></i> </a>';
    }
    if(!empty($config['linkedin'])){
      $content = $content.'
		<a href="'.$config['linkedin'].'" class="w3-bar-item  w3-hover-cyan" target="_blank" title="LinkedIn"> <i class="fa fa-linkedin"></i> </a>';
    }
    if(!empty($config['email'])){
      $content = $content.'
		<a href="'.$config['email'].'" class="w3-bar-item  w3-hover-cyan" target="_blank" title="Email"> <i class="fa fa-envelope"></i> </a>';
    }
    $content = $content.'
		<a href="tel:+'.$telephone.'" class="w3-bar-item w3-hover-cyan"><i class="fa fa-phone-square"></i>+'.$telephone.'</a>
		';

	$content = $content.'
	</div>
	';


    $string = (string)$content;

    return [
      '#markup' => $this->t($string),
      '#attached' => [
        'library' => [
          'ishow_w3_contact_bar/contact-bar-styling',
        ],
      ],
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function blockForm($form, FormStateInterface $form_state) {
   $form = parent::blockForm($form, $form_state);

   $config = $this->getConfiguration();

   $form['telephone'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Your telephone number'),
     '#description' => $this->t('Remember to add the country code'),
     '#default_value' => isset($config['telephone']) ? $config['telephone'] : '',
   ];

   $form['twitter'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Link to your Twitter profile'),
     '#default_value' => isset($config['twitter']) ? $config['twitter'] : '',
   ];

   $form['tripadvisor'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Link to your TripAdvisor profile'),
     '#default_value' => isset($config['tripadvisor']) ? $config['tripadvisor'] : '',
   ];

   $form['instagram'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Link to your Instagram profile'),
     '#default_value' => isset($config['instagram']) ? $config['instagram'] : '',
   ];

   $form['facebook'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Link to your Facebook profile'),
     '#default_value' => isset($config['facebook']) ? $config['facebook'] : '',
   ];

   $form['email'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Email Address'),
     '#default_value' => isset($config['email']) ? $config['email'] : '',
   ];

   $form['linkedin'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Link to your LinkedIn profile'),
     '#default_value' => isset($config['linkedin']) ? $config['linkedin'] : '',
   ];

   return $form;
 }

 /**
  * {@inheritdoc}
  */
   public function blockSubmit($form, FormStateInterface $form_state) {
     parent::blockSubmit($form, $form_state);
     $values = $form_state->getValues();
     $this->configuration['telephone'] = $values['telephone'];
     $this->configuration['twitter'] = $values['twitter'];
     $this->configuration['facebook'] = $values['facebook'];
     $this->configuration['instagram'] = $values['instagram'];
     $this->configuration['tripadvisor'] = $values['tripadvisor'];
     $this->configuration['email'] = $values['email'];
     $this->configuration['linkedin'] = $values['linkedin'];

   }

}
