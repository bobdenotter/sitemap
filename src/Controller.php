<?php

declare(strict_types=1);

namespace Bobdenotter\Sitemap;

use Bolt\Extension\ExtensionController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends ExtensionController
{
    public function feed($type = 'foo', $extension = 'xml'): Response
    {
        $context = [
            'title' => 'AcmeCorp Reference Extension',
            'type' => $type,
        ];

        return $this->render('@rss-extension/rss.xml.twig', $context);
    }
}
