<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger fw-bold text-uppercase']) }}>
    {{ $slot }}
</button>
