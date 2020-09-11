<?php

declare(strict_types=1);

namespace Bobdenotter\Sitemap;

use Symfony\Component\Routing\Route;

class RegisterControllers
{
    public static function getRoutes(): array
    {
        return [
            'xml_sitemap' => new Route(
                '/sitemap.xml',
                ['_controller' => 'Bobdenotter\Sitemap\Controller::sitemap'],
            ),
            'xml_sitemap_xsl' => new Route(
                '/sitemap.xml',
                ['_controller' => 'Bobdenotter\Sitemap\Controller::feedSingle'],
                [
                    'type' => '(rss|atom|json)',
                    'extension' => '(rss|atom|json|xml)',
                ]
            ),
        ];
    }
}
