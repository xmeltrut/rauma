<?php

namespace Rauma\Authorisation;

/**
 * This is used by the framework to control access to routes.
 */
class AuthorisationManager
{
    private $auth;

    /**
     * Constructor.
     *
     * @param Authorisation $authorisation Authorisation service.
     */
    public function __construct(Authorisation $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Check if a user has access to a particular route.
     *
     * @param array $authInfo Array of auth information
     * @return boolean
     */
    public function validateRoute($authInfo)
    {
        if (isset($authInfo['required']) && $authInfo['required']) {
            if (!$this->auth->isLoggedIn()) {
                throw new Exception\UnauthorisedException;
            }
        }

        if (isset($authInfo['allowed'])) {
            $roleInWhitelist = false;

            foreach ($authInfo['allowed'] as $roleAllowed) {
                if ($this->auth->hasRole($roleAllowed)) {
                    $roleInWhitelist = true;
                }
            }
            
            if (!$roleInWhitelist) {
                throw new Exception\ForbiddenException;
            }
        }

        return true;
    }
}
