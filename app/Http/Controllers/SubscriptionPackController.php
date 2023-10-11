<?php
namespace App\Http\Controllers;

use App\Models\SubscriptionPack;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubscriptionPackRequest;
use App\Http\Requests\UpdateSubscriptionPackRequest;
use Illuminate\Support\Str;


class SubscriptionPackController extends Controller
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
            'subscription_packs' => SubscriptionPack::where('id', '>', -1)
            ->orderBy('created_at', 'desc')->get()
        ];

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_index()
    {
        $data = [
            'success' => true,
            'subscription_packs' => SubscriptionPack::where('id', '>', -1)
            ->where('type', 'user')
            ->orderBy('created_at', 'desc')->get()
        ];

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recruiter_index()
    {
        $data = [
            'success' => true,
            'subscription_packs' => SubscriptionPack::where('id', '>', -1)
            ->where('type', 'recruiter')
            ->orderBy('created_at', 'desc')->get()
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
    public function store(StoreSubscriptionPackRequest $request)
    {
        $validated = $request->validated();

        $subscriptionpack = new SubscriptionPack;

        $subscriptionpack->name = $validated['name'] ?? null;
		$subscriptionpack->slug = Str::slug($validated['name']);
		$subscriptionpack->description = $validated['description'] ?? null;
		$subscriptionpack->price = $validated['price'] ?? null;
		$subscriptionpack->duration = $validated['duration'] ?? null;
		$subscriptionpack->type = $validated['type'] ?? null;

        $subscriptionpack->save();

        $data = [
            'success'       => true,
            'subscriptionpack'   => $subscriptionpack
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionPack  $subscriptionpack
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionPack $subscriptionpack)
    {
        $data = [
            'success' => true,
            'subscriptionpack' => $subscriptionpack
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionPack  $subscriptionpack
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionPack $subscriptionpack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionPack  $subscriptionpack
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionPackRequest $request, SubscriptionPack $subscriptionpack)
    {
        $validated = $request->validated();

        $subscriptionpack->name = $validated['name'] ?? null;
		$subscriptionpack->slug = Str::slug($validated['name']);
		$subscriptionpack->description = $validated['description'] ?? null;
		$subscriptionpack->price = $validated['price'] ?? null;
		$subscriptionpack->duration = $validated['duration'] ?? null;
		$subscriptionpack->type = $validated['type'] ?? null;

        $subscriptionpack->save();

        $data = [
            'success'       => true,
            'subscriptionpack'   => $subscriptionpack
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionPack  $subscriptionpack
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionPack $subscriptionpack)
    {
        $subscriptionpack->delete();

        $data = [
            'success' => true,
            'subscriptionpack' => $subscriptionpack
        ];

        return response()->json($data);
    }
}
