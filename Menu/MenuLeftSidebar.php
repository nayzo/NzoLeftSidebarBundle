<?php

/**
 * This file is part of the NzoLeftSidebarBundle package.
 *
 * (c) Ala Eddine Khefifi <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nzo\LeftSidebarBundle\Menu;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class MenuLeftSidebar
{
    private $request;
    private $router;
    private $leftSidebarData;
    private $appEnvironment;

    public function __construct(
        RequestStack $requestStack,
        RouterInterface $router,
        array $leftSidebarData,
        string $appEnvironment = null
    ) {
        $this->request = $requestStack->getMasterRequest();
        $this->router = $router;
        $this->leftSidebarData = $leftSidebarData;
        $this->appEnvironment = $appEnvironment;
    }

    public function displayLeftSidebar(Environment $twig, string $leftSidebarActiveRouteName = null)
    {
        $currentRouteName = $this->request->attributes->get('_route');
        $leftSidebarActiveRouteName = $leftSidebarActiveRouteName ?? $currentRouteName;
        foreach ($this->leftSidebarData as $key => &$item) {
            if ($this->isAppEnvironmentNameExcluded($item)) {
                unset($this->leftSidebarData[$key]);
                continue;
            }

            if (isset($item['children'])) {
                $item = $this->buildChildren($item, $leftSidebarActiveRouteName);
            }

            if ($leftSidebarActiveRouteName == $key) {
                $item['active'] = true;
            }

            $this->handleRouting($item);
        }

        return $twig->render(
            '@NzoLeftSidebar/left-sidebar.html.twig',
            [
                'items' => $this->leftSidebarData,
            ]
        );
    }

    private function buildChildren($item, $leftSidebarActiveRouteName)
    {
        foreach ($item['children'] as $childrenKey => &$childrenItem) {
            if ($this->isAppEnvironmentNameExcluded($childrenItem)) {
                unset($item['children'][$childrenKey]);
                continue;
            }

            if (($leftSidebarActiveRouteName == $childrenKey)) {
                $childrenItem['active'] = true;
            }

            $this->handleRouting($childrenItem);

            if (isset($childrenItem['children'])) {
                $childrenItem = $this->buildChildren($childrenItem, $leftSidebarActiveRouteName);
            }
        }

        if (in_array($leftSidebarActiveRouteName, $this->getOffspringNames($item))) {
            $item['active'] = true;
        }

        return $item;
    }

    private function getOffspringNames($item)
    {
        $children = [];
        foreach ($item['children'] as $child) {
            if (isset($child['children'])) {
                $children = array_merge($children, $this->getOffspringNames($child));
            }
        }

        return array_merge($children, array_keys($item['children']));
    }

    private function isAppEnvironmentNameExcluded(array $item): bool
    {
        if (!empty($item['accepted_environment_names']) && null !== $this->appEnvironment) {
            $names = array_map('mb_strtolower', $item['accepted_environment_names']);

            return !in_array(mb_strtolower($this->appEnvironment), $names);
        }

        return false;
    }

    private function handleRouting(&$item)
    {
        try {
            $item['href'] = $this->router->generate($item['route_or_uri']);
        } catch (RouteNotFoundException $e) {
            $item['href'] = $this->generateRoute($item);
        }
    }

    private function generateRoute(array $item): string
    {
        $uri = '#';
        if (!empty($item['route_or_uri'])) {
            $uri = $item['route_or_uri'];
            $uri = ('/' !== $uri[0]) ? '/'.$uri : $uri;
        }

        return $uri;
    }
}
