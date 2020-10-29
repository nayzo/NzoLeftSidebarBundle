<?php

namespace Nzo\LeftSidebarBundle\Twig;

use Nzo\LeftSidebarBundle\Menu;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LeftSidebarExtension extends AbstractExtension
{
    private $menuLeftSidebar;

    public function __construct(MenuLeftSidebar $menuLeftSidebar)
    {
        $this->menuLeftSidebar = $menuLeftSidebar;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'display_left_sidebar', [$this->menuLeftSidebar, 'displayLeftSidebar'], [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            ),
        ];
    }
}
