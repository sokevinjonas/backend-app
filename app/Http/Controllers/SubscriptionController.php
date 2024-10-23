<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plan' => 'required|string',
            'duration' => 'required|integer|min:1',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'phone_number' => 'required|string|min:8|max:15',
        ]);

        // Récupérer le matricule de l'utilisateur authentifié
        $user = Auth::user()->matricule;

        // Vérifier s'il existe déjà une souscription active
        $activeSubscription = Subscription::where('matricule_user', $user)
                                           ->where('status', 'active')
                                           ->first();

        if ($activeSubscription) {
            // Mettre à jour le statut de l'abonnement actif à 'expired'
            $activeSubscription->status = 'expired';
            $activeSubscription->save(); // Sauvegarder les modifications
        }

        // Créer une nouvelle souscription avec un statut "pending"
        $subscription = Subscription::create([
            'matricule_user' => $user,
            'plan' => $validated['plan'],
            'duration' => $validated['duration'],
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'phone_number' => $validated['phone_number'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'La souscription a été créée et est en attente de validation.',
            'subscription' => $subscription,
        ]);
    }

    public function getActiveSubscription()
    {
        $user = Auth::user()->matricule;

        $subscription = Subscription::where('matricule_user', $user)
                                    ->where('status', 'active')
                                    ->first();

        if ($subscription) {
            return response()->json($subscription);
        } else {
            return response()->json(null); // Aucun abonnement actif
        }
    }
    //cote frontend
    public function showSearchForm()
    {
        return view('subscriptions.search');
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'matricule' => 'required|string',
        ]);

        // Recherche des abonnements par matricule
        $subscriptions = Subscription::where('matricule_user', $validated['matricule'])
                                      ->get();

        return view('subscriptions.search', compact('subscriptions'));
    }

    public function activate($id)
    {
        $subscription = Subscription::find($id);

        if ($subscription) {
            // Mettre à jour le statut à "active"
            $subscription->status = 'active';

            // Définir la date de début
            $subscription->starts_at = Carbon::now();

            // Calculer la date de fin en fonction de la durée
            switch ($subscription->duration) {
                case 1:
                    $subscription->ends_at = Carbon::now()->addDays(30); // Ajoute 30 jours
                    break;
                case 6:
                    $subscription->ends_at = Carbon::now()->addDays(180); // Ajoute 180 jours
                    break;
                case 12:
                    $subscription->ends_at = Carbon::now()->addDays(360); // Ajoute 360 jours
                    break;
                default:
                    return redirect()->route('subscriptions.search')->with('error', 'Durée non valide.');
            }

            // Enregistrer les modifications
            $subscription->save();

            return redirect()->route('subscriptions.search')->with('success', 'Souscription activée avec succès.');
        }

        return redirect()->route('subscriptions.search')->with('error', 'Souscription non trouvée.');
    }

    public function cancel($id)
    {
        $subscription = Subscription::find($id);

        if ($subscription) {
            $subscription->status = 'cancel'; // ou un autre statut approprié
            $subscription->save();

            return redirect()->route('subscriptions.search')->with('success', 'Souscription annulée avec succès.');
        }

        return redirect()->route('subscriptions.search')->with('error', 'Souscription non trouvée.');
    }



}
