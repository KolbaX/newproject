<div class="search__results-b">
    <div>
        <p>@if(isset($tags))<b>{{ $productsCount }} Result(s) found for</b><strong> '@foreach($tags as $tag) {{ $tag->title }} @if(count($tags) > 0),@endif @endforeach'</strong>@endif</p>
    </div>
    <div class="search__results-bb">
        {{ $products->links('vendor.pagination.default') }}
    </div>
</div>
<div class="search__results-items">
    @foreach($products as $product)
        @include('site.product.card', ['product' => $product, 'class' => 'shop-item_w'])
    @endforeach
</div>
<div class="search__results-b srb-i">
    <div class="search__results-bb">
        {{ $products->links('vendor.pagination.default') }}
    </div>
</div>
