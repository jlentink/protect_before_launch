<?php

namespace Drupal\protect_before_launch\Command;

use Drupal\Core\Config\ConfigFactory;
use Drupal\protect_before_launch\Service\Configuration;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Drupal\Console\Core\Command\Shared\CommandTrait;
use Drupal\Console\Core\Style\DrupalStyle;
use Drupal\Console\Command\ContainerAwareCommand;


/**
 * Class UsernameCommand.
 *
 * @package Drupal\protect_before_launch
 *
 * @DrupalCommand (
 *     extension="protect_before_launch",
 *     extensionType="module"
 * )
 */
class UsernameCommand extends Command {

  use CommandTrait;

  /**
   * Configuration definition.
   *
   * @var Configuration
   */
  protected $config;

  /**
   * Constructs a new UsernameCommand object.
   * @param $config_factory ConfigFactory
   */
  public function __construct(Configuration $config) {
    $this->config = $config;
    parent::__construct();
  }

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('protect_before_launch:username')
      ->setDescription($this->trans('commands.protect_before_launch.username.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $io = new DrupalStyle($input, $output);

    $username = $io->ask('Which username to set?');
    $this->config->setUsername($username);


    $io->info($this->trans('commands.protect_before_launch.username.messages.success'));
  }
}
