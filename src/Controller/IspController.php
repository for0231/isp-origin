<?php

namespace Drupal\isp\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\MigrateMessage;
use Symfony\Component\HttpFoundation\Request;

class IspController  extends ControllerBase {

  public function installDemoData(Request $request) {
    $demo_data_info = \Drupal::moduleHandler()->invokeAll('demo_data_info');
    $options = [
      'limit' => 0,
      'update' => 0,
      'force' => 0,
    ];
    if ($request->query->get('update')) {
      $options['update'] = 1;
    }
    $migration_plugin_manager = \Drupal::service('plugin.manager.migration');
    $message = new MigrateMessage();
    foreach ($demo_data_info as $info) {
      $migration = $migration_plugin_manager->createInstance($info['id'], $info);
      if ($migration) {
        //$migration->setStatus(MigrationInterface::STATUS_IDLE);
        //$executable = new MigrateBatchExecutable($migration, $message, $options);
        //$executable->batchImport();
        if ($request->query->get('update')) {
          $migration->getIdMap()->prepareUpdate();
        }
        $executable = new MigrateExecutable($migration);
        $executable->import();
      }
    }

    return [
      '#markup' => t('Demo data has been installed.'),
    ];
  }
}