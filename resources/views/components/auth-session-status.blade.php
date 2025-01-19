@props(['status'])

@if ($status)
<<<<<<< HEAD
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
=======
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
>>>>>>> 0f06df6092cc400c5d2802eef646eb992ac1a523
        {{ $status }}
    </div>
@endif
