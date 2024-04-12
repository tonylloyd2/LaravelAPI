<?php

namespace App\Http\Controllers;

use App\Models\Subscription; // Import the Subscription model
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'website_id' => 'required|exists:websites,id',
    ]);

    // Check if the user is already subscribed to the website
    if (Subscription::where('user_id', $validated['user_id'])->where('website_id', $validated['website_id'])->exists()) {
        return response()->json(['error' => 'User is already subscribed to this website'], 400);
    }

    $subscription = new Subscription;
    $subscription->user_id = $validated['user_id'];
    $subscription->website_id = $validated['website_id'];
    $subscription->save();

    return response()->json($subscription, 201);
}
}
