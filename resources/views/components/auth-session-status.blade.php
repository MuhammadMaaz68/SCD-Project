<!-- {{-- 
    Component: Auth Session Status
    Description: Displays session status messages (e.g. "Password Reset Link Sent").
--}} -->
@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif
