<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Application\ViewLoadLog;

use Ngmy\OkuribitoLaravel\Domain\Model\View\PathNormalizer;
use Ngmy\OkuribitoLaravel\Domain\Model\View\ViewFactory;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\RecordingDate;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLog;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogRepositoryInterface;
use Ngmy\OkuribitoLaravel\Domain\Service\Config\ConfigServiceInterface;

class ViewLoadLogService
{
    private $viewLoadLogRepository;

    private $configService;

    private $pathNormalizer;

    private $viewFactory;

    public function __construct(
        ViewLoadLogRepositoryInterface $viewLoadLogRepository,
        ConfigServiceInterface $configService,
        PathNormalizer $pathNormalizer,
        ViewFactory $viewFactory
    ) {
        $this->viewLoadLogRepository = $viewLoadLogRepository;
        $this->configService = $configService;
        $this->pathNormalizer = $pathNormalizer;
        $this->viewFactory = $viewFactory;
    }

    public function record(string $viewName, string $viewPath): void
    {
        $view = $this->viewFactory->createNormalizedPathView($this->pathNormalizer, $viewName, $viewPath);

        if ($view->isExclude($this->configService)) {
            return;
        }

        if ($view->isAlreadyLoaded($this->viewLoadLogRepository, $this->configService)) {
            return;
        }

        $recordingDate = RecordingDate::current();
        $log = ViewLoadLog::new($view, $recordingDate);

        $this->viewLoadLogRepository->save($log);
    }
}
