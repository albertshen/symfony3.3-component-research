<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * ParentContainer.
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class ParentContainer extends Container
{
    private $parameters;
    private $targetDirs = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services = array();
        $this->normalizedIds = array(
            'symfony\\component\\dependencyinjection\\child' => 'Symfony\\Component\\DependencyInjection\\Child',
            'symfony\\component\\dependencyinjection\\identity' => 'Symfony\\Component\\DependencyInjection\\Identity',
            'symfony\\component\\dependencyinjection\\person' => 'Symfony\\Component\\DependencyInjection\\Person',
        );
        $this->methodMap = array(
            'Symfony\\Component\\DependencyInjection\\Child' => 'getSymfony_Component_DependencyInjection_ChildService',
            'Symfony\\Component\\DependencyInjection\\Identity' => 'getSymfony_Component_DependencyInjection_IdentityService',
            'Symfony\\Component\\DependencyInjection\\Person' => 'getSymfony_Component_DependencyInjection_PersonService',
        );

        $this->aliases = array();
    }

    /**
     * {@inheritdoc}
     */
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    /**
     * {@inheritdoc}
     */
    public function isCompiled()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isFrozen()
    {
        @trigger_error(sprintf('The %s() method is deprecated since version 3.3 and will be removed in 4.0. Use the isCompiled() method instead.', __METHOD__), E_USER_DEPRECATED);

        return true;
    }

    /**
     * Gets the 'Symfony\Component\DependencyInjection\Child' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is autowired.
     *
     * @return \Symfony\Component\DependencyInjection\Child A Symfony\Component\DependencyInjection\Child instance
     */
    protected function getSymfony_Component_DependencyInjection_ChildService()
    {
        return $this->services['Symfony\Component\DependencyInjection\Child'] = new \Symfony\Component\DependencyInjection\Child(${($_ = isset($this->services['Symfony\Component\DependencyInjection\Identity']) ? $this->services['Symfony\Component\DependencyInjection\Identity'] : $this->get('Symfony\Component\DependencyInjection\Identity')) && false ?: '_'});
    }

    /**
     * Gets the 'Symfony\Component\DependencyInjection\Identity' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is autowired.
     *
     * @return \Symfony\Component\DependencyInjection\Identity A Symfony\Component\DependencyInjection\Identity instance
     */
    protected function getSymfony_Component_DependencyInjection_IdentityService()
    {
        return $this->services['Symfony\Component\DependencyInjection\Identity'] = new \Symfony\Component\DependencyInjection\Identity();
    }

    /**
     * Gets the 'Symfony\Component\DependencyInjection\Person' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is autowired.
     *
     * @return \Symfony\Component\DependencyInjection\Person A Symfony\Component\DependencyInjection\Person instance
     */
    protected function getSymfony_Component_DependencyInjection_PersonService()
    {
        return $this->services['Symfony\Component\DependencyInjection\Person'] = new \Symfony\Component\DependencyInjection\Person(${($_ = isset($this->services['Symfony\Component\DependencyInjection\Identity']) ? $this->services['Symfony\Component\DependencyInjection\Identity'] : $this->get('Symfony\Component\DependencyInjection\Identity')) && false ?: '_'});
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters) || isset($this->loadedDynamicParameters[$name]))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        $name = strtolower($name);

        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters) || isset($this->loadedDynamicParameters[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = array();
    private $dynamicParameters = array();

    /**
     * Computes a dynamic parameter.
     *
     * @param string The name of the dynamic parameter to load
     *
     * @return mixed The value of the dynamic parameter
     *
     * @throws InvalidArgumentException When the dynamic parameter does not exist
     */
    private function getDynamicParameter($name)
    {
        throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'id' => 'albertshen',
            'prop' => 'name',
        );
    }
}
