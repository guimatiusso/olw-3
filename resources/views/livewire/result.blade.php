<div class="bg-tertiary-900 min-h-screen w-full flex flex-col items-center justify-center" >
    <div class="flex flex-col rounded-md border border-primary-200 px-20 py-16">
        <h1 class="text-white text-lg font-bold">Thank you for shopping with us</h1>
        <h2 class="text-white">Order successfully created</h2>

        <div class="flex flex-col divide-y divide-primary-200 divide-opacity-10 mt-4 space-y-2">
            <div class="text-white flex flex-row items-center justify-between pt-2">
                <span>Order Number</span>
                <h3>{{ $order_id }}</h3>
            </div>

            <div class="text-white flex flex-row items-center justify-between pt-2">
                <span>Order status</span>
                <h3 class="{{ $order->status->getStyles() }}">{{ $order->status->getName() }}</h3>
            </div>

            <div class="text-white flex flex-row items-center justify-between pt-2">
                <span>Payment Method</span>
                <h3>{{ $order->payments->last()->method->getName() }}</h3>
            </div>

            <div class="text-white flex flex-row items-center justify-between pt-2">
                <span>Payment Status</span>
                <h3 class="{{ $order->payments->last()->status->getStyles() }}">{{ $order->payments->last()->status->getName() }}</h3>
            </div>
        </div>

        @if ($order->payments->last()->method == PaymentMethodEnum::PIX)
            <div class="col-span-4 sm:col-span-8 flex flex-col items-center justify-end gap-y-8 mt-8">
                <img src="data:image/jpeg;base64,{{ $order->payments->last()->qr_code_64 }}" class="w-[200px]">

                <x-primary-button
                    x-clipboard="'{{ $order->payments->last()->qr_code }}'"
                >Copy QR Code</x-primary-button>
            </div>
        @endif

        @if ($order->payments->last()->method == PaymentMethodEnum::BANK_SLIP)
            <div class="col-span-4 sm:col-span-8 flex flex-col items-center justify-end gap-y-8 mt-8">

                <x-primary-button
                    @click="window.open('{{ $order->payments->last()->ticket_url }}', '_blank')"
                >Download bank slip</x-primary-button>
            </div>
        @endif
    </div>
</div>
