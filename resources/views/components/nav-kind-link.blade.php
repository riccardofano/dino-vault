@props(['user', 'kind'])

@php
    $href = '/users/' . $user->id . '/' . $kind;
@endphp

<a class="{{ last(request()->segments()) === $kind ? 'underline' : '' }}" href={{ $href }}>
    {{ $slot }}
</a>
