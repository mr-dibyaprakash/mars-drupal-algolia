<?php

namespace Drupal\algolia_search_interface\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Algolia Search Interface' Block.
 *
 * @Block(
 *   id = "instantsearch_block",
 *   admin_label = @Translation("Instant Search Block"),
 *   category = @Translation("Instant Search Block"),
 * )
 */
class InstantSearchBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    return [
      '#theme' => 'instantsearchblock',
      '#attached' => [
        'library' => 'algolia_search_interface/algolia-javascript',
      ],
    ];
  }

}
