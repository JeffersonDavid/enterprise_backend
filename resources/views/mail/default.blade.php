

@switch( (int) $mailNotification->transaction_type )

    @case(1)
            <x-orders-component :mail-notification="$mailNotification" />
    @break

    @case(2)
            <x-orders-component :mail-notification="$mailNotification" />
    @break

    @default
    @endphp
@endswitch