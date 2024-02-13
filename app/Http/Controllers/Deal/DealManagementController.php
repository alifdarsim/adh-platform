<?php

namespace App\Http\Controllers\Deal;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealCreateRequest;
use App\Models\Projects;
use App\Models\User;
use App\Notifications\Deal\DealApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Str;
use Yajra\DataTables\Exceptions\Exception;

class DealManagementController extends Controller
{

    public function index()
    {
        $locations = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania","Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
        $positions = ["CEO", "CTO", "CFO", "COO", "HR Manager", "Software Engineer", "Product Manager", "Marketing Director", "Sales Manager", "Customer Support Representative", "Data Scientist", "Graphic Designer", "Operations Analyst", "Business Analyst", "Quality Assurance Specialist", "IT Administrator", "Network Engineer", "Legal Counsel", "Event Coordinator", "Public Relations Specialist", "Content Writer", "Research Scientist", "Logistics Coordinator", "Supply Chain Manager", "Project Manager", "Architect", "Electrical Engineer", "Mechanical Engineer", "Civil Engineer", "Chemical Engineer", "Executive Assistant", "Social Media Manager", "UI/UX Designer", "Systems Administrator", "Database Administrator", "Financial Analyst", "Investment Analyst", "Health and Safety Officer", "Warehouse Manager", "Recruitment Specialist", "Training Coordinator", "Legal Secretary", "Business Development Manager", "Facilities Manager", "IT Support Specialist", "Customer Success Manager", "Environmental Scientist", "Technical Writer", "Mobile App Developer"];
        $languages = ["Arabic", "Bengali", "Dutch", "English", "French", "German", "Hindi", "Indonesian", "Italian", "Japanese", "Korean", "Malay", "Mandarin Chinese", "Marathi", "Persian (Farsi)", "Polish", "Portuguese", "Punjabi", "Russian", "Spanish", "Swahili", "Tamil", "Telugu", "Thai", "Turkish", "Tagalog (Filipino)", "Ukrainian", "Urdu", "Vietnamese", "Yoruba"];
        return view('deal_management.index', [
            'locations' => $locations,
            'positions' => $positions,
            'languages' => $languages,
        ]);
    }

    public function create()
    {
        $locations = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania","Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
        $positions = ["CEO", "CTO", "CFO", "COO", "HR Manager", "Software Engineer", "Product Manager", "Marketing Director", "Sales Manager", "Customer Support Representative", "Data Scientist", "Graphic Designer", "Operations Analyst", "Business Analyst", "Quality Assurance Specialist", "IT Administrator", "Network Engineer", "Legal Counsel", "Event Coordinator", "Public Relations Specialist", "Content Writer", "Research Scientist", "Logistics Coordinator", "Supply Chain Manager", "Project Manager", "Architect", "Electrical Engineer", "Mechanical Engineer", "Civil Engineer", "Chemical Engineer", "Executive Assistant", "Social Media Manager", "UI/UX Designer", "Systems Administrator", "Database Administrator", "Financial Analyst", "Investment Analyst", "Health and Safety Officer", "Warehouse Manager", "Recruitment Specialist", "Training Coordinator", "Legal Secretary", "Business Development Manager", "Facilities Manager", "IT Support Specialist", "Customer Success Manager", "Environmental Scientist", "Technical Writer", "Mobile App Developer"];
        $languages = ["Arabic", "Bengali", "Dutch", "English", "French", "German", "Hindi", "Indonesian", "Italian", "Japanese", "Korean", "Malay", "Mandarin Chinese", "Marathi", "Persian (Farsi)", "Polish", "Portuguese", "Punjabi", "Russian", "Spanish", "Swahili", "Tamil", "Telugu", "Thai", "Turkish", "Tagalog (Filipino)", "Ukrainian", "Urdu", "Vietnamese", "Yoruba"];
        return view('deal_management.create', [
            'locations' => $locations,
            'positions' => $positions,
            'languages' => $languages,
        ]);
    }

    public function show($deal_ref_no)
    {
        $locations = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania","Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
        $positions = ["CEO", "CTO", "CFO", "COO", "HR Manager", "Software Engineer", "Product Manager", "Marketing Director", "Sales Manager", "Customer Support Representative", "Data Scientist", "Graphic Designer", "Operations Analyst", "Business Analyst", "Quality Assurance Specialist", "IT Administrator", "Network Engineer", "Legal Counsel", "Event Coordinator", "Public Relations Specialist", "Content Writer", "Research Scientist", "Logistics Coordinator", "Supply Chain Manager", "Project Manager", "Architect", "Electrical Engineer", "Mechanical Engineer", "Civil Engineer", "Chemical Engineer", "Executive Assistant", "Social Media Manager", "UI/UX Designer", "Systems Administrator", "Database Administrator", "Financial Analyst", "Investment Analyst", "Health and Safety Officer", "Warehouse Manager", "Recruitment Specialist", "Training Coordinator", "Legal Secretary", "Business Development Manager", "Facilities Manager", "IT Support Specialist", "Customer Success Manager", "Environmental Scientist", "Technical Writer", "Mobile App Developer"];
        $languages = ["Arabic", "Bengali", "Dutch", "English", "French", "German", "Hindi", "Indonesian", "Italian", "Japanese", "Korean", "Malay", "Mandarin Chinese", "Marathi", "Persian (Farsi)", "Polish", "Portuguese", "Punjabi", "Russian", "Spanish", "Swahili", "Tamil", "Telugu", "Thai", "Turkish", "Tagalog (Filipino)", "Ukrainian", "Urdu", "Vietnamese", "Yoruba"];
        $deal = Projects::where('ref_no', $deal_ref_no)->first();
        if (!$deal) {
            return view('errors.404');
        }
        return view('deal_management.view', [
            'deal' => $deal,
            'locations' => $locations,
            'positions' => $positions,
            'languages' => $languages,
        ]);
    }

    public function update($id)
    {
        $deal = Projects::find($id);
        $deal->deal_name = $request->deal_name;
        $deal->hub_type = $request->hub_type;
        $deal->deadline_date = $request->deadline_date;
        $deal->target_country = json_encode($request->target_country);
        $deal->communication_language = json_encode($request->communication_language);
        $deal->save();
        if ($deal) {
            return success('Deal updated successfully');
        } else {
            return error('Deal update failed');
        }
    }

    public function store(DealCreateRequest $request)
    {
        // create a random short uuid and uppercase it, also check if the uuid already exists in the database
        do {
            $uuid = strtoupper(Str::random(8));
            $deal = Projects::where('ref_no', $uuid)->first(); // just to make sure the uuid is unique
        } while ($deal);
        // Create deal
        $deal = Projects::create([
            'name' => $request->name,
            'position' => $request->position,
            'company' => $request->company,
            'location' => $request->location,
            'deal_name' => $request->deal_name,
            'hub_type' => $request->hub_type,
            'deadline_date' => $request->deadline_date,
            'company_location' => $request->company_location,
            'status' => 'pending',
            'target_country' => json_encode($request->target_country),
            'communication_language' => json_encode($request->communication_language),
            'ref_no' => $uuid,
            'applied_by' => Auth::user()->id,
        ]);

        if ($deal) {
            return success('Deal created successfully');
        } else {
            return error('Deal creation failed');
        }
    }

    public function approve(Request $request)
    {
        if (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super admin')) {
            return error('You are not authorized to perform this action');
        }
        if ($request->status == 'approve') {
            return error('Deal already approved');
        }
        $deal = Projects::find($request->id);
        $deal->status = 'approve';
        $deal->publish_date = now();
        $deal->save();

        // send notification to user that deal has been approved
        $user = User::find($deal->applied_by);
        $user->notify(new DealApproved($deal));

        return success('Deal approved successfully');
    }

    public function archive(Request $request)
    {
        if (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super admin')) {
            return error('You are not authorized to perform this action');
        }
        if ($request->status == 'archive') {
            return error('Deal already archived');
        }
        $deal = Projects::find($request->id);
        // if status not archive then archive it, else unarchive it
        if ($deal->archive == 1) {
            $deal->archive = 0;

        } else {
            $deal->archive = 1;
        }
        $deal->save();
        return success($deal->archive == 1 ? 'Deal archived successfully' : 'Deal unarchived successfully');
    }

    public function remove(Request $request)
    {
        if (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super admin')) {
            return error('You are not authorized to perform this action');
        }
        $deal = Projects::find($request->id);
        $deal->delete();
        return success('Deal removed successfully');
    }

    public function reject(Request $request)
    {
        if (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super admin')) {
            return error('You are not authorized to perform this action');
        }
        if ($request->status == 'rejected') {
            return error('Deal already rejected');
        }
        $deal = Projects::find($request->id);
        $deal->status = 'rejected';
        $deal->save();
        return success('Deal rejected successfully');
    }

    /**
     * Show the datatable data of all deals.
     * @throws Exception
     * @throws \Exception
     */
    public function data()
    {
        // get all admin user using datatable query
        $users = Projects::all();
        return datatables()->of($users)
            ->addColumn('action', function ($user) {
                return '<a href="' . route('deal_management.edit', $user->id) . '" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addColumn('name', function ($user) {
                return $user->name;
            })
            ->addColumn('position', function ($user) {
                return $user->position;
            })
            ->addColumn('company', function ($user) {
                return $user->company;
            })
            ->addColumn('location', function ($user) {
                return $user->location;
            })
            ->addColumn('deal_name', function ($user) {
                return $user->deal_name;
            })
            ->addColumn('hub_type', function ($user) {
                return $user->hub_type;
            })
            ->addColumn('deadline_date', function ($user) {
                return $user->deadline_date;
            })
            ->addColumn('company_location', function ($user) {
                return $user->company_location;
            })
            ->addColumn('status', function ($user) {
                return $user->status;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
