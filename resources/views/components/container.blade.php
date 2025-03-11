

@props(['width'=> '7xl'])


<?php
    
    $maxWidth = match ($width) {
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        '6xl' => 'sm:max-w-6xl',
        '7xl' => 'sm:max-w-7xl',
        default => 'sm:max-w-7xl',
    };
?>

<div {{$attributes->merge(['class' => $maxWidth . ' mx-auto px-4 sm:px-6 lg:px-8'])}}>

    {{ $slot }}

</div>    