<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Model\View;

use Ngmy\OkuribitoLaravel\Domain\Model\AbstractEntity;
use Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog\ViewLoadLogRepositoryInterface;
use Ngmy\OkuribitoLaravel\Domain\Service\Config\ConfigServiceInterface;

class View extends AbstractEntity
{
    private $name;

    private $path;

    public function __construct(Name $name, Path $path)
    {
        $this->name = $name;
        $this->path = $path;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function path(): Path
    {
        return $this->path;
    }

    public function isExclude(ConfigServiceInterface $configService): bool
    {
        $excludeFiles = $configService->get('ngmy-okuribito-laravel.exclude_files');
        return in_array($this->path()->value(), $excludeFiles);
    }

    public function isAlreadyLoaded(
        ViewLoadLogRepositoryInterface $viewLoadLogRepository,
        ConfigServiceInterface $configService
    ): bool {
        $recordOnce = $configService->get('ngmy-okuribito-laravel.record_once');
        return $recordOnce && $viewLoadLogRepository->existsByView($this);
    }

    public function equals($object): bool
    {
        $equalsObject = false;

        if (!is_null($object) && $object instanceof self) {
            $equalsObject = $this->path()->equals($object->path());
        }

        return $equalsObject;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name()->value(),
            'path' => $this->path()->value(),
        ];
    }
}
