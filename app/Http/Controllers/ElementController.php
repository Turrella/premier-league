<?php

namespace App\Http\Controllers;

use App\Models\Element\Element;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        return Cache::remember('all_players', 60, function () {
            return Element::query()->select(['id', DB::raw("concat(first_name, ', ', second_name) as 'full name'")])->get();
        });
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function show(int $id)
    {
        return Element::with(['team', 'elementType'])->find($id);
    }
}
