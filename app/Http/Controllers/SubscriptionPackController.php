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

        $subscription_pack = new SubscriptionPack;

        $subscription_pack->name = $validated['name'] ?? null;
		$subscription_pack->slug = Str::slug($validated['name']);
		$subscription_pack->description = $validated['description'] ?? null;
		$subscription_pack->price = $validated['price'] ?? null;
		$subscription_pack->duration = $validated['duration'] ?? null;
		$subscription_pack->type = $validated['type'] ?? null;

        $subscription_pack->save();

        $data = [
            'success'       => true,
            'subscription_pack'   => $subscription_pack
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionPack  $subscription_pack
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionPack $subscription_pack)
    {
        $data = [
            'success' => true,
            'subscription_pack' => $subscription_pack
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionPack  $subscription_pack
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionPack $subscription_pack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionPack  $subscription_pack
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionPackRequest $request, SubscriptionPack $subscription_pack)
    {
        $validated = $request->validated();

        $subscription_pack->name = $validated['name'] ?? null;
		$subscription_pack->slug = Str::slug($validated['name']);
		$subscription_pack->description = $validated['description'] ?? null;
		$subscription_pack->price = $validated['price'] ?? null;
		$subscription_pack->duration = $validated['duration'] ?? null;
		$subscription_pack->type = $validated['type'] ?? null;

        $subscription_pack->save();

        $data = [
            'success'       => true,
            'subscription_pack'   => $subscription_pack
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionPack  $subscription_pack
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionPack $subscription_pack)
    {
        $subscription_pack->delete();

        $data = [
            'success' => true,
            'subscription_pack' => $subscription_pack
        ];

        return response()->json($data);
    }
}
