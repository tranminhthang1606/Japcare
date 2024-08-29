<?php
namespace App\Repositories\Popup;
use App\Models\Popup;
use App\Repositories\BaseEloquentRepository;
class PopupRepository extends BaseEloquentRepository implements PopupRepositoryInterface
{
    public function model()
    {
        return Popup::class;
    }
}
