<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use App\Repositories\Contact\ContactRepositoryInterface;
use Carbon\Carbon;;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function back;
use function view;

class ContactController extends BaseController
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('7', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });

        $this->contactRepository = $contactRepository;
    }

    public function index()
    {
        $contacts = $this->contactRepository->all();
        return view('admins.contacts.index', [
            'contacts' => $contacts
        ]);
    }

    public function destroy($id)
    {
        if ($id) {
            try {
                DB::beginTransaction();

                $this->contactRepository->delete($id);

                DB::commit();
                return back()->with('success', 'Delete success');
            } catch (\Exception $e) {
                Log::notice("Delete failed" . $e . ' ' . Carbon::now());
                return back()->with('error', 'Errors! Please try again.');
            }
        }
    }
}
