@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('rapidhire.png') }}" style="width: 100%; height: auto;" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
