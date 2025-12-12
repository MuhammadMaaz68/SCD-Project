<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-dark fw-bold text-uppercase']) }}>
    {{ $slot }}
</button>
