<form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="modal-title flex-grow-1 text-center" id="buyNowModalLabel">
            {{ translate('Shipping_Method') }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    {{-- Display selected product options --}}
    @if (isset($productData['color']) || isset($productData['shape']))
        <div class="d-flex flex-wrap gap-3 mb-3 pb-3 border-bottom">
            @if (isset($productData['color']) && $productData['color'])
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted">{{ translate('color') }}:</span>
                    <span class="d-inline-block rounded-circle border"
                        style="width: 20px; height: 20px; background: {{ $productData['color'] }};"></span>
                </div>
            @endif
            @if (isset($productData['shape']) && $productData['shape'])
                @php
                    $selectedShape = \App\Models\Shape::find($productData['shape']);
                @endphp
                @if ($selectedShape)
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted">{{ translate('shape') }}:</span>
                        <span class="badge badge-soft-primary">{{ $selectedShape->name }}</span>
                    </div>
                @endif
            @endif
        </div>
    @endif

    <div class="d-flex gap-2 mb-3">
        <img src="{{ theme_asset(path: 'public/assets/front-end/img/icons/car.svg') }}" alt="">
        <div>{{ translate('Choose_Shipping_Method') }}</div>
    </div>

    <div class="form-group">
        <div class="border rounded p-3 d-flex flex-column gap-2">
            @foreach ($shipping_method_list as $shippingMethodKey => $shippingMethod)
                <div class="d-flex gap-2 align-items-center">
                    <input type="radio" class="show" name="shipping_method_id"
                        id="shipping_method_id-{{ $shippingMethod['id'] }}" value="{{ $shippingMethod['id'] }}"
                        {{ $shippingMethodKey == 0 ? 'checked' : '' }}>
                    <label class="mb-0" for="shipping_method_id-{{ $shippingMethod['id'] }}">
                        {{-- {{ ucfirst($shippingMethod['title']) }} ({{ $shippingMethod['duration'] }}) {{ webCurrencyConverter($shippingMethod['cost']) }} --}}
                        {{ ucfirst($shippingMethod['title']) }} ({{ $shippingMethod['duration'] }})
                    </label>
                </div>
            @endforeach

            <input type="hidden" class="form-control" value="1" name="shipping_method_exist">

        </div>
    </div>

    <div class="row d-none">
        @foreach ($productData as $inputKey => $productInputData)
            <div class="col-6">
                <label>
                    {{ $inputKey }}
                </label>
                <input type="text" class="form-control" value="{{ $productInputData }}" name="{{ $inputKey }}">
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn text-white web--bg-primary">
            {{ translate('Proceed_to_Checkout') }}
        </button>
    </div>
</form>
