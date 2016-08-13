<?php

namespace Rauma\Authorisation;

use Aura\Session\Session;

/**
 * Create authorisation objects.
 */
class AuthorisationFactory
{
    /**
     * Create a new authorisation instance.
     *
     * @return Authorisation
     */
    public static function create(Session $session)
    {
        return new Authorisation($session);
    }
}
