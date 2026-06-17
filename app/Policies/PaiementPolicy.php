<?php

namespace App\Policies;

use App\Models\Paiement;
use App\Models\User;

class PaiementPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Paiement $paiement): bool
    {
        return $user->id === $paiement->user_id
            || $user->niveau_admin == 3;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Paiement $paiement): bool
    {
        return $user->niveau_admin == 3;
    }

    public function delete(User $user, Paiement $paiement): bool
    {
        return $user->niveau_admin == 3;
    }
}