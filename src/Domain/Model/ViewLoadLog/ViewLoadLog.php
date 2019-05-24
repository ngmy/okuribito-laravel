<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Domain\Model\ViewLoadLog;

use Ngmy\OkuribitoLaravel\Domain\Model\AbstractEntity;
use Ngmy\OkuribitoLaravel\Domain\Model\View\View;

class ViewLoadLog extends AbstractEntity
{
    private $viewLoadLogId;

    private $view;

    private $recordingDate;

    public static function new(View $view, RecordingDate $recordingDate): self
    {
        return new self(ViewLoadLogId::null(), $view, $recordingDate);
    }

    public function __construct(ViewLoadLogId $viewLoadLogId, View $view, RecordingDate $recordingDate)
    {
        $this->viewLoadLogId = $viewLoadLogId;
        $this->view = $view;
        $this->recordingDate = $recordingDate;
    }

    public function viewLoadLogId(): ViewLoadLogId
    {
        return $this->viewLoadLogId;
    }

    public function view(): View
    {
        return $this->view;
    }

    public function recordingDate(): RecordingDate
    {
        return $this->recordingDate;
    }

    public function equals($object): bool
    {
        $equalsObject = false;

        if (!is_null($object) && $object instanceof self) {
            $equalsObject = $this->viewLoadLogId()->equals($object->viewLoadLogId());
        }

        return $equalsObject;
    }

    public function toArray(): array
    {
        $viewValues = $this->view()->toArray();

        return [
            'view_load_log_id' => $this->viewLoadLogId()->value(),
            'view_name' => $viewValues['name'],
            'view_path' => $viewValues['path'],
            'recording_date' => $this->recordingDate()->value(),
        ];
    }
}
