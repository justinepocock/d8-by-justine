<?php

namespace Drupal\Tests\statistics\Kernel\Migrate\d6;

use Drupal\config\Tests\SchemaCheckTestTrait;
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * Upgrade variables to statistics.settings.yml.
 *
 * @group migrate_drupal_6
 */
class MigrateStatisticsConfigsTest extends MigrateDrupal6TestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  public static $modules = array('statistics');

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->executeMigration('statistics_settings');
  }

  /**
   * Tests migration of statistics variables to statistics.settings.yml.
   */
  public function testStatisticsSettings() {
    $config = $this->config('statistics.settings');
    $this->assertIdentical(FALSE, $config->get('access_log.enabled'));
    $this->assertIdentical(259200, $config->get('access_log.max_lifetime'));
    $this->assertIdentical(0, $config->get('count_content_views'));
    $this->assertConfigSchema(\Drupal::service('config.typed'), 'statistics.settings', $config->get());
  }

}
