<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Offer, Locality, Promotion};
use App\Http\Requests\OfferRequest;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        $query = $slug ? Locality::whereSlug($slug)->firstOrFail()->offers() : Offer::query();
        $offers = $query->withTrashed()->oldest('created_at')->paginate(10);
        return view('offers/index', compact('offers', 'slug'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offers/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $offerRequest)
    {
        $offer = Offer::create($offerRequest->all());
        $offer->promotions()->attach($offerRequest->promo);
        return redirect()->route('offers.index')->with('info', 'La offre a bien été créée');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        $locality = $offer->locality->name;
        return view('offers/show', compact('offer', 'locality'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('offers/edit', compact('offer'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $offerRequest, Offer $offer)
    {
        $offer->update($offerRequest->all());
        $offer->promotions()->sync($offerRequest->promo);
        return redirect()->route('offers.index')->with('info', 'Le offre à bien été modifié');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return back()->with('info', 'La offre a bien été mis dans la corbeille.');
    }

    public function forceDestroy($id)
    {
        Offer::withTrashed()->whereId($id)->firstOrFail()->forceDelete();
        return back()->with('info', 'La offre a bien été supprimé définitivement dans la base de données.');
    }

    public function restore($id)
    {
        Offer::withTrashed()->whereId($id)->firstOrFail()->restore();
        return back()->with('info', 'La offre a bien été restauré.');
    }
}
