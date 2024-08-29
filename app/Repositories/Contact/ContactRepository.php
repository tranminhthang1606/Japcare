<?php
namespace App\Repositories\Contact;

use App\Models\Contact;
use App\Repositories\BaseEloquentRepository;


class ContactRepository extends BaseEloquentRepository implements ContactRepositoryInterface
{

    /**
     * @return mixed
     */
    public function model()
    {
        return Contact::class;
    }


}
