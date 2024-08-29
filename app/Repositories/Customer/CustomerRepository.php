<?php


namespace App\Repositories\Customer;


use App\Models\Customer;
use App\Models\ViewedProduct;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Support\Facades\DB;

class CustomerRepository extends BaseEloquentRepository implements CustomerRepositoryInterface
{

    public function model()
    {
        return Customer::class;
    }

    public function getData($keyword, $current_page = null, $limit = null, $columns = null)
    {
        if ($columns === null) {
            $columns = [
                'customers.id', 'customers.user_id', 'customers.check_code', 'customers.check_time', 'users.name', 'users.email', 'users.phone',
                'customers_address.address'
            ];
        }
        $query = Customer::leftJoin('users', 'users.id', '=', 'customers.user_id')
            ->join('customers_address', 'customers_address.customer_id', '=', 'customers.id')
            ->select('customers.id as customer_id', 'customers.user_id as user_id', 'customers.check_code as check_code', 'customers.check_time as check_time',
                'users.name as name', 'users.email as email', 'users.phone as phone',
                'customers_address.address as address');
        if ($keyword) {
            $query = $query->where(function ($q) use ($keyword) {
                $q->where('users.name', 'LIKE', "%$keyword%")
                    ->orWhere('users.email', 'LIKE', "%$keyword%")
                    ->orWhere('users.phone', 'LIKE', "%$keyword%");
            });
        }
        return $query->paginate($limit, $columns, 'page', $current_page);
    }

}
