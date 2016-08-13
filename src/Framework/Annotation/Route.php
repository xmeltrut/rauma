<?php

namespace Rauma\Framework\Annotation;

/**
 * Provides a route annotation for controllers.
 *
 * @Annotation
 * @Target({"METHOD"})
 */
class Route
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $tokens = [];

    /**
     * @var string
     */
    protected $verbs;

    /**
     * Whitelist of verbs.
     *
     * @var array
     */
    protected $allowedVerbs = [
        'GET',
        'POST',
        'PUT',
        'DELETE'
    ];
    
    /**
     * Constructor. Assign instance variables.
     *
     * @param array $values Attributes from annotation tag.
     */
    public function __construct(array $values)
    {
        $this->processPath($values['value']);
        $this->verbs = isset($values['method']) ? $this->processVerbs($values['method']) : ['GET'];
    }

    /**
     * Process the path for tokens.
     *
     * @param string $path Path.
     * @return void
     */
    protected function processPath($path)
    {
        preg_match_all('/{([^}]+)}/', $path, $matches);

        foreach ($matches[0] as $key => $val) {
            if (strpos($val, ':') !== false) {
                $token = explode(':', $matches[1][$key]);
                $this->tokens[$token[0]] = $token[1];
                $path = str_replace($val, sprintf('{%s}', $token[0]), $path);
            }
        }

        $this->path = $path;
    }
    
    /**
     * Handle options for the method attribute.
     *
     * @param string $verbs Contents of method attribute.
     * @return array
     */
    protected function processVerbs($verbs)
    {
        $filteredVerbs = [];
        $verbList = (strpos($verbs, ',') === false) ? [$verbs] : explode(',', $verbs);
        
        foreach ($verbList as $verb) {
            if (in_array($verb, $this->allowedVerbs)) {
                $filteredVerbs[] = $verb;
            }
        }
        
        if (count($filteredVerbs) == 0) {
            throw new \Exception("No valid verbs were found in '$verbs'.");
        }
        
        return $filteredVerbs;
    }
    
    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
    }
    
    /**
     * Return the first verb from the list.
     *
     * @return string
     */
    public function getVerb()
    {
        return $this->verbs[0];
    }
    
    /**
     * Return additional verbs.
     *
     * @return array
     */
    public function getAdditionalVerbs()
    {
        return array_slice($this->verbs, 1);
    }
    
    /**
     * Automatically generate a name for this route.
     *
     * @return string
     */
    public function generateName()
    {
        $verb = strtolower($this->getVerb());
        $path = ($this->path == '/') ? '_index' : str_replace('/', '.', substr($this->path, 1));
        return sprintf('%s_%s', $verb, $path);
    }
}
