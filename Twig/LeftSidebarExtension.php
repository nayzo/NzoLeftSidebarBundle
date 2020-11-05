<?php

/**
 * This file is part of the NzoLeftSidebarBundle package.
 *
 * (c) Ala Eddine Khefifi <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nzo\LeftSidebarBundle\Twig;

use Nzo\LeftSidebarBundle\Menu\MenuLeftSidebar;
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
