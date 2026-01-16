<div class="product-type-physical-section search-product-attribute-container">
    <h6 class="font-semibold fs-13 mb-2">{{ translate('vendors') }}</h6>
    <div class="pb-2">
        <div class="input-group-overlay input-group-sm">
            <input placeholder="{{ translate('search_by_vendors') }}"
                class="__inline-38 cz-filter-search form-control form-control-sm appended-form-control search-product-attribute"
                type="text">
            <div class="input-group-append-overlay">
                <span class="input-group-text">
                    <i class="czi-search"></i>
                </span>
            </div>
        </div>
    </div>
    <ul class="__brands-cate-wrap attribute-list" data-simplebar data-simplebar-auto-hide="false">
        <div class="no-data-found text-muted" style="display:none;">{{ translate('No_Data_Found') }}</div>
        @foreach ($productVendors as $vendor)
            <?php
            if (isset($dataFrom) && $dataFrom == 'shop-view' && isset($shopSlug)) {
                $vendorRoute = route('shopView', ['slug' => $shopSlug, 'shop_id' => $vendor['id'], 'data_from' => 'shop', 'offer_type' => $data['offer_type'] ?? '', 'page' => 1]);
            } elseif (isset($dataFrom) && $dataFrom == 'flash-deals') {
                $vendorRoute = route('flash-deals', ['id' => $web_config['flash_deals']['id'] ?? 0, 'shop_id' => $vendor['id'], 'data_from' => 'shop', 'offer_type' => $data['offer_type'] ?? '', 'page' => 1]);
            } else {
                $vendorRoute = route('products', ['shop_id' => $vendor['id'], 'data_from' => 'shop', 'offer_type' => $data['offer_type'] ?? '', 'page' => 1]);
            }
            ?>
            <ul class="brand mt-2 p-0 for-brand-hover {{ session('direction') === 'rtl' ? 'mr-2' : '' }}"
                id="vendor">
                <li class="flex-between get-view-by-onclick cursor-pointer {{ request('shop_id') == $vendor['id'] ? 'text-primary' : '' }}"
                    data-link="{{ $vendorRoute }}">
                    <div class="text-start">
                        {{ $vendor['name'] }}
                    </div>
                    <div class="__brands-cate-badge">
                        <span>
                            {{ $vendor['vendor_products_count'] }}
                        </span>
                    </div>
                </li>
            </ul>
        @endforeach
    </ul>
</div>
