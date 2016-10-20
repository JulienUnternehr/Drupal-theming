<?php

/**
 * @file
 * Contains \Drupal\hello\Form\HelloFormCouleurs.
 */

namespace Drupal\hello\Form;


use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an hello form
 */

class HelloFormCouleurs extends ConfigFormBase {

    public function getFormId()
    {
        return 'hello_form';
    }

    public function buildForm ( array $form, FormStateInterface $form_state)
    {
        $valeur_par_defaut = $this->config('hello.config')->get('color');
        $form['select_couleurs'] = [
            '#type' => 'select',
            '#title' => t('Choisissez une couleur'),
            '#default_value' => $valeur_par_defaut,
            '#options' => [
                'vert' => t('vert'),
                'orange' => t('orange'),
                'blue-class' => t('bleu'),
            ],
        ];
        return parent::buildForm($form, $form_state);
    }


    public function submitForm ( array &$form, FormStateInterface $form_state)
    {
        $couleur = $form_state->getValue('select_couleurs');

        $this->config('hello.config')->set('color',$couleur)->save();

        parent::submitForm($form, $form_state);
    }

    public function getEditableConfigNames()
    {
        return ['hello.config'];
    }
    public function validateForm ( array &$form, FormStateInterface $form_state)
    {
        return 'hello_form';
    }
}