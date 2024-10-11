<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CompanyCreateRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Comment;
use App\Models\Company;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Storage;

class CompanyController extends Controller
{
    private const COMMENTS_PER_PAGE = 1;
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

    public function update(Company $company, CompanyUpdateRequest $request): JsonResponse
    {
        if ($request->hasFile('logo')) {
            Storage::delete($company->logo);
            $fileName = $request->file('logo')->getFilename();
            $request->logo->move(public_path('logo'), $fileName.'.'.$request->file('logo')->Extension());
            $company->update([
                'name' => $request->safe()->input('name'),
                'description' => $request->safe()->input('description'),
                'logo' => $fileName,
            ]);
        } else {
            $company->update($request->safe()->input());
        }

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

    public function getRating(Company $company): JsonResponse
    {
        return response()->json(['rating' => Comment::where('company_id', $company->id)->pluck('rating')->avg()]);
    }

    public function getComments(Company $company): LengthAwarePaginator
    {
        return Comment::select('body')->where('company_id', $company->id)->paginate(self::COMMENTS_PER_PAGE);
    }
}
