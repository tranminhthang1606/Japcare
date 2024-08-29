@extends('admins.layouts.master')
@section('title', 'Sắp xếp danh mục sản phẩm')
@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    @include('admins.categories.menus',['menus' => $menus])
                </div>
            </div>
        </div>
    </div>

@endsection
@section('bottom_script')
    <script type="text/javascript">
        $(document).ready( function (){
            $.fn.extend({
                treed: function (o) {
                    var openedClass = 'glyphicon-minus-sign';
                    var closedClass = 'glyphicon-plus-sign';

                    if (typeof o != 'undefined'){
                        if (typeof o.openedClass != 'undefined'){
                            openedClass = o.openedClass;
                        }
                        if (typeof o.closedClass != 'undefined'){
                            closedClass = o.closedClass;
                        }
                    }
                    /* initialize each of the top levels */
                    var tree = $(this);
                    tree.addClass("tree");
                    tree.find('li').has("ul").each(function () {
                        var branch = $(this);
                        branch.prepend("");
                        branch.addClass('branch');
                    });
                }
            });
            /* Initialization of treeviews */
            $('#tree1').treed();
            //
            $('#parent_id').change(function(){
                var selected = $(this).find('option:selected');
                var extra = selected.data('parent');
                if(extra !=0){
                    $('#show_menu').hide('slow');
                }else{
                    $('#show_menu').show('slow');
                }
            });
        });
        //sort order menus
        function updateSortOrder(category_id, parent_id, change) {
            $('.loading').show();
            $.ajax({
                url: '/admin/categories-update-sort-order',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    category_id,
                    parent_id,
                    change,
                },
                success: function (res) {
                    location.reload();
                },
                error: function (err) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.')
                    $('.loading').hide();
                    console.log(err)
                }
            })
        }
    </script>
@endsection
