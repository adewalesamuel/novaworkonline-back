<?php
namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPack;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Auth;


class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'success' => true,
            'subscriptions' => Subscription::where('id', '>', -1)
            ->orderBy('created_at', 'desc')->get()
        ];

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function user_index(Request $request)
    {
        $user = Auth::getUser($request, Auth::USER);

        $data = [
            'success' => true,
            'subscription' => Subscription::with(['subscription_pack'])
            ->where('id', '>', -1)
            ->where('subscriber_id', $user->id)
            ->where('type', 'user')
            ->orderBy('created_at', 'desc')->first()
        ];

        return response()->json($data);
    }

    public function recruiter_index(Request $request)
    {
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $data = [
            'success' => true,
            'subscription' => Subscription::with(['subscription_pack'])
            ->where('id', '>', -1)
            ->where('subscriber_id', $recruiter->id)
            ->where('type', 'recruiter')
            ->orderBy('created_at', 'desc')->first()
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionRequest $request)
    {
        $validated = $request->validated();

        $subscription = new Subscription;

        $subscription->type = $validated['type'] ?? null;
		$subscription->amount = $validated['amount'] ?? null;
		$subscription->payment_mode = $validated['payment_mode'] ?? null;
		$subscription->payment_status = $validated['payment_status'] ?? null;
		$subscription->expiration_date = $validated['expiration_date'] ?? null;
		$subscription->subscriber_id = $validated['subscriber_id'] ?? null;

        $subscription->save();

        $data = [
            'success'       => true,
            'subscription'   => $subscription
        ];

        return response()->json($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user_store(StoreSubscriptionRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::getUser($request, Auth::USER);

        //Make payment

        $subscription_pack = SubscriptionPack::findOrFail($validated['subscription_pack_id']);
        $subscription = new Subscription;

        $subscription->type = 'user';
		$subscription->amount = $subscription_pack->price;
		$subscription->payment_mode = $validated['payment_mode'] ?? null;
		$subscription->subscription_pack_id = $validated['subscription_pack_id'] ?? null;
		$subscription->expiration_date = Carbon::now()->addMonth($subscription_pack->duration ?? 1);
		$subscription->subscriber_id = $user->id;

        $subscription->save();

        $data = [
            'success'       => true,
            'subscription'   => $subscription
        ];

        return response()->json($data);
    }


    public function recruiter_store(StoreSubscriptionRequest $request)
    {
        $validated = $request->validated();
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        //Make payment

        $subscription_pack = SubscriptionPack::findOrFail($validated['subscription_pack_id']);
        $subscription = new Subscription;

        $subscription->type = 'recruiter';
		$subscription->amount = $subscription_pack->price;
		$subscription->payment_mode = $validated['payment_mode'] ?? 'other';
		$subscription->subscription_pack_id = $validated['subscription_pack_id'] ?? null;
		$subscription->expiration_date = Carbon::now()->addMonth($subscription_pack->duration ?? 1);
		$subscription->subscriber_id = $recruiter->id;

        $subscription->save();

        $data = [
            'success'       => true,
            'subscription'   => $subscription
        ];

        return response()->json($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        $data = [
            'success' => true,
            'subscription' => $subscription
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $validated = $request->validated();

        $subscription->type = $validated['type'] ?? null;
		$subscription->amount = $validated['amount'] ?? null;
		$subscription->payment_mode = $validated['payment_mode'] ?? null;
		$subscription->payment_status = $validated['payment_status'] ?? null;
		$subscription->expiration_date = $validated['expiration_date'] ?? null;
		$subscription->subscriber_id = $validated['subscriber_id'] ?? null;

        $subscription->save();

        $data = [
            'success'       => true,
            'subscription'   => $subscription
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        $data = [
            'success' => true,
            'subscription' => $subscription
        ];

        return response()->json($data);
    }
}
