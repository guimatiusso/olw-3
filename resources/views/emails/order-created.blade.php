<x-mail::message>

    # Order created

    The order {{ $order->id }} was created.

    Total: @money($order->total)

    Thank you for shopping with us!

</x-mail::message>
