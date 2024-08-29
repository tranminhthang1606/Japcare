@extends('admins.layouts.master')
@section('title', 'Danh sách đánh giá')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Danh sách đánh giá sản phẩm
                    </h4>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif
                    <table id="admintable" class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="30px">ID</th>
                            <th width="100px">Sản phẩm</th>
                            <th width="100px">Hình ảnh</th>
                            <th>Khách hàng</th>
                            <th width="80px">Đánh giá</th>
                            <th>Nhận xét sản phẩm</th>
                            <th width="80px">Trạng thái</th>
                            <th width="80px">Thời gian</th>
                            <th width="60px">{{__('Options')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data) == 0)
                            <tr>
                                <td colspan="9" class="dataTables_empty">No data</td>
                            </tr>
                        @endif
                        @foreach($data as $key => $review)
                            <tr>
                                <td>{{$review->id}}</td>
                                <td>
                                    <a href="/admin/products/{{$review->product->id}}/edit">{{$review->product->title}}</a>
                                </td>
                                <td>
                                    <a href="/admin/products/{{$review->product->id}}/edit">
                                        <img src="{{asset($review->product->featured_img)}}" alt="product image" height="60px" />
                                    </a>
                                </td>
                                <td>
                                    <p>Tên: {{$review->name}}</p>
                                    @if($review->email != null)
                                        <p>{{$review->email}}</p>
                                    @endif
                                    @if($review->phone != null)
                                        <p>{{$review->phone}}</p>
                                    @endif
                                </td>
                                <td>{{$review->rating}}</td>
                                <td>
                                    @if(strlen($review->comment) > 80)
                                        {{substr($review->comment, 0, 76)}} ...
                                    @else
                                        {{$review->comment}}
                                    @endif
                                </td>
                                <td>
                                    <label class="switch">
                                        <input onchange="change_status(this)" value="{{ $review->id }}" type="checkbox" @if($review->status == 1) checked @endif >
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>{{ $review->created_at }}</td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#reviewModal{{$review->id}}">
                                        <span class="badge badge-primary detail_review"><i class="fa fa-eye"></i></span>
                                    </a>
                                    <a onclick="confirm_modal('{{route('admin.reviews.delete', $review->id)}}');">
                                        <span class="badge badge-danger delete_item"><i class="dripicons-cross"></i></span>
                                    </a>
                                </td>
                            </tr>

                            <div class="modal fade" id="reviewModal{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Nhận xét của {{$review->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{$review->comment}}
                                            @if($review->images)
                                                <div class="row" style="margin-top: 15px">
                                                    @foreach(json_decode($review->images) as $image)
                                                        <div class="col-4">
                                                            <img src="{{asset($image)}}" alt="" style="max-width: 100%"/>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#admintable').DataTable({
                "order": [[ 5, "desc" ]]
            });
        });

        function change_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.reviews.change_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('Thay đổi trạng thái đánh giá sản phẩm thành công.');
                }
                else{
                    alert('Đã xảy ra lỗi. Vui lòng thử lại');
                }
            });
        }
    </script>
@endsection
