<?php

namespace Rauma\Authorisation;

use Aura\Session\Session;

/**
 * Handles user sessions.
 */
class Authorisation
{
    protected $session;
    protected $segment;

    /**
     * Constructor.
     *
     * @param Segment $session Session object.
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->segment = $session->getSegment('Rauma\\Authorisation');
    }

    /**
     * Set up the user to give them access.
     *
     * @param string $identifier Name for the user.
     * @param array  $roles      List of roles the user has.
     *
     * @return null
     */
    public function authoriseUser($identifier, $roles = [])
    {
        $this->segment->set('identifier', $identifier);
        $this->segment->set('authorised', true);
        $this->segment->set('roles', $roles);
        $this->session->regenerateId();
    }

    /**
     * Log a user out.
     *
     * @return null
     */
    public function deauthoriseUser()
    {
        $this->segment->clear();
    }

    /**
     * Get the user identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->segment->get('identifier');
    }

    /**
     * Hash a password.
     *
     * @param string $password Password
     * @return string
     */
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
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
            if (!$this->segment->get('authorised')) {
                throw new Exception\UnauthorisedException;
            }
        }

        if (isset($authInfo['allowed'])) {
            $roleInWhitelist = false;

            foreach ($authInfo['allowed'] as $roleAllowed) {
                if (in_array($roleAllowed, $this->segment->get('roles'))) {
                    $roleInWhitelist = true;
                }
            }
            
            if (!$roleInWhitelist) {
                throw new Exception\ForbiddenException;
            }
        }

        return true;
    }

    /**
     * Validate a password match.
     *
     * @param string $hash     Password hash
     * @param string $password Submitted-password
     * @return boolean
     */
    public function verifyPassword($hash, $password)
    {
        return password_verify($password, $hash);
    }
}
