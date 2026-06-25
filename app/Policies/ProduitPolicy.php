<?php

namespace App\Policies;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProduitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Produit $produit): bool
    {
        if ($user->niveau_admin >= 1) {
        return true;
    }

    $partenaire = $user->partenaire;

    if (!$partenaire) {
        return false;
    }

    // Apporteur d'affaires
    if ($partenaire->type_partenaire === 'apporteur_affaires') {
        return true;
    }

    // Revendeur
    if ($partenaire->type_partenaire === 'revendeur') {

        return $produit->partenaire_id
            === $partenaire->id;
    }

    return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         return $user->niveau_admin >= 2;
    }

    /**
     * Determine whether the user can update the model.
     */
public function update(User $user, Produit $produit)
{
    // admin 3 peut tout modifier
    if ($user->niveau_admin == 3) {
        return true;
    }

    // admin 2 peut modifier tout sauf restriction future
    if ($user->niveau_admin == 2) {
        return true;
    }

    // partenaire : seulement ses produits
    return $produit->user_id === $user->id;
}
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Produit $produit): bool
    {
          if($user->niveau_admin == 3){
          return true;
          }

    return $produit->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Produit $produit): bool
    {
          if($user->niveau_admin == 3){
        return true;
        }

       return $produit->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Produit $produit): bool
    {
   
    }
}
