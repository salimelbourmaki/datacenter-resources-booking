<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Gère l'accès en fonction des rôles.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Si l'utilisateur n'est pas connecté, redirection
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. Vérification du compte actif
        if (!$user->is_active) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Votre compte est en attente de validation.']);
        }

        // 3. Normalisation et vérification
        $userRole = strtolower($user->role);

        // --- GESTION DE L'IMPERSONNATION POUR LE CRÉATEUR/ADMIN ---
        if ($userRole === 'admin' && session()->has('impersonated_role')) {
            // IMPORTANT : On ne doit pas appliquer l'impersonnation pour la route qui permet de changer de rôle !
            // Sinon, une fois en mode "user", on ne pourrait plus redevenir "admin".
            if (!$request->routeIs('admin.switch-role') && !$request->is('admin/switch-role')) {
                $userRole = strtolower(session('impersonated_role'));
            }
        }
        // ----------------------------------------------------------

        $allowedRoles = array_map('strtolower', $roles);

        // --- AUTORISATION DE SECOURS (GOD MODE) POUR L'ADMIN/CRÉATEUR ---
        // S'il s'agit d'un administrateur réel, on ne le bloque JAMAIS (évite les 403 bloquants)
        if (strtolower($user->role) === 'admin') {
            return $next($request);
        }
        // ----------------------------------------------------------------

        if (!in_array($userRole, $allowedRoles)) {
            abort(403, "Accès interdit : Profil actuel [{$userRole}] insuffisant.");
        }

        return $next($request);
    }
}