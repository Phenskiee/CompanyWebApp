<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Response;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $totalCompany = Company::count();
        $totalApplied = Company::whereNotNull('Applied_at')->count();
        $totalViewed = Company::where('status', 'Viewed')->count();
        $totalInterview = Company::where('status', 'For Interview')->count();
        $totalReject = Company::where('status', 'Rejected')->count();
        $totalPending = Company::where('status', 'Pending')->count();
        $totalJo = Company::where('interview_status', 'Job Offer')->count();
        $totalInterviewReject = Company::where('interview_status', 'Rejected')->count();
        $totalInterviewPending = Company::where('interview_status', 'Pending')->count();
        return view('index', compact(
            'totalCompany',
            'totalApplied',
            'totalInterview',
            'totalReject',
            'totalPending',
            'totalJo',
            'totalViewed',
            'totalInterviewReject',
            'totalInterviewPending'
        ));
    }
    
    public function companyList() {
        $list = Company::latest('created_at')
            ->paginate(7);
        return view("companyList", compact("list"));
    }

    public function store(Request $req) {
        $req->validate([
            "name"      => "required|string|max:255|unique:company_list,name",
            "position"  => "required|string|max:255",
            "email"     => "email|nullable|max:255",
            "platform"  => "required|string|max:255",
            "location"  => "nullable|string|max:255",
            "salary"    => "nullable|string|max:255",
            "setup"    => "nullable|string|max:255",
            "links"     => "nullable|string|max:255",
            "job_description" => "nullable|string|max:255",

            "applied_at"        => "nullable|date",
            "status"            => "nullable|string|max:255",
            "interview_date"    => "nullable|date",
            "interview_time"    => "nullable|date_format:H:i",
            "interview_status"  => "nullable|string|max:255"
        ]);

        Company::create($req->all());
        return redirect()->route("company-page")->with("add", "{$req->name}");
    }

    public function response(Request $request) {
        // $search = $request->query('search');
        // $status = $request->query('status');
        
        // Multiple Search
        // $responses = Company::query()
        // ->when($search, function($query, $search){
        //     $query->where(function($que) use ($search) {
        //         $que->where('name', 'like', "%{$search}%");
        //         // ->orWhere('status', 'like', "%{$search}%");
        //     });
        // })
        // ->whereNotNull('applied_at')
        // ->latest('created_at')
        // ->get();

        // $responses = Company::when($search, function($query, $search) {
        //     $query->where('name', 'LIKE', "%{$search}%");
        // })
        // ->when($status, function($query, $status) {
        //     $query->where('status', $status);
        // })
        // ->latest("created_at")
        // ->get();

        $responses = Company::whereNotNull('applied_at')
            ->latest('created_at')
            ->paginate(7);
        return view('response', compact('responses'));
    }

    public function apply(Company $applied) {
        // $company = Company::findOrFail($id);

        if($applied->applied_at !== null) {
            return redirect()->back()->with('error', "{$applied->name}");
        }
        
        $applied->update([
            'applied_at' => now(),
        ]);
        //  dd($company->name);
        return redirect()->route("company-page")->with('applied', "{$applied->name}");
    }

    public function show(Company $details) {
        // $company = Company::findOrFail($id);
        return view("show", compact('details'));
    }

    public function edit(Company $info) {
        // $info = Company::findOrFail($id);
        return view('edit', compact('info'));
    }

    public function update(Request $req, Company $info) {
        $validate = $req->validate([
            "name"      => "required|string|max:255",
            "position"  => "required|string|max:255",
            "email"     => "email|nullable|max:255",
            "platform"  => "required|string|max:255",
            "location"  => "nullable|string|max:255",
            "salary"    => "nullable|string|max:255",
            "setup"    => "nullable|string|max:255",
            "links"     => "nullable|string|max:255",
            "job_description" => "nullable|string|max:255",

            "applied_at"        => "nullable|date",
            "status"            => "nullable|string|max:255",
            "interview_date"    => "nullable|date",
            "interview_time"    => "nullable|date_format:H:i",
            "interview_status"  => "nullable|string|max:255"
        ]);
        $info->update($validate);
        return redirect()->route('response-page')->with('status', "{$req->name} status update");
    }

    public function search(Request $req) {
        $search = $req->input('search');
        $context = $req->input('context', 'response');

        $searching = Company::when($search, function($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })
        ->latest('created_at')
        ->paginate(7)
        ->map(function($company) use ($context) {
            $company->view_url = route('show-page', $company->id);
            $company->edit_url = route('edit-page', $company->id);
            $company->delete_url = route('delete-data', $company->id);
            $company->apply_url = route('apply-company', $company->id);

            if($context === "response") {
                $company->status_color = $company->status_class;
            }
            return $company;
        });

        // return view('response', compact('responses', 'search'));
        return response()->json($searching);
    }

    public function filter(Request $req) {
        $status = $req->input('status');

        $responses = Company::when($status, function ($query, $status) {
                if($status == 'Job Offer') {
                    return $query->where('interview_status', $status);
                }
                return $query->where('status', $status);
            })
            ->latest('created_at')
            ->paginate(7)
            ->map(function ($company) {
                $company->view_url = route('show-page', $company->id);
                $company->edit_url = route('edit-page', $company->id);
                $company->status_color = $company->status_class;
                return $company;
            });

    return response()->json($responses);
    }

    public function destroy(Company $company) {
        $company->delete();
        return redirect()->route('company-page');
    }
    
    
}