<?php
declare(strict_types=1);

namespace Ngmy\OkuribitoLaravel\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Ngmy\OkuribitoLaravel\Infrastructure\Eloquent\ViewLoadLog
 *
 * @property int $id
 * @property string $view_name
 * @property string $view_path
 * @property string $recording_date
 * @method static bool exists()
 * @method static $this where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\Ngmy\OkuribitoLaravel\Infrastructure\Eloquent\ViewLoadLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ngmy\OkuribitoLaravel\Infrastructure\Eloquent\ViewLoadLog whereRecordingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ngmy\OkuribitoLaravel\Infrastructure\Eloquent\ViewLoadLog whereViewName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Ngmy\OkuribitoLaravel\Infrastructure\Eloquent\ViewLoadLog whereViewPath($value)
 * @mixin \Eloquent
 */
class ViewLoadLog extends Model
{
    public $timestamps = false;
}
