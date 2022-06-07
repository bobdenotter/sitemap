<?php

declare(strict_types=1);

namespace Bobdenotter\Sitemap;

use Bolt\Configuration\Config;
use Bolt\Entity\Taxonomy;
use Bolt\Extension\ExtensionController;
use Bolt\Repository\TaxonomyRepository;
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
        $showListings = $config->get('show_listings');
        $contentTypes = $this->boltConfig->get('contenttypes')->where('viewless', false)->keys()->implode(',');
        $records = $this->createPager($query, $contentTypes, $config['limit']);

        $context = [
            'title' => 'Sitemap',
            'records' => $records,
            'showListings' => $showListings,
        ];

        if (isset($config['taxonomies']) && is_array($config['taxonomies'])) {
            $taxonomyRecords = [];

            /** @var TaxonomyRepository $taxonomyRepository */
            $taxonomyRepository = $this->getDoctrine()->getRepository(Taxonomy::class);

            /** @var string $taxonomy */
            foreach ($config['taxonomies'] as $taxonomy) {
                $taxonomyRecords = array_merge($taxonomyRecords, $taxonomyRepository->findBy(['type' => $taxonomy]));
            }

            $context['taxonomies'] = $taxonomyRecords;
        }

        $headerContentType = 'text/xml;charset=UTF-8';

        $view = isset($config['templates']['xml'])
            ? $config['templates']['xml']
            : '@sitemap/sitemap.xml.twig';

        $response = $this->render($view, $context);
        $response->headers->set('Content-Type', $headerContentType);

        return $response;
    }

    public function xsl(): Response
    {
        $headerContentType = 'text/xml;charset=UTF-8';

        $config = $this->getConfig();
        $view = isset($config['templates']['xsl'])
            ? $config['templates']['xsl']
            : '@sitemap/sitemap.xsl';

        $response = $this->render($view);
        $response->headers->set('Content-Type', $headerContentType);

        return $response;
    }

    private function createPager(Query $query, string $contentType, int $pageSize)
    {
        $params = [
            'status' => 'published',
            'returnmultiple' => true,
            'order' => 'id',
        ];

        return $query->getContentForTwig($contentType, $params)
            ->setMaxPerPage($pageSize)
            ->setCurrentPage(1);
    }
}
