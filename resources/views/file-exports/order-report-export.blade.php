<?php
// file-exports/order-report-export.blade.php
?>
<html>
<table>
    <thead>
    <tr>
        <th>{{translate('order_Report_List')}}</th>
    </tr>
    <tr>
        <th>{{ translate('filter_Criteria') .' '.'-'}}</th>
        <th></th>
        <th>
            {{translate('search_Bar_Content').' '.'-'.' '. ($data['search'] ?? 'N/A')}}
            <br>
            {{translate('store')}} - {{ucwords($data['vendor'] != 'all' && $data['vendor'] !='inhouse' ? $data['vendor']?->shop->name : ( $data['vendor'] ?? 'all' ))}}
            <br>
            {{translate('date_type').' '.'-'.' '.translate($data['dateType'])}}
            <br>
            @if($data['from'] && $data['to'])
                {{translate('from').' '.'-'.' '.date('d M, Y',strtotime($data['from']))}}
                <br>
                {{translate('to').' '.'-'.' '.date('d M, Y',strtotime($data['to']))}}
                <br>
            @endif
        </th>
    </tr>
    <tr>
        <td>{{translate('SL')}}</td>
        <td>{{translate('order_ID')}}</td>
        <td>{{translate('product_image')}}</td>
        <td>{{translate('item_details')}}</td>
        <td>{{translate('item_price')}}</td>
        <td>{{translate('item_discount')}}</td>
        <td>{{translate('brand')}}</td>
        <td>{{translate('total_Amount')}}</td>
        <td>{{translate('total_Pcs')}}</td>
        <td>{{translate('product_Discount')}}</td>
        <td>{{translate('coupon_Discount')}}</td>
        <td>{{translate('referral_Discount')}}</td>
        <td>{{translate('shipping_Charge')}}</td>
        <td>{{translate('shipping_Method')}}</td>
        <td>{{translate('commission')}}</td>
        <td>{{translate('deliveryman_incentive')}}</td>
        <td>{{translate('status')}}</td>
    </tr>
    @php($rowNumber = 0)
    @foreach ($data['orders'] as $order)
        @php($details = $order->details)
        @php($detailsCount = $details->count())
        @foreach ($details as $index => $detail)
            @php($productDetails = $detail?->productAllStatus ?? json_decode($detail->product_details))
            @if($productDetails)
                <tr>
                    @if($index == 0)
                        <td rowspan="{{$detailsCount}}">{{++$rowNumber}}</td>
                        <td rowspan="{{$detailsCount}}">{{$order['id']}}</td>
                    @endif
                    
                    <td></td>
                    
                    {{-- Item Details --}}
                    <td>
                        {{$productDetails->name ?? 'N/A'}}
                        @if($detail->variant)
                            <br>{{translate('variation')}}: {{$detail['variant']}}
                        @endif
                        <br>{{translate('qty')}}: {{$detail['qty']}}
                    </td>
                    
                    {{-- Item Price --}}
                    <td>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $detail['price'])) }}</td>
                    
                    {{-- Item Discount --}}
                    <td>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $detail['discount'])) }}</td>

                    <td> {{ $productDetails?->brand?->name ?? '-' }}</td>
                    
                    @if($index == 0)
                        <td rowspan="{{$detailsCount}}">{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->order_amount ?? 0)) }}</td>
                        <td rowspan="{{$detailsCount}}">{{ $order->details->sum('qty') }}</td>
                        <td rowspan="{{$detailsCount}}">{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->details_sum_discount ?? 0)) }}</td>
                        <td rowspan="{{$detailsCount}}">{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->discount_amount ?? 0)) }}</td>
                        <td rowspan="{{$detailsCount}}">{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->refer_and_earn_discount ?? 0)) }}</td>
                        <td rowspan="{{$detailsCount}}">{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->shipping_cost - ($order->extra_discount_type == 'free_shipping_over_order_amount' ? $order->extra_discount : 0))) }}</td>
                        <td rowspan="{{$detailsCount}}">{{ $order->shipping?->title }}</td>
                        <td rowspan="{{$detailsCount}}">{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->admin_commission ?? 0)) }}</td>
                        <td rowspan="{{$detailsCount}}">{{ ($order->delivery_type=='self_delivery' && $order->delivery_man_id) ? setCurrencySymbol(amount: usdToDefaultCurrency(amount:$order->deliveryman_charge ?? 0)) : setCurrencySymbol(amount: usdToDefaultCurrency(amount: 0)) }}</td>
                        <td rowspan="{{$detailsCount}}">{{translate($order['order_status'])}}</td>
                    @endif
                </tr>
            @endif
        @endforeach
    @endforeach
    </thead>
</table>
</html>