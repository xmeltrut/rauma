<?php

namespace Rauma\Framework\Annotation;

/**
 * Restricts a resource to a list of groups.
 *
 * @Annotation
 * @Target({"CLASS","METHOD"})
 */
class Allowed
{
    protected $roles;

    /**
     * Constructor. Assign instance variables.
     *
     * @param array $values Attributes from annotation tag.
     */
    public function __construct(array $values)
    {
        $this->roles = explode(',', $values['value']);
    }

    /**
     * Get a list of roles.
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
