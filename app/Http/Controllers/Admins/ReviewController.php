<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Role;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Review\ReviewRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    protected $reviewRepository;
    protected $productRepository;

    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->middleware(function($request,$next){
            $roleId = Auth::user()->role_id;
            $roleData = Role::findOrFail($roleId);
            if (in_array('10', json_decode($roleData->permissions))) {
                return $next($request);
            } else {
                return back()->with('error', 'Bạn không có quyền vào chức năng này');
            }
        });
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
    }

    public function index() {
        $data = $this->reviewRepository->all();
        return view('admins.reviews.index', compact('data'));
    }

    public function delete($id) {
        DB::beginTransaction();
        $review = $this->reviewRepository->findById($id);
        if ($review->delete()) {
            DB::commit();
            return redirect()->route('admin.reviews.index')->with('success', 'Xóa đánh giá thành công.');
        } else {
            return back()->with('error', 'Xóa đánh giá thất bại!');
        }
    }

    public function change_status(Request $request) {
        $review = $this->reviewRepository->findById($request->id);
        $review->status = $request->status;
        if($review->save()){
            return 1;
        }
        return 0;
    }

    public function update_rating_product($product_id) {
        $product = $this->productRepository->findById($product_id);
        if($total = $this->reviewRepository->countWhere(['product_id' => $product->id, 'status' => 1]) > 0){
            $product->rating = round((Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/$total), 1);
        }
        else {
            $product->rating = 0;
        }
        $product->save();
    }
}
