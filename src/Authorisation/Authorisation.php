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
     * @param array   $roles       List of roles the user has.
     * @param array   $attributes  List of arbitary attributes.
     *
     * @return void
     */
    public function authoriseUser($id, $roles = [], $attributes = [])
    {
        $this->segment->set('id', $id);
        $this->segment->set('authorised', true);
        $this->segment->set('roles', $roles);
        $this->segment->set('attributes', $attributes);
        $this->session->regenerateId();
    }

    /**
     * Log a user out.
     *
     * @return void
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
     * Is the user currently logged in?
     *
     * @return boolean
     */
    public function isLoggedIn()
    {
        return $this->segment->get('authorised') || false;
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
        if ($hash === null || $hash === '' || $password === null || $password === '') {
            return false;
        }

        return password_verify($password, $hash);
    }
}
