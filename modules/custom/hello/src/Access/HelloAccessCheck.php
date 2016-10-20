<?php

namespace Drupal\hello\Access;

use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Access\AccessResult;

class HelloAccessCheck implements AccessCheckInterface {

    public function applies(Route $route)
    {
        return NULL;
        // TODO: Implement applies() method.
    }

    public function access(Route $route, Request $request = NULL, AccountInterface $account) {

        $heures = $route->getRequirement('_access_hello');
        $secondes = $heures * 3600;
        $date_de_creation = $account->getAccount()->created;
        $date_aujourdhui = time();

        if ($date_de_creation < $date_aujourdhui - $secondes) {
            return AccessResult::allowed();
        } else {
            return AccessResult::forbidden();
        }
    }
}