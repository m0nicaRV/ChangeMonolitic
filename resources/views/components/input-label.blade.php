@props(['value'])

<<<<<<< HEAD
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
=======
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
>>>>>>> 0f06df6092cc400c5d2802eef646eb992ac1a523
    {{ $value ?? $slot }}
</label>
