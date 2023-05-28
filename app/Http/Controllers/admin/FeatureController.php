<?php

namespace App\Http\Controllers\admin;

use App\Http\constants\CacheConstant;
use App\Http\constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureStoreRequest;
use App\Http\Requests\FeatureUpdateRequest;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 0;
        $features = Cache::remember('adminShowFeatures_' . $page, CacheConstant::ONE_DAY, function () {
            return Feature::latest()->paginate(Constants::PAGINATION_DEFAULT);
        });
        return view('admin.feature.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureStoreRequest $request)
    {
        $data=$request->validated();
        Feature::create($data);
        // remove cache
        forGetCache('showFeatures_');
        forGetCache('adminShowFeatures_');
        return redirect()->route('admin.feature.index')->with('message', [
            'type' => "success",
            'body' => ('ویژگی با موفقیت ایجاد گردید')
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        return view('admin.feature.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureUpdateRequest $request, Feature $feature)
    {
        $data=$request->validated();
        $feature->update($data);
        // remove cache
        forGetCache('showFeatures_');
        forGetCache('adminShowFeatures_');
        return redirect()->route('admin.feature.index')->with('message', [
            'type' => "success",
            'body' => ('ویژگی با موفقیت ویرایش گردید')
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        // remove cache
        forGetCache('showFeatures_');
        forGetCache('adminShowFeatures_');
        return redirect()->back()->with('message', [
            'type' => 'warning',
            'body' => "ویژگی حذف گردید"
        ]);
    }
}
