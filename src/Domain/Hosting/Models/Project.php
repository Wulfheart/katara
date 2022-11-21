<?php

namespace Domain\Hosting\Models;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory, HasUuids;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getK8sLabels(): array
    {
        return [
            'katara-project' => $this->name,
            'katara-project-id' => $this->id
        ];
    }

    public function getK8sNamespace(): string
    {
        return $this->name;
    }
}
