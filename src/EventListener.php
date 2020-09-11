<?php

declare(strict_types=1);

namespace Bobdenotter\Sitemap;

use Symfony\Component\HttpKernel\Event\ResponseEvent;

class EventListener
{
    public function handleEvent(ResponseEvent $e): void
    {
        $content = $e->getResponse()->getContent();
        $content .= "\n<!-- It works! -->\n";

        $response->setContent($content);
    }
}
