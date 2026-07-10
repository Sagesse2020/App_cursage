<?php

namespace App\Policies;

use App\Models\Chien;
use App\Models\User;

class ChienPolicy
{
    /**
     * Voir la liste des chiens
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Voir un chien
     */
    public function view(User $user, Chien $chien): bool
    {
        // Admin niveau 3
        if (
            $user->role === 'admin' &&
            $user->niveau_admin == 3
        ) {
            return true;
        }

        // Admin niveau 2
        if (
            $user->role === 'admin' &&
            $user->niveau_admin == 2
        ) {
            return true;
        }

        // Admin niveau 1
        if (
            $user->role === 'admin' &&
            $user->niveau_admin == 1
        ) {
            return true;
        }

        // Aucun partenaire
        if (!$user->partenaire) {
            return false;
        }

        // Revendeur
        if ($user->partenaire->type_partenaire == 'revendeur') {

            return $chien->partenaire_id == $user->partenaire_id;
        }

        // Apporteur d'affaires
        if ($user->partenaire->type_partenaire == 'apporteur_affaires') {

            return $chien->partenaire_id == $user->partenaire_id;
        }

        return false;
    }

    /**
     * Créer un chien
     */
    public function create(User $user): bool
    {
        if ($user->role == 'admin') {
            return true;
        }

        return $user->role == 'partenaire';
    }

    /**
     * Modifier
     */
    public function update(User $user, Chien $chien): bool
    {
        // Administrateurs
        if ($user->role == 'admin') {
            return true;
        }

        // Partenaire : uniquement ses chiens
        return $chien->partenaire_id == $user->partenaire_id;
    }

    /**
     * Supprimer
     */
    public function delete(User $user, Chien $chien): bool
    {
        if (
            $user->role == 'admin' &&
            $user->niveau_admin >= 2
        ) {
            return true;
        }

        return $chien->partenaire_id == $user->partenaire_id;
    }

    /**
     * Restaurer
     */
    public function restore(User $user, Chien $chien): bool
    {
        return $this->delete($user, $chien);
    }

    /**
     * Suppression définitive
     */
    public function forceDelete(User $user, Chien $chien): bool
    {
        return (
            $user->role == 'admin' &&
            $user->niveau_admin == 3
        );
    }
}