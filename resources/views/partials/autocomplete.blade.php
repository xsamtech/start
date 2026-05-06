@if($items->count())
    <div class="list-group list-group-flush">
        @foreach($items as $item)
            <a href="{{ route('dashboard.category.entity.datas', ['entity' => $item->type, 'id' => $item->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <img src="{{ count($item->photos) > 0 ? $item->photos[0]->file_url : asset('assets/img/undefined.png') }}" alt="" width="50" height="50" style="object-fit: contain">
                    <p class="my-0 ms-2">{{ $item->product_name }}</p>
                </div>
                <small class="text-muted">{{ !empty($item->converted_price) ? formatDecimalNumber($item->converted_price) : '' }} {{ $item->user_currency }}</small>
            </a>
        @endforeach
    </div>
@else
    <div class="d-flex p-4 justify-content-center">
        <p class="my-0 text-muted">@lang('miscellaneous.empty_list')</p>
    </div>
@endif