@php
  $badgeColors = [
    'studio' => 'bg-danger-subtle text-danger-emphasis',
    'field' => 'bg-success-subtle text-success-emphasis',
    'co-working' => 'bg-primary-subtle text-primary-emphasis',
    'meeting_room' => 'bg-info-subtle text-info-emphasis',
    'etc' => 'bg-secondary-subtle text-light-emphasis',
  ];

  $category = $category ?? 'etc';
  $badgeClass = $badgeColors[$category] ?? $badgeColors['etc'];
@endphp

<span class="badge {{ $badgeClass }}">{{ $category }}</span>
