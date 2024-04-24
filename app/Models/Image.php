<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{

    protected $guarded = false;

    public function getUrlAttribute()
    {
        return url('storage/' . $this->path);
    }

    public function scopeCleanFromStorage(Builder $builder)
    {
        return $builder->where('user_id', auth()->id())
            ->whereNull('message_id')
            ->get()
            ->pluck('path')
            ->each(function ($path) {
                Storage::disk('public')->delete($path);
            });
    }

    public function scopeCleanFromTable(Builder $builder)
    {
        return $builder->where('user_id', auth()->id())
            ->whereNull('message_id')->delete();
    }

    public function scopeUpdateMessageId(Builder $builder, $imgIds, $message)
    {
        return $builder->whereIn('id', $imgIds)->update([
            'message_id' => $message->id
        ]);
    }
}
