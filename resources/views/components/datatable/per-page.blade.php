@props(['value' => 100])
<select class="form-control form-control-sm per-page">
    <option value="100" @if($value == 100) {{ 'selected' }} @endif>100</option>
    <option value="250" @if($value == 250) {{ 'selected' }} @endif>250</option>
    <option value="500" @if($value == 500) {{ 'selected' }} @endif>500</option>
    <option value="1000 @if($value == 1000) {{ 'selected' }} @endif">1000</option>
    <option value="2000 @if($value == 2000) {{ 'selected' }} @endif">2000</option>
    <option value="3000 @if($value == 3000) {{ 'selected' }} @endif">3000</option>
    <option value="4000 @if($value == 4000) {{ 'selected' }} @endif">4000</option>
    <option value="5000 @if($value == 5000) {{ 'selected' }} @endif">5000</option>
    <option value="10000" @if($value == 10000) {{ 'selected' }} @endif>10000</option>
</select>