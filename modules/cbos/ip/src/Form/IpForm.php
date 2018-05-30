<?php

namespace Drupal\isp_ip\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for IP edit forms.
 *
 * @ingroup isp_ip
 */
class IpForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\isp_ip\Entity\Ip */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // TODO need to check ip valid.
    if (ip2long($form_state->getValue('name')) == -1 || ip2long($form_state->getValue('name')) === FALSE) {
      $form_state->setErrorByName('name', $this->t('error'));
    }
    return parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label IP.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label IP.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.isp_ip.canonical', ['isp_ip' => $entity->id()]);
  }

}
