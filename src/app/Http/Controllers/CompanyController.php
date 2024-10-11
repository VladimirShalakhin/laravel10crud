<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CompanyCreateRequest;
use App\Models\Company;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(CompanyCreateRequest $request): JsonResponse
    {
        if ($request->hasFile('logo')) {
            $fileName = $request->file('logo')->getFilename();
            $request->logo->move(public_path('logo'), $fileName.'.'.$request->file('logo')->Extension());
            Company::create([
                'name' => $request->safe()->input('name'),
                'description' => $request->safe()->input('description'),
                'logo' => $fileName,
            ]);
        } else {
            Company::create($request->safe()->input());
        }

        return response()->json();
    }

    public function destroy(Company $company): JsonResponse
    {
        $company->delete();

        return response()->json();
    }

    public function getBest()
    {
        $topCompanies = DB::table('companies')
        ->selectRaw("companies.name AS company_name, avg(comments.rating) as average_rating")
        ->join('comments', 'companies.id', '=', 'comments.company_id')
        ->groupBy('companies.id', 'companies.name')
        ->orderBy('average_rating', 'desc')
        ->limit(10)
        ->get()->pluck('average_rating','company_name')->toArray();

        return response()->json($topCompanies);
    }

    public function getRating()
    {

    }
}
