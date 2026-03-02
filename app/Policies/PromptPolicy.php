<?php

namespace App\Policies;

use App\Models\Prompt;
use App\Models\User;

class PromptPolicy
{
    /**
     * Users can only view their own prompts.
     */
    public function view(User $user, Prompt $prompt): bool
    {
        return $user->id === $prompt->user_id;
    }
}
