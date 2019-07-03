<?php

namespace Drupal\ishow_w3_super_banner\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Displays banner containing a custom carousel with the logo overlaid on top, powered by W3.CSS
 *
 * @Block(
 *   id = "ishow_w3_super_banner",
 *   admin_label = @Translation("iShow-W3 Super Banner Block"),
 *   category = @Translation("iShow-W3 Super Banner Block"),
 * )
 */
class iShowW3SuperBanner extends BlockBase implements BlockPluginInterface{

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    $image_filename_array = array();

    for ($i=1; $i<=3; $i++){
      if (isset($config["image$i"])){
        $image_field = $config["image$i"];
        $image = File::load($image_field[0]);
        $image_filename_array["image$i"] = $image->getFilename();
      }
    };
    $my_string = '   <div id="super-banner" class="w3-display-container">
      <div class="mySlides">
        <img class="w3-image  w3-animate-left stretch" src="/sites/default/files/images/carousel/'.$image_filename_array['image1'].'">
      </div>
      <div class="mySlides">
        <img class="w3-image  w3-animate-left stretch" src="/sites/default/files/images/carousel/'.$image_filename_array['image2'].'">
      </div>
      <div class="mySlides">
        <img class="w3-image  w3-animate-left stretch" src="/sites/default/files/images/carousel/'.$image_filename_array['image3'].'">
      </div>
      <div id="banner-logo" class="w3-display-topleft">
        <a href="/" title="Home" rel="home" class="site-branding__logo">
          <img src="/sites/default/files/logo.png" class="w3-image" alt="Home" />
        </a>
      </div>
    </div>';

    $content = (string)$my_string;
    
    return [
      '#markup' => $this->t($content),
      '#attached' => [
        'library' => [
          'ishow_w3_super_banner/super-banner-styling',
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

   $form['image1'] = array(
     '#type' => 'managed_file',
     '#upload_location' => 'public://images/carousel/',
     '#title' => $this->t('Imagen de Carrusel 1'),
     '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
      //'file_validate_size' => array(25600000),
     ),
     '#widget' => 'imce',
     '#styles' => TRUE,
     '#preview' => TRUE,
   );
   $form['image2'] = array(
     '#type' => 'managed_file',
     '#upload_location' => 'public://images/carousel/',
     '#title' => $this->t('Imagen de Carrusel 2'),
     '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
      //'file_validate_size' => array(25600000),
     ),
     '#widget' => 'imce',
     '#styles' => TRUE,
     '#preview' => TRUE,
   );
   $form['image3'] = array(
     '#type' => 'managed_file',
     '#upload_location' => 'public://images/carousel/',
     '#title' => $this->t('Imagen de Carrusel 3'),
     '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
      //'file_validate_size' => array(25600000),
     ),
     '#widget' => 'imce',
     '#styles' => TRUE,
     '#preview' => TRUE,
   );

   return $form;
 }

 /**
  * {@inheritdoc}
  */
   public function blockSubmit($form, FormStateInterface $form_state) {
     parent::blockSubmit($form, $form_state);
     $values = $form_state->getValues();
     if ($values['image1']){
       $image = $form_state->getValue('image1');
       if($image){
         $this->configuration['image1'] = $image;
         /* Load the object of the file by it's fid */
         $file = \Drupal\file\Entity\File::load( $image[0] );
         /* Set the status flag permanent of the file object */
         $file->setPermanent();
         /* Save the file in database */
         $file->save();
       }
     }
     if ($values['image2']){
       $image = $form_state->getValue('image2');
       if($image){
         $this->configuration['image2'] = $image;
         $file = \Drupal\file\Entity\File::load( $image[0] );
         $file->setPermanent();
         $file->save();
       }
     }
     if ($values['image3']){
       $image = $form_state->getValue('image3');
       if($image){
         $this->configuration['image3'] = $image;
         $file = \Drupal\file\Entity\File::load( $image[0] );
         $file->setPermanent();
         $file->save();
       }
     }
   }
}
