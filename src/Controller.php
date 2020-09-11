<?php

declare(strict_types=1);

namespace Bobdenotter\Sitemap;

use Bolt\Configuration\Config;
use Bolt\Extension\ExtensionController;
use Bolt\Storage\Query;
use Symfony\Component\HttpFoundation\Response;

class Controller extends ExtensionController
{
    public function __construct(Config $config)
    {
        $this->boltConfig = $config;
    }
    public function sitemap(Query $query): Response
    {
        $config = $this->getConfig();
        $contentTypes = $this->boltConfig->get('contenttypes')->where('viewless', false)->keys()->implode(',');

        $records = $this->createPager($query, $contentTypes, $config['limit']);

        $context = [
            'title' => 'Sitemap',
            'records' => $records,
        ];

        $headerContentType = 'text/xml;charset=UTF-8';

        $response = $this->render('@sitemap/sitemap.xml.twig', $context);
        $response->headers->set('Content-Type', $headerContentType);

        return $response;
    }

    public function xsl(): Response
    {
        $headerContentType = 'text/xml;charset=UTF-8';

        $response = $this->render('@sitemap/sitemap.xsl');
        $response->headers->set('Content-Type', $headerContentType);

        return $response;
    }

    private function createPager(Query $query, string $contentType, int $pageSize)
    {
        $params = [
            'status' => '!unknown',
            'returnmultiple' => true,
            'order' => 'id',
        ];

        return $query->getContentForTwig($contentType, $params)
            ->setMaxPerPage($pageSize)
            ->setCurrentPage(1);
    }
}
