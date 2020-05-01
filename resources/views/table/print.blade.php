<style>
    p {
        display: inline;
    }
</style>
<div class="row">
    @foreach ($data as $value)
    {!! QrCode::size($size)->generate($value->qrId); !!}
    <p>{{ auth()->user()->business->prefixes['table'] ?? '' }}{{ $value->name }}</p>
    @endforeach
</div>
<script>
    window.print();
</script>