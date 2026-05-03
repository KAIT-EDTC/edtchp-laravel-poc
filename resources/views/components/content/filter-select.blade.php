@props([
    'label',
    'name',
    'route',
    'options' => [],
    'selected' => null,
    'preserve' => [],
    'allLabel' => 'すべて',
])

@php
    $toString = static fn ($value) => is_scalar($value) ? (string) $value : '';

    $buildUrl = static function (?string $value) use ($route, $name, $preserve): string {
        $params = array_filter(
            array_merge($preserve, [$name => $value]),
            static fn ($item): bool => $item !== null && $item !== ''
        );

        return route($route, $params);
    };

    $selectedValue = $selected !== null ? $toString($selected) : null;
@endphp

<div class="flex items-center gap-2">
    <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
    <select onchange="location.href=this.value" class="border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-main">
        <option value="{{ $buildUrl(null) }}" @selected($selectedValue === null || $selectedValue === '')>{{ $allLabel }}</option>
        @foreach ($options as $option)
            @php
                $optionValue = $toString($option);
            @endphp
            <option value="{{ $buildUrl($optionValue) }}" @selected($selectedValue === $optionValue)>{{ $optionValue }}</option>
        @endforeach
    </select>
</div>
