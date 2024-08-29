<div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
    @foreach($products as $prd)
        @include('frontend.products.item', $prd)
    @endforeach
</div>
@include('frontend.inc.pagination_ajax', $paginationPage)
