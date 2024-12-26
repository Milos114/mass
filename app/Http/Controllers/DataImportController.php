<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataImportRequest;
use App\Imports\OrdersImport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataImportController extends Controller
{
    public function index()
    {
        return view('dataImport.data-import', [
            'types' => array_keys(config('mass.orders.files')),
        ]);
    }

    public function store(DataImportRequest $request): RedirectResponse
    {
        Excel::import(new OrdersImport($request->get('file_type')), $request->file('data'));

        return back()->with('success', 'File uploaded successfully.');
    }

    public function getData(Request $request): JsonResponse
    {
        $type = $request->get('type');
        $headers = config("mass.orders.files.$type.headers_to_db");

        $data = collect($headers)->map(function ($header) {
            return ['label' => $header['label']];
        });

        return response()->json($data);
    }
}
