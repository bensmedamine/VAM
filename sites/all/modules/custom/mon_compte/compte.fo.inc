<?php

function modifier_mes_coordonnees() {
  global $theme_path;

  drupal_add_js($theme_path . '/js/jquery.validate.min.js');
  drupal_add_js($theme_path . '/js/messages_fr.js');

  $js = 'jQuery(function($){

            $("#coordonnees-form").validate({
              errorClass: "invalid",
              validClass: "",
              errorPlacement: function(error, element) {
                if (element.attr("name") == "type_annonceur" || element.attr("name") == "civilite" )
                  error.appendTo( element.parent("div").parent("div") );
                else
                  error.insertAfter(element);
              },
              rules: {
                  type_annonceur: "required",
                  civilite: "required",
                  email: {
                    required: true,
                    email: true
                  },
                  nouveau_passe_2: {
                    equalTo: "#edit-nouveau-passe"
                  },
                  tel: "digits",
                  cp_agence: "digits"
                },
              messages: {

                 nouveau_passe_2: {
                    equalTo: "Veuillez fournir le même mot de passe"
                  },
               }
            });

          });';

  drupal_add_js($js, 'inline');
  return theme('mes_coordonnees', array('form' => drupal_get_form('coordonnees_form')));
}

function coordonnees_form() {
  global $user;
  $user = user_load($user->uid);

  $form['informations_d_identification'] = array(
    '#markup' => '<h3>Informations de contact</h3>',
  );
  $form['informations_contact'] = array(
    '#markup' => '<p class="form-item"><label>E-mail</label> ' . $user->mail . '</p>',
  );

  $form['civilite'] = array(
    '#type' => 'radios',
    '#title' => t('Civilité'),
    '#required' => TRUE,
    '#options' => array('Mr' => 'Mr', 'Mme' => 'Mme'),
    '#default_value' => $user->field_civilite[LANGUAGE_NONE][0]['value'],
  );
  $form['nom'] = array(
    '#type' => 'textfield',
    '#title' => t('Nom'),
    '#size' => 60,
    '#maxlength' => 128,
    '#required' => TRUE,
    '#default_value' => $user->field_nom[LANGUAGE_NONE][0]['value'],
  );
  $form['prenom'] = array(
    '#type' => 'textfield',
    '#title' => t('Prénom'),
    '#size' => 60,
    '#maxlength' => 128,
    '#required' => TRUE,
    '#default_value' => $user->field_prenom[LANGUAGE_NONE][0]['value'],
  );
  $form['tel'] = array(
    '#type' => 'textfield',
    '#title' => t('Tél.'),
    '#size' => 20,
    '#maxlength' => 20,
    '#required' => TRUE,
    '#default_value' => $user->field_tel[LANGUAGE_NONE][0]['value'],
  );
  $form['mot_de_passe'] = array(
    '#markup' => '<h3 class="top-20">Mot de passe</h3>',
  );
  $form['ancien_passe'] = array(
    '#type' => 'password',
    '#title' => t('Ancien mot de passe'),
    '#size' => 20,
    '#maxlength' => 128,
    '#required' => FALSE,
  );
  $form['nouveau_passe'] = array(
    '#type' => 'password',
    '#title' => t('Nouveau mode passe'),
    '#size' => 20,
    '#maxlength' => 128,
    '#required' => FALSE,
  );
  $form['nouveau_passe_2'] = array(
    '#type' => 'password',
    '#title' => t('Nouveau mode passe'),
    '#size' => 20,
    '#maxlength' => 128,
    '#required' => FALSE,
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Modifier mes coordonnées'),
    '#attributes' => array('class' => array('custom-submitt-button top-20')),
  );
  return $form;
}

function coordonnees_form_validate($form, &$form_state) {
  global $user;
  $data = $form_state['values'];

  if (!empty($data['nouveau_passe']) && !empty($data['ancien_passe'])) {
    if ($data['nouveau_passe'] != $data['nouveau_passe_2']) {
      form_set_error('nouveau_passe', t('Les deux mots de passes ne sont pas identiques'));
      return FALSE;
    }
  }

  if (!empty($data['ancien_passe'])) {
    // Allow alternate password hashing schemes.
    require_once DRUPAL_ROOT . '/' . variable_get('password_inc', 'includes/password.inc');
    $pass_validate = user_check_password(trim($data['ancien_passe']), $user);
    // Abort if the hashing failed and returned FALSE.
    if (!$pass_validate) {
      form_set_error('ancien_passe', t('Votre ancien mot de passe est incorrect'));
      return FALSE;
    }
  }
  else {
    // Avoid overwriting an existing password with a blank password.
    unset($data['nouveau_passe']);
  }
}

function coordonnees_form_submit($form, &$form_state) {
  global $user;

  $data = $form_state['values'];

  $edit = array(
    'field_civilite' => array(LANGUAGE_NONE => array(array('value' => $data['civilite']))),
    'field_nom' => array(LANGUAGE_NONE => array(array('value' => $data['nom']))),
    'field_prenom' => array(LANGUAGE_NONE => array(array('value' => $data['prenom']))),
    'field_tel' => array(LANGUAGE_NONE => array(array('value' => $data['tel']))),
  );

    drupal_set_message(t('Votre profil a été mis à jour'));
  if (!empty($data['nouveau_passe'])) {
    $edit['pass'] = $data['nouveau_passe'];
     drupal_set_message(t('Votre mot de passe à été mis à jour'));
  }

  $user = user_save($user, $edit);

  drupal_goto('modifier-mes-coordonnees');
}