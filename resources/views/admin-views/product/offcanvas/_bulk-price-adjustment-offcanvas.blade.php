<form action="{{ route('admin.products.bulk-price-update') }}" method="POST" id="bulkPriceUpdateForm">
    @csrf
    <input type="hidden" value="{{ request('request_status') }}" name="request_status">
    <input type="hidden" value="{{ request('status') }}" name="status">
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="bulkPriceAdjustmentOffcanvas" aria-labelledby="bulkPriceAdjustmentLabel" style="--bs-offcanvas-width: 500px;">
        <div class="offcanvas-header bg-body">
            <h3 class="mb-0">{{ translate('Bulk_Price_Adjustment') }}</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column gap-20">
                
                {{-- Filter Section --}}
                <div class="p-12 p-sm-20 bg-section rounded">
                    <h5 class="mb-3">{{ translate('filter_Products') }}</h5>
                    <div class="row g-3">
                        <!--@if (request('type') == 'seller')-->
                        <!--    <div class="col-12">-->
                        <!--        <div class="form-group">-->
                        <!--            <label class="form-label" for="store">{{ translate('store') }}</label>-->
                        <!--            <select name="seller_id" class="custom-select" data-placeholder="Select from dropdown">-->
                        <!--                <option></option>-->
                        <!--                <option value="" selected>{{ translate('all_store') }}</option>-->
                        <!--                @foreach ($sellers as $seller)-->
                        <!--                    <option value="{{ $seller->id }}"{{ request('seller_id') == $seller->id ? 'selected' : '' }}>-->
                        <!--                        {{ $seller->shop->name }}-->
                        <!--                    </option>-->
                        <!--                @endforeach-->
                        <!--            </select>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--@endif-->
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="store">{{ translate('brand') }}</label>
                                <select name="brand_id" class="custom-select" data-placeholder="Select from dropdown">
                                    <option></option>
                                    <option value="" selected>{{ translate('all_brand') }}</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->default_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">{{ translate('category') }}</label>
                                <select class="custom-select action-get-request-onchange"
                                    data-placeholder="Select from dropdown" name="category_id"
                                    data-url-prefix="{{ url('/admin/products/get-categories?parent_id=') }}"
                                    data-element-id="bulk-sub-category-select" data-element-type="select">
                                    <option value="{{ old('category_id') }}" selected disabled>
                                        {{ translate('select_category') }}
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}" {{ request('category_id') == $category['id'] ? 'selected' : '' }}>
                                            {{ $category['defaultName'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">{{ translate('sub_Category') }}</label>
                                <select class="custom-select action-get-request-onchange"
                                    data-placeholder="Select from dropdown" name="sub_category_id" id="bulk-sub-category-select"
                                    data-url-prefix="{{ url('/admin/products/get-categories?parent_id=') }}"
                                    data-element-id="bulk-sub-sub-category-select" data-element-type="select">
                                    <option disabled {{ request('sub_category_id') ? '' : 'selected' }}>
                                        {{ translate('select_Sub_Category') }}
                                    </option>
                                    @foreach ($subCategories as $subCategoryItem)
                                        <option value="{{ $subCategoryItem['id'] }}" {{ request('sub_category_id') == $subCategoryItem['id'] ? 'selected' : '' }}>
                                            {{ $subCategoryItem['defaultName'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name" class="form-label">{{ translate('sub_Sub_Category') }}</label>
                                <select class="custom-select" data-placeholder="Select from dropdown"
                                    name="sub_sub_category_id" id="bulk-sub-sub-category-select">
                                    <option value="{{ request('sub_sub_category_id') != null ? request('sub_sub_category_id') : null }}"
                                        selected {{ request('sub_sub_category_id') != null ? '' : 'disabled' }}>
                                        {{ request('sub_sub_category_id') != null ? $subSubCategory['defaultName'] : translate('select_Sub_Sub_Category') }}
                                    </option>
                                    @foreach ($subSubCategories as $subSubCategoryItem)
                                        <option value="{{ $subSubCategoryItem['id'] }}" {{ request('sub_sub_category_id') == $subSubCategoryItem['id'] ? 'selected' : '' }}>
                                            {{ $subSubCategoryItem['defaultName'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Price Adjustment Section --}}
                <div class="p-12 p-sm-20 bg-section rounded">
                    <h5 class="mb-3">{{ translate('Price_Adjustment') }}</h5>
                    <div class="form-group mb-20">
                        <label class="form-label" for="percentage">
                            {{ translate('Percentage') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                               id="percentage"
                               name="percentage"
                               class="form-control"
                               step="1"
                               min="1"
                               placeholder="{{ translate('Enter_percentage_value') }}"
                               required>
                    </div>

                    <div class="form-group mb-0">
                        <label class="form-label">{{ translate('Adjustment_Type') }}</label>
                        <div class="d-flex gap-3 mt-2">
                            <label class="d-flex align-items-center gap-2">
                                <input type="radio" name="adjustment_type" value="increase" checked>
                                <span>{{ translate('Increase') }}</span>
                            </label>
                            <label class="d-flex align-items-center gap-2">
                                <input type="radio" name="adjustment_type" value="decrease">
                                <span>{{ translate('Decrease') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer shadow-popup">
            <div class="d-flex justify-content-center flex-wrap gap-3 bg-white px-3 py-2">
                <button type="button" class="btn btn-secondary flex-grow-1" data-bs-dismiss="offcanvas">
                    {{ translate('cancel') }}
                </button>
                <button type="submit" class="btn btn-primary flex-grow-1">
                    {{ translate('Apply') }}
                </button>
            </div>
        </div>
    </div>
</form>