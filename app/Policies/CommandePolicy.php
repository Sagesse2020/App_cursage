<?php

namespace App\Policies;

use App\Models\Commande;
use App\Models\User;

class CommandePolicy
{
    /**
     * Voir la liste des commandes
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Voir une commande
     */
    public function view(User $user, Commande $commande): bool
    {
        // Tous les administrateurs
        if ($user->role === 'admin') {
            return true;
        }

        // Aucun partenaire associé
        if (!$user->partenaire_id) {
            return false;
        }

        // La commande appartient au partenaire connecté
        return $commande->partenaire_id == $user->partenaire_id;
    }

    /**
     * Créer une commande
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'partenaire']);
    }

    /**
     * Modifier
     */
    public function update(User $user, Commande $commande): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $commande->partenaire_id == $user->partenaire_id;
    }

    /**
     * Supprimer
     */
    public function delete(User $user, Commande $commande): bool
    {
        if (
            $user->role === 'admin'
            && $user->niveau_admin >= 2
        ) {
            return true;
        }

        return $commande->partenaire_id == $user->partenaire_id;
    }

    public function restore(User $user, Commande $commande): bool
    {
        return $this->delete($user, $commande);
    }

    public function forceDelete(User $user, Commande $commande): bool
    {
        return (
            $user->role === 'admin'
            && $user->niveau_admin == 3
        );
    }
}