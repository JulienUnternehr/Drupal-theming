<?php

/**
 * @file
 * Contains \Drupal\hello\Form\HelloForm.
 */

namespace Drupal\hello\Form;

use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;

/**
 * Implements an hello form
 */

class HelloForm extends FormBase {
    /**
     *  {@inheritdoc}
     */
    public function getFormId()
    {
        return 'hello_form';
    }
    /**
     *  {@inheritdoc}
     */
    public function buildForm ( array $form, FormStateInterface $form_state)
    {
        $form['champ_nombre_1'] = array(
            '#type' => 'textfield',
            '#title' => t('Nombre 1 :'),
            '#placeholder' => t('1ère valeur'),
            '#required' => TRUE,
            '#ajax' => array(
                'callback' => array($this, 'validateTextAjax'),
                'event' => 'change',
            ),
            '#suffix' =>'<span class="champ-erreur-1"></span>',
        );

        $form['radios'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Opérations'),
            '#required' => TRUE,
            '#ajax' => array(
                'callback' => array($this, 'validateTextAjax'),
                'event' => 'change',
            ),
            '#options' => array(
                'Ajouter' => $this->t('Ajouter'),
                'Soustraire' => $this->t('Soustraire'),
                'Multiplier' => $this->t('Multiplier'),
                'Diviser' => $this->t('Diviser'))
        );

        $form['champ_nombre_2'] = array(
            '#type' => 'textfield',
            '#title' => t('Nombre 2 :'),
            '#placeholder' => t('2ième valeur'),
            '#required' => TRUE,
            '#ajax' => array(
                'callback' => array($this, 'validateTextAjax'),
                'event' => 'change',
            ),
            '#suffix' =>'<span class="champ-erreur-2"></span>',
        );

        $form['bouton_submit'] = array (
            '#type' => 'submit',
            '#value' => t('Calculer')
        );

        $resultat = $form_state->getTemporaryValue('resultat');
        return array('#markup' => $this->t('Résultat : ' . $resultat),$form);
    }
    /**
     *  {@inheritdoc}
     */
    public function validateForm ( array &$form, FormStateInterface $form_state)
    {
        $champ_nbr_1 = $form_state->getValue('champ_nombre_1');
        $champ_nbr_2 = $form_state->getValue('champ_nombre_2');
        $radios_btn = $form_state->getValue('radios');

        if (!is_numeric($champ_nbr_1)) {
            $form_state->setErrorByName('champ_nombre_1',t('Valeur numérique seulement !'));
        }
        if (!is_numeric($champ_nbr_2)) {
            $form_state->setErrorByName('champ_nombre_2',t('Valeur numérique seulement !'));
        }
        if ($radios_btn == 'Diviser' && $champ_nbr_2 == '0') {
            $form_state->setErrorByName('champ_nombre_2',t('Deuxième valeur numérique différente de 0 !'));
        }
    }
    /**
     *  {@inheritdoc}
     */
    public function submitForm ( array &$form, FormStateInterface $form_state)
    {
        $champ_nbr_1 = $form_state->getValue('champ_nombre_1');
        $champ_nbr_2 = $form_state->getValue('champ_nombre_2');
        $radios_btn = $form_state->getValue('radios');

        switch ($radios_btn) {
            case 'Ajouter' :
                $resultat = $champ_nbr_1 + $champ_nbr_2;
                break;
            case 'Soustraire' :
                $resultat = $champ_nbr_1 - $champ_nbr_2;
                break;
            case 'Multiplier' :
                $resultat = $champ_nbr_1 * $champ_nbr_2;
                break;
            case 'Diviser' :
                $resultat = $champ_nbr_1 / $champ_nbr_2;
                break;
        }
        //Afficher le résultat sur la page en msd status
        //drupal_set_message(t('Résultat : ' . $resultat),'status');

        //Afficher le résultat sur une autre page
        //$form_state->setRedirect('hello.resultat', array('result' => $resultat));

        $form_state->setTemporaryValue('resultat', $resultat);
        $form_state->setRebuild();
    }
    /**
     *  {@inheritdoc}
     */
    public function validateTextAjax(array &$form, FormStateInterface $form_state) {
        $css_on = ['border' => '2px solid red'];
        $css_off = ['border' => '1px solid #ccc'];
        $css_message_on = ['color' => 'red','display' => 'block'];
        $css_message_off = ['display' => 'none'];
        $message = 'Valeur numérique seulement';
        $message2 = 'Valeur numérique différente de 0 !';
        $champ_nbr_1 = $form_state->getValue('champ_nombre_1');
        $champ_nbr_2 = $form_state->getValue('champ_nombre_2');
        $radios_btn = $form_state->getValue('radios');

        $response = new AjaxResponse();
        if ($champ_nbr_1 == '') {
            $response->addCommand(new CssCommand('#edit-champ-nombre-1', $css_off));
            $response->addCommand(new CssCommand('.champ-erreur-1', $css_message_off));
        }
        if ($champ_nbr_2 == '') {
            $response->addCommand(new CssCommand('#edit-champ-nombre-2', $css_off));
            $response->addCommand(new CssCommand('.champ-erreur-2', $css_message_off));
        }
        if (!is_numeric($champ_nbr_1) && $champ_nbr_1 != '') {
            $response->addCommand(new CssCommand('#edit-champ-nombre-1', $css_on));
            $response->addCommand(new CssCommand('#edit-champ-nombre-2', $css_off));
            $response->addCommand(new CssCommand('.champ-erreur-1', $css_message_on));
            $response->addCommand(new CssCommand('.champ-erreur-2', $css_message_off));
            $response->addCommand(new HtmlCommand('.champ-erreur-1', $message));
        }
        if (!is_numeric($champ_nbr_2) && $champ_nbr_2 != '') {
            $response->addCommand(new CssCommand('#edit-champ-nombre-2', $css_on));
            $response->addCommand(new CssCommand('#edit-champ-nombre-1', $css_off));
            $response->addCommand(new CssCommand('.champ-erreur-2', $css_message_on));
            $response->addCommand(new CssCommand('.champ-erreur-1', $css_message_off));
            $response->addCommand(new HtmlCommand('.champ-erreur-2', $message));
        }
        if ($radios_btn == 'Diviser' && $champ_nbr_2 == '0' || $radios_btn == 'Diviser' && $champ_nbr_1 == '0') {
            $response->addCommand(new CssCommand('#edit-champ-nombre-2', $css_on));
            $response->addCommand(new CssCommand('#edit-champ-nombre-1', $css_off));
            $response->addCommand(new CssCommand('.champ-erreur-2', $css_message_on));
            $response->addCommand(new CssCommand('.champ-erreur-1', $css_message_off));
            $response->addCommand(new HtmlCommand('.champ-erreur-2', $message2));
        }
        return $response;
    }
}