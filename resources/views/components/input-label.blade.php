<!-- {{--
    Component: Input Label
    Description: Label for form inputs.
--}} -->
@props(['value'])
<label {{ $attributes->merge(['class' => 'd-block fw-bold text-dark mb-1']) }}>
    {{ $value ?? $slot }}
</label>
