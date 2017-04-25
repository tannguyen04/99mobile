<?php

namespace Drupal\nine_mobile_product\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\OpenDialogCommand;
/**
 * Class NineMobileListMobileForm.
 *
 * @package Drupal\nine_mobile_product\Form
 */
class NineMobileListMobileForm extends FormBase {

  /**
   * @var Connection $connection
   */
  protected $connection;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nine_mobile_list_mobile_form';
  }

  /**
   * Class constructor.
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    return new static(
      // Load the service required to construct this class.
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $brands = $form_state->getValue('brands');
    if ($brands) {
      $brands = array_filter($brands);
    }
    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';
    //Brand
    $connection = $this->connection;
    $query = $connection->select('search_api_db_product_index', 'i');
    $query->fields('i', array('field_brand'));
    $query->addExpression('COUNT(*)', 'count');
    $query->groupBy('i.field_brand');
    $query->orderBy('count', 'DESC');
    $result = $query->execute();
    $options = array();
    while($record = $result->fetchAssoc()) {
      $term = \Drupal\taxonomy\Entity\Term::load($record['field_brand']);
      $options[$term->id()] = $term->getName();
    }
    $form['brands'] = array(
      '#type' => 'checkboxes',
      '#options' => $options,
      '#title' => $this->t('Brands'),
      '#ajax' => array(
        'callback' => [get_called_class(), 'uploadAjaxCallback'],
        'wrapper' => 'edit-product-list',
      ),
    );
    //Color
    $colors = $form_state->getValue('colors');
    if ($colors) {
      $colors = array_filter($colors);
    }
    $options = array();
    $query = $connection->select('search_api_db_product_index', 'i');
    $query->fields('i', array('color_name'));
    $query->addExpression('COUNT(*)', 'count');
    $query->groupBy('i.color_name');
    $query->orderBy('count', 'DESC');
    $result = $query->execute();
    while($record = $result->fetchAssoc()) {
      //$term = \Drupal\taxonomy\Entity\Term::load($record['color_name']);
      $options[$record['color_name']] = $record['color_name'];
    }
    $form['colors'] = array(
      '#type' => 'checkboxes',
      '#options' => $options,
      '#title' => $this->t('Colors'),
      '#ajax' => array(
        'callback' => [get_called_class(), 'uploadAjaxCallback'],
        'wrapper' => 'edit-product-list',
      ),
    );
    //operating_system
    $operating_system = $form_state->getValue('operating_system');
    if ($operating_system) {
      $operating_system = array_filter($operating_system);
    }
    $options = array();
    $query = $connection->select('search_api_db_product_index', 'i');
    $query->fields('i', array('field_operating_system'));
    $query->addExpression('COUNT(*)', 'count');
    $query->groupBy('i.field_operating_system');
    $query->orderBy('count', 'DESC');
    $result = $query->execute();
    while($record = $result->fetchAssoc()) {
      $term = \Drupal\taxonomy\Entity\Term::load($record['field_operating_system']);
      $options[$term->id()] = $term->getName();
    }
    $form['operating_system'] = array(
      '#type' => 'checkboxes',
      '#options' => $options,
      '#title' => $this->t('Operating system'),
      '#ajax' => array(
        'callback' => [get_called_class(), 'uploadAjaxCallback'],
        'wrapper' => 'product-list',
      ),
    );
    //Condition/availability
    $condition_availability = $form_state->getValue('condition_availability');
    if ($condition_availability) {
      $condition_availability = array_filter($condition_availability);
    }
    $options = array();
    $query = $connection->select('search_api_db_product_index', 'i');
    $query->fields('i', array('field_condition_availability'));
    $query->addExpression('COUNT(*)', 'count');
    $query->groupBy('i.field_condition_availability');
    $query->orderBy('count', 'DESC');
    $result = $query->execute();
    while($record = $result->fetchAssoc()) {
      $term = \Drupal\taxonomy\Entity\Term::load($record['field_condition_availability']);
      $options[$term->id()] = $term->getName();
    }
    $form['condition_availability'] = array(
      '#type' => 'checkboxes',
      '#options' => $options,
      '#title' => $this->t('Condition/availability'),
      '#ajax' => array(
        'callback' => [get_called_class(), 'uploadAjaxCallback'],
        'wrapper' => 'product-list',
      ),
    );

    if (!empty($form_state->getValues())) {
      $filters = array(
        'brands' => $brands,
        'colors' => $colors,
        'condition_availability' => $condition_availability,
        'operating_system' => $operating_system
      );
      //$product_ids = $this->getProductIdsByFilter($filters);

    }else {

    }
    $view = views_embed_view('product', 'block_1');

    //Default

    //$view = \Drupal::service('renderer')->render($view);
    // $form['product_list'] = array(
    //   '#type' => 'container',
    //   '#attributes' => array(
    //     'class' => 'accommodation',
    //     'id' => 'product-list',
    //   ),
    //   'content' => $view,

    // );



    $filters = array(
      'brands' => array('8')
    );
    $product_ids = $this->getProductIdsByFilter($filters);
    return $form;
  }
  /**
   * Ajax callback
   * We will return Ajax command
   * See https://api.drupal.org/api/drupal/core!core.api.php/group/ajax/8.2.x
   */
  public static function uploadAjaxCallback($form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $title = 'Hello title dialog';
    $response->addCommand(new OpenDialogCommand('#product-list', $title, 'This is demo content'));
    return $response;
  }

  public function getProductIdsByFilter($filters) {
    $connection = $this->connection;
    $query = $connection->select('search_api_db_product_index', 'i');
    $query->fields('i', array('item_id'));
    if (isset($filters['brands'])) {
      $query->condition('i.field_brand', $filters['brands'] , 'IN');
    }
    if (isset($filters['colors'])) {
      $query->condition('i.color_name', $filters['brands'] , 'IN');
    }
    if (isset($filters['condition_availability'])) {
      $query->condition('i.field_condition_availability', $filters['condition_availability'] , 'IN');
    }
    if (isset($filters['operating_system'])) {
      $query->condition('i.field_operating_system', $filters['operating_system'] , 'IN');
    }
    $query->condition('i.type', 'mobile' , '=');
    $result = $query->execute();
    $result = $result->fetchAll();
    $pids = array();
    foreach ($result as $key => $value) {
      $item_id = $value->item_id;
      $parts = explode(':', $item_id);
      $product_id = str_replace('commerce_product/', '', $parts[1]);
      $pids[] = $product_id;
    }
    return $pids;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
        drupal_set_message($key . ': ' . $value);
    }

  }

}
