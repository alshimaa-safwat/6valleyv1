@extends('layouts.admin.app')

@section('title', translate('product_Bulk_Import'))

@section('content')
    <div class="content container-fluid">

        <div class="mb-4">
            <h1 class="mb-1 text-capitalize d-flex gap-2">
                <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/bulk-import.png') }}" alt="">
                {{ translate('bulk_Import') }}
            </h1>
        </div>

        <div class="row gy-2">
            <div class="col-12">
                <div class="card card-body">
                    <h2 class="mb-3">{{ translate('instructions') }} : </h2>
                    <p>{{ translate('1') }}. {{ translate('download_the_format_file_and_fill_it_with_proper_data.') }}</p>

                    <p>{{ translate('2') }}.
                        {{ translate('you_can_download_the_example_file_to_understand_how_the_data_must_be_filled.') }}</p>

                    <p>{{ translate('3') }}. {{ translate('once_you_have_downloaded_and_filled_the_format_file') }},
                        {{ translate('upload_it_in_the_form_below_and_submit.') }}</p>

                    <p>4.
                        {{ translate('after_uploading_products_you_need_to_edit_them_and_set_product_images_and_choices.') }}
                    </p>

                    <p>5. {{ translate('you_can_get_brand_and_category_id_from_their_list_please_input_the_right_ids.') }}
                    </p>

                    <p>6.
                        {{ translate('you_can_upload_your_product_images_in_product_folder_from_gallery_and_copy_image_path.') }}
                    </p>

                    <hr class="my-4">

                    <h3 class="mb-3">{{ translate('Required Columns') }}:</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ translate('Column Name') }}</th>
                                    <th>{{ translate('Type') }}</th>
                                    <th>{{ translate('Required') }}</th>
                                    <th>{{ translate('Description') }}</th>
                                    <th>{{ translate('Example') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>name_en</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>Product name in English</td>
                                    <td>Smart Phone X</td>
                                </tr>
                                <tr>
                                    <td><strong>name_ar</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Product name in Arabic</td>
                                    <td>الهاتف الذكي X</td>
                                </tr>
                                <tr>
                                    <td><strong>description_en</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Product description in English</td>
                                    <td>High quality smartphone</td>
                                </tr>
                                <tr>
                                    <td><strong>description_ar</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Product description in Arabic</td>
                                    <td>هاتف ذكي عالي الجودة</td>
                                </tr>
                                <tr>
                                    <td><strong>category_id</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>Main category ID</td>
                                    <td>15</td>
                                </tr>
                                <tr class="table-info">
                                    <td><strong>colors</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Color codes separated by comma (see color list below)</td>
                                    <td>#FF0000,#00FF00,#0000FF</td>
                                </tr>
                                <tr class="table-info">
                                    <td><strong>shapes</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Shape IDs separated by comma (see shape list below)</td>
                                    <td>1,2,3</td>
                                </tr>
                                <tr class="table-info">
                                    <td><strong>attributes</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Attribute IDs separated by comma (see attribute list below)</td>
                                    <td>1,2</td>
                                </tr>
                                <tr class="table-info">
                                    <td><strong>attribute_{name}</strong> or<br><strong>attribute_{id}_values</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Values for each attribute (by name or ID), separated by comma. Use attribute name (e.g., KG) or ID (e.g., 1)</td>
                                    <td>attribute_KG: 1kg,2kg,3kg<br>OR<br>attribute_1_values: Small,Medium,Large</td>
                                </tr>
                                <tr>
                                    <td><strong>sub_category_id</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Sub category ID</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td><strong>sub_sub_category_id</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Sub sub category ID</td>
                                    <td>35</td>
                                </tr>
                                <tr>
                                    <td><strong>brand_id</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Brand ID</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td><strong>unit</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>Product unit (pc, kg, liter, etc)</td>
                                    <td>pc</td>
                                </tr>
                                <tr>
                                    <td><strong>weight</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Product weight in kg</td>
                                    <td>0.5</td>
                                </tr>
                                <tr>
                                    <td><strong>product_type</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>physical or digital</td>
                                    <td>physical</td>
                                </tr>
                                <tr>
                                    <td><strong>digital_product_type</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>ready_after_sell or ready_product</td>
                                    <td>ready_product</td>
                                </tr>
                                <tr>
                                    <td><strong>unit_price</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>Product price</td>
                                    <td>99.99</td>
                                </tr>
                                <tr>
                                    <td><strong>purchase_price</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Purchase price</td>
                                    <td>50.00</td>
                                </tr>
                                <tr>
                                    <td><strong>tax_ids</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>Tax IDs separated by comma</td>
                                    <td>1,2,3</td>
                                </tr>
                                <tr>
                                    <td><strong>discount</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>Discount amount or percentage</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td><strong>discount_type</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>flat or percent</td>
                                    <td>percent</td>
                                </tr>
                                <tr>
                                    <td><strong>current_stock</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>Available stock quantity</td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td><strong>minimum_order_qty</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>Minimum order quantity</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td><strong>shipping_cost</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Shipping cost amount</td>
                                    <td>5.00</td>
                                </tr>
                                <tr>
                                    <td><strong>multiply_qty</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>0 or 1 (multiply quantity in pricing)</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><strong>status</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>0 (inactive) or 1 (active)</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td><strong>refundable</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-danger">Yes</span></td>
                                    <td>0 (not refundable) or 1 (refundable)</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td><strong>featured</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>0 (not featured) or 1 (featured)</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><strong>free_shipping</strong></td>
                                    <td>Number</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>0 (not free) or 1 (free shipping)</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><strong>youtube_video_url</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>YouTube video URL</td>
                                    <td>https://youtube.com/watch?v=xxx</td>
                                </tr>
                                <tr>
                                    <td><strong>thumbnail</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>Thumbnail image path</td>
                                    <td>product/image.jpg</td>
                                </tr>
                                <tr>
                                    <td><strong>meta_title_en</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>SEO meta title in English</td>
                                    <td>Buy Smart Phone X Online</td>
                                </tr>
                                <tr>
                                    <td><strong>meta_title_ar</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>SEO meta title in Arabic</td>
                                    <td>اشتري الهاتف الذكي X</td>
                                </tr>
                                <tr>
                                    <td><strong>meta_description_en</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>SEO meta description in English</td>
                                    <td>Best smartphone with great features</td>
                                </tr>
                                <tr>
                                    <td><strong>meta_description_ar</strong></td>
                                    <td>Text</td>
                                    <td><span class="badge bg-warning">No</span></td>
                                    <td>SEO meta description in Arabic</td>
                                    <td>أفضل هاتف ذكي بمميزات رائعة</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="alert alert-info mt-3">
                        <strong>{{ translate('Note') }}:</strong>
                        <ul class="mb-0 mt-2">
                            <li><strong>🌍 Auto-Discovery Feature:</strong> The system automatically detects translation
                                columns!</li>
                            <li>Add any language by following the pattern: <code>name_{locale}</code>,
                                <code>description_{locale}</code></li>
                            <li>Examples: <code>name_ar</code>, <code>name_iq</code>, <code>name_fr</code>,
                                <code>description_ar</code>, <code>description_iq</code></li>
                            <li>Supported translation fields: <strong>name</strong>, <strong>description</strong>,
                                <strong>meta_title</strong>, <strong>meta_description</strong></li>
                            <li>Locale codes: Use 2-3 letter codes (ar=Arabic, iq=Iraq, fr=French, es=Spanish, de=German,
                                etc.)</li>
                            <li>Category IDs, Brand IDs can be found in their respective list pages</li>
                            <li>Tax IDs should be separated by commas (e.g., 1,2,3)</li>
                            <li>For attributes, use the attribute name (e.g., "KG") in the "attributes" column and <code>attribute_KG</code> column for values, or use attribute IDs with <code>attribute_1_values</code> pattern</li>
                            <li>After upload, you need to manually set product images for each color/shape from the product edit page</li>
                        </ul>
                    </div>

                    <div class="alert alert-success mt-3">
                        <strong>{{ translate('Example Translation Columns') }}:</strong>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <ul class="mb-0">
                                    <li><code>name_en</code> - English name (Required)</li>
                                    <li><code>name_ar</code> - Arabic name</li>
                                    <li><code>name_iq</code> - Iraqi Arabic name</li>
                                    <li><code>name_fr</code> - French name</li>
                                    <li><code>name_de</code> - German name</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="mb-0">
                                    <li><code>description_en</code> - English description</li>
                                    <li><code>description_ar</code> - Arabic description</li>
                                    <li><code>description_iq</code> - Iraqi description</li>
                                    <li><code>meta_title_en</code> - English SEO title</li>
                                    <li><code>meta_description_ar</code> - Arabic SEO description</li>
                                </ul>
                            </div>
                        </div>
                        <p class="mt-2 mb-0"><em>You can add columns for any language you need - the system will
                                automatically detect and process them!</em></p>
                    </div>

                    <hr class="my-4">

                    {{-- Colors Reference Table --}}
                    <h3 class="mb-3"><i class="tio-color-bucket text-primary"></i> {{ translate('Available Colors') }}</h3>
                    <div class="alert alert-light border">
                        <p class="mb-2"><strong>{{ translate('How to use') }}:</strong> {{ translate('Add the color codes separated by comma in the "colors" column') }}</p>
                        <p class="mb-0"><strong>{{ translate('Example') }}:</strong> <code>#FF0000,#00FF00,#0000FF</code></p>
                    </div>
                    <div class="table-responsive mb-4" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-bordered table-sm table-hover">
                            <thead class="table-light position-sticky top-0">
                                <tr>
                                    <th>{{ translate('Color Preview') }}</th>
                                    <th>{{ translate('Color Name') }}</th>
                                    <th>{{ translate('Color Code') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($colors as $color)
                                <tr>
                                    <td class="text-center">
                                        <span style="display: inline-block; width: 30px; height: 30px; background-color: {{ $color->code }}; border-radius: 4px; border: 1px solid #ddd;"></span>
                                    </td>
                                    <td>{{ $color->name }}</td>
                                    <td><code>{{ $color->code }}</code></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">{{ translate('No colors available') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Shapes Reference Table --}}
                    <h3 class="mb-3"><i class="tio-shapes text-success"></i> {{ translate('Available Shapes') }}</h3>
                    <div class="alert alert-light border">
                        <p class="mb-2"><strong>{{ translate('How to use') }}:</strong> {{ translate('Add the shape IDs separated by comma in the "shapes" column') }}</p>
                        <p class="mb-0"><strong>{{ translate('Example') }}:</strong> <code>1,2,3</code></p>
                    </div>
                    <div class="table-responsive mb-4" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-bordered table-sm table-hover">
                            <thead class="table-light position-sticky top-0">
                                <tr>
                                    <th>{{ translate('Shape ID') }}</th>
                                    <th>{{ translate('Shape Name') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($shapes as $shape)
                                <tr>
                                    <td><code>{{ $shape->id }}</code></td>
                                    <td>{{ $shape->name }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">{{ translate('No shapes available') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Attributes Reference Table --}}
                    <h3 class="mb-3"><i class="tio-category text-info"></i> {{ translate('Available Attributes') }}</h3>
                    <div class="alert alert-light border">
                        <p class="mb-2"><strong>{{ translate('How to use') }}:</strong></p>
                        <ol class="mb-0">
                            <li>{{ translate('Add the attribute IDs or Names in the "attributes" column') }}: <code>KG,Size</code> or <code>1,2</code></li>
                            <li>{{ translate('For each attribute, add a column with values using either pattern') }}:</li>
                            <ul class="mt-1 mb-0">
                                <li><strong>{{ translate('By Name') }}:</strong> <code>attribute_KG</code> = <code>1kg,2kg,3kg</code></li>
                                <li><strong>{{ translate('By ID') }}:</strong> <code>attribute_1_values</code> = <code>Small,Medium,Large</code></li>
                            </ul>
                            <li>{{ translate('Both patterns work') }}: <code>attribute_{name}</code>, <code>attribute_{name}_values</code>, <code>attribute_{id}</code>, or <code>attribute_{id}_values</code></li>
                        </ol>
                    </div>
                    <div class="table-responsive mb-4" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-bordered table-sm table-hover">
                            <thead class="table-light position-sticky top-0">
                                <tr>
                                    <th>{{ translate('Attribute ID') }}</th>
                                    <th>{{ translate('Attribute Name') }}</th>
                                    <th>{{ translate('Column Names (Any pattern works)') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attributes as $attribute)
                                @php
                                    $nameSlug = str_replace(' ', '_', $attribute->name);
                                @endphp
                                <tr>
                                    <td><code>{{ $attribute->id }}</code></td>
                                    <td>{{ $attribute->name }}</td>
                                    <td>
                                        <code>attribute_{{ $attribute->id }}</code> or<br>
                                        <code>attribute_{{ $attribute->id }}_values</code> or<br>
                                        <code>attribute_{{ $nameSlug }}</code> or<br>
                                        <code>attribute_{{ $nameSlug }}_values</code>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">{{ translate('No attributes available') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="alert alert-warning">
                        <strong><i class="tio-warning"></i> {{ translate('Important Notes for Variations') }}:</strong>
                        <ul class="mb-0 mt-2">
                            <li>{{ translate('When colors, shapes, or attributes are added, the system will automatically generate variant combinations') }}</li>
                            <li>{{ translate('Each variant will have the same price as unit_price and same stock as current_stock / number of variants') }}</li>
                            <li>{{ translate('You can edit individual variant prices and stock after import from the product edit page') }}</li>
                            <li>{{ translate('Product images for each color/shape need to be added manually after import') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <form class="product-form" action="{{ route('admin.products.bulk-import') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card rest-part">
                        <div class="px-3 py-4 d-flex flex-wrap align-items-center gap-10 justify-content-center">
                            <h3 class="mb-0">{{ translate('do_not_have_the_template') }} ?</h3>
                            <a href="{{ dynamicAsset(path: 'public/assets/product_bulk_format.xlsx') }}" download=""
                                class="fs-16 fw-medium">{{ translate('download_here') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-auto">

                                        <div class="uploadDnD">
                                            <div class="form-group inputDnD input_image input_image_edit"
                                                data-title="{{ translate('drag_&_drop_file_or_browse_file') }}">
                                                <input type="file" name="products_file" accept=".xlsx, .xls"
                                                    class="form-control-file text--primary font-weight-bold action-upload-section-dot-area"
                                                    id="inputFile">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-10 align-items-center justify-content-end">
                                <button type="reset"
                                    class="btn btn-secondary px-4 action-onclick-reload-page">{{ translate('reset') }}</button>
                                <button type="submit" class="btn btn-primary px-4">{{ translate('submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
