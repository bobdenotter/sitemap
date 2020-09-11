<?php

declare(strict_types=1);

namespace Bobdenotter\Sitemap;

use Bolt\Widget\BaseWidget;
use Bolt\Widget\CacheAware;
use Bolt\Widget\CacheTrait;
use Bolt\Widget\Injector\AdditionalTarget;
use Bolt\Widget\Injector\RequestZone;
use Bolt\Widget\StopwatchAware;
use Bolt\Widget\StopwatchTrait;
use Bolt\Widget\TwigAware;

class ReferenceWidget extends BaseWidget implements TwigAware, CacheAware, StopwatchAware
{
    use CacheTrait;
    use StopwatchTrait;

    protected $name = 'AcmeCorp ReferenceWidget';
    protected $target = AdditionalTarget::WIDGET_BACK_DASHBOARD_ASIDE_TOP;
    protected $priority = 200;
    protected $template = '@acmecorp-referencewidget/widget.html.twig';
    protected $zone = RequestZone::BACKEND;
    protected $cacheDuration = -1800;
}
