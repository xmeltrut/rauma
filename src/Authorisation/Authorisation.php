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
     * @param integer $id          Unique ID.
     * @param string  $description Name for the user.
     * @param array   $roles       List of roles the user has.
     * @param array   $attributes  List of arbitary attributes.
     *
     * @return null
     */
    public function authoriseUser($id, $description, $roles = [], $attributes = [])
    {
        $this->segment->set('id', $id);
        $this->segment->set('description', $description);
        $this->segment->set('authorised', true);
        $this->segment->set('roles', $roles);
        $this->segment->set('attributes', $attributes);
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
     * Get the user ID.
     *
     * @return string
     */
    public function getId()
    {
        return $this->segment->get('id');
    }

    /**
     * Get the user description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->segment->get('description');
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role Role identifier.
     * @return boolean
     */
    public function hasRole($role)
    {
        $roles = $this->segment->get('roles');

        return (
            is_array($roles) &&
            in_array($role, $roles)
        );
    }

    /**
     * Retrive an attribute.
     *
     * @param string $key Attribute key.
     * @return mixed
     */
    public function getAttribute($key)
    {
        $attributes = $this->segment->get('attributes');
        return isset($attributes[$key]) ? $attributes[$key] : null;
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
