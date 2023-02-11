<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;

class VariantController extends Controller
{
    public function getAttributeVariants()
    {
        $data = Attribute::with(['variants' => function($q){
            return $q->orderBy('variant','asc');
        }])->get()->toArray();
        return response()->json($data);
    }
}