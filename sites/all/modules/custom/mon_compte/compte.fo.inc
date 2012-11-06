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
    '#title' => t('Nouveau mot de passe'),
    '#size' => 20,
    '#maxlength' => 128,
    '#required' => FALSE,
  );
  $form['nouveau_passe_2'] = array(
    '#type' => 'password',
    '#title' => t('Confirmer'),
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

function modifier_informations_agence() {
  global $theme_path;

  drupal_add_js($theme_path . '/js/jquery.filestyle.js');
  drupal_add_js($theme_path . '/js/jquery.validate.min.js');
  drupal_add_js($theme_path . '/js/messages_fr.js');

  $js = 'jQuery(function($){
    
            //Costum validators
            $.validator.addMethod("check_ext_photo", function(value, element) {
              var ext = value.split(".").pop().toLowerCase();
              var check = ($.inArray(ext, ["gif","png","jpg","jpeg"]) == -1) ? false : true;
              return this.optional(element) || check;
            }, "L\'extension de la photo est non valide.");

            $("#informations-agence-form").validate({
              errorClass: "invalid",
              validClass: "",
              errorPlacement: function(error, element) {
                if (element.attr("name") == "files[logo_agence]" )
                  error.appendTo( element.parent("div").parent("div") );
                else
                  error.insertAfter(element);
              },
              rules: {
                  cp_agence: "digits",
                  tel_agence: "digits",
                  site_web_agence: "url",
                  "files[logo_agence]": "check_ext_photo"
                },
              messages: {
              
               }
            });
           
            $("#edit-logo-agence").filestyle({
              image: "' . $theme_path . '/images/choose-file.gif",
              imageheight : 35,
              imagewidth : 82,
              width : 250
            });   

          });';

  drupal_add_js($js, 'inline');
  return theme('informations_agence', array('form' => drupal_get_form('informations_agence_form')));
}

function informations_agence_form() {
  global $user;
  $user = user_load($user->uid);

  $form['informations_agence'] = array(
    '#markup' => '<h3 class="top-20">Agence ' . ucfirst($user->field_nom_agence[LANGUAGE_NONE][0]['value']) . '</h3>',
  );
  $form['nom_agence'] = array(
    '#type' => 'textfield',
    '#title' => ('Nom de l\'agence <span title="Ce champ est obligatoire." class="form-required">*</span>'),
    '#size' => 60,
    '#maxlength' => 128,
    '#attributes' => array('class' => array('required')),
    '#default_value' => $user->field_nom_agence[LANGUAGE_NONE][0]['value'],
  );
  $form['ville_agence'] = array(
    '#type' => 'select',
    '#title' => ('Ville <span title="Ce champ est obligatoire." class="form-required">*</span>'),
    '#options' => load_select_from_tax(2, TRUE),
    '#attributes' => array('class' => array('required')),
    '#default_value' => $user->field_ville[LANGUAGE_NONE][0]['tid'],
  );
  $form['adresse_agence'] = array(
    '#type' => 'textfield',
    '#title' => t('Adresse'),
    '#size' => 60,
    '#maxlength' => 128,
    '#default_value' => $user->field_prenom[LANGUAGE_NONE][0]['value'],
  );
  $form['cp_agence'] = array(
    '#type' => 'textfield',
    '#title' => t('Code postal'),
    '#size' => 20,
    '#maxlength' => 11,
    '#default_value' => $user->field_code_postal_agence[LANGUAGE_NONE][0]['value'],
  );
  $form['tel_agence'] = array(
    '#type' => 'textfield',
    '#title' => ('Téléphone <span title="Ce champ est obligatoire." class="form-required">*</span>'),
    '#size' => 20,
    '#maxlength' => 20,
    '#attributes' => array('class' => array('required')),
    '#default_value' => $user->field_tel_agence[LANGUAGE_NONE][0]['value'],
  );
  $form['site_web_agence'] = array(
    '#type' => 'textfield',
    '#title' => t('Site web'),
    '#size' => 60,
    '#maxlength' => 128,
    '#default_value' => $user->field_site_web[LANGUAGE_NONE][0]['value'],
  );

  if (!empty($user->field_image[LANGUAGE_NONE][0]['uri'])) {
    $form['picture'] = array(
      '#markup' => theme('image_style', array('style_name' => 'medium', 'path' => $user->field_image[LANGUAGE_NONE][0]['uri'], 'alt' => 'Agence ' . ucfirst($user->field_nom_agence[LANGUAGE_NONE][0]['value']), 'attributes' => array('class' => array('logo-agence'))))
    );
  }

  $form['logo_agence'] = array(
    '#type' => 'file',
    '#title' => t('Logo'),
    '#attributes' => array('class' => array('has-description')),
    '#required' => FALSE,
    '#size' => FALSE,
    '#description' => 'Formats autorisés : JPG, JPEG, PNG ou GIF',
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Mettre à jour'),
    '#attributes' => array('class' => array('custom-submitt-button top-20')),
  );
  return $form;
}

function informations_agence_form_validate($form, &$form_state) {
  // Upload files if any
  if (!empty($_FILES['files']['name']['logo_agence'])) {

    $file = inscription_upload_file('logo_agence', 'public://');

    if (empty($file)) {

      form_set_error('logo_agence', t('Veuillez mettre une photo de type (JPG, JPEG, PNG ou GIF) ayant une taille de 1Mo ou moins.'));
    }
    else {
      $form_state['values']['fid_logo_agence'] = $file->fid;
    }
  }
}

function informations_agence_form_submit($form, &$form_state) {
  global $user;

  $data = $form_state['values'];

  $edit = array(
    'field_nom_agence' => array(LANGUAGE_NONE => array(array('value' => $data['nom_agence']))),
    'field_ville' => array(LANGUAGE_NONE => array(array('tid' => $data['ville_agence']))),
    'field_tel_agence' => array(LANGUAGE_NONE => array(array('value' => $data['tel_agence']))),
  );

  if (!empty($data['adresse_agence']))
    $edit['field_adresse'] = array(LANGUAGE_NONE => array(array('value' => $data['adresse_agence'])));
  if (!empty($data['cp_agence']))
    $edit['field_code_postal_agence'] = array(LANGUAGE_NONE => array(array('value' => $data['cp_agence'])));
  if (!empty($data['site_web_agence']))
    $edit['field_site_web'] = array(LANGUAGE_NONE => array(array('value' => $data['site_web_agence'])));
  if (!empty($data['fid_logo_agence']))
    $edit['field_image'] = array(LANGUAGE_NONE => array(array('fid' => $data['fid_logo_agence'])));

  $user = user_save($user, $edit);
  drupal_set_message(t('Votre profil a été mis à jour'));
  drupal_goto('modifier-informations-agence');
}