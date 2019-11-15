@foreach ($model as $item)
    <img src="{{ public_path($item->lampiran) }}" alt="" style="width: 600px; height: 900px;">
    @endforeach