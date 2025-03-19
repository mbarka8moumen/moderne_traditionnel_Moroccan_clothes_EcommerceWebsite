<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Méthode pour la connexion de l'utilisateur
    public function login(Request $request)
    {
        // Validation des données d'entrée
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentative de connexion
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');  // Redirection vers le panier après la connexion
        }

        // Si les informations sont incorrectes, afficher une erreur spécifique
        return back()->withErrors(['email' => 'Les informations d\'identification sont incorrectes.'])
                     ->withInput();  // Retourner les anciennes données saisies
    }

    // Méthode pour l'inscription de l'utilisateur
    public function register(Request $request)
{
    // Validation des données d'inscription
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    // Hashage du mot de passe avant de le stocker
    $data['password'] = Hash::make($data['password']);

    // Création de l'utilisateur dans la base de données
    User::create($data);

    // Redirection vers la page de connexion après l'inscription
    return redirect()->route('login')->with('success', 'Compte créé avec succès ! Veuillez vous connecter.');
}
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect('/login')->with('success', 'Vous êtes déconnecté.');
}

}
