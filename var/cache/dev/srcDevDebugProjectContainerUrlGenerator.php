<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        'app_createteam__invoke' => array(array('leagueId'), array('_controller' => 'App\\Controller\\CreateTeamController'), array(), array(array('text', '/teams'), array('variable', '/', '[^/]++', 'leagueId'), array('text', '/leagues')), array(), array()),
        'app_deleteleague__invoke' => array(array('leagueId'), array('_controller' => 'App\\Controller\\DeleteLeagueController'), array(), array(array('variable', '/', '[^/]++', 'leagueId'), array('text', '/leagues')), array(), array()),
        'app_getteams__invoke' => array(array('leagueId'), array('_controller' => 'App\\Controller\\GetTeamsController'), array(), array(array('text', '/teams'), array('variable', '/', '[^/]++', 'leagueId'), array('text', '/leagues')), array(), array()),
        'app_updateteam__invoke' => array(array('leagueId', 'teamId'), array('_controller' => 'App\\Controller\\UpdateTeamController'), array(), array(array('variable', '/', '[^/]++', 'teamId'), array('text', '/teams'), array('variable', '/', '[^/]++', 'leagueId'), array('text', '/leagues')), array(), array()),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && (self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
            unset($parameters['_locale']);
            $name .= '.'.$locale;
        } elseif (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
