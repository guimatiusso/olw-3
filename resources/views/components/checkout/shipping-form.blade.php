<div>
    <x-section-title title="Contact Information" />

    <div class="flex flex-col rounded-md border border-primary-200 p-4 divide-y divide-primary-200 divide-opacity-10">
        <div class="flex flex-row items-center py-2 gap-x-4">
            <span class="text-sm text-white whitespace-nowrap">Contact: </span>
            <span class="text-sm text-white">{{ $user->email }}</span>
        </div>

        <div class="flex flex-row items-center py-2 gap-x-4">
            <span class="text-sm text-white whitespace-nowrap">Send to: </span>
            <span class="text-sm text-white">
                {{ $address->zipcode }}
                {{ $address->address }}
                {{ $address->number }}
                {{ $address->district }}
                {{ $address->complement }}
                {{ $address->city }}
                {{ $address->state }}
            </span>
        </div>
    </div>

    <div class="mt-10">
        <x-section-title title="Delivery Address" />

        <div class="mt-4 w-full flex flex-col rounded-md border border-primary-200 p-4 divide-y divide-primary-200 divide-opacity-10">
            <div class="flex flex-row items-center justify-between">
                <div class="flex flex-row gap-x-4">
                    <input type="radio" checked="true">

                    <div class="flex flex-col">
                        <span class="text-sm text-white">Standard Delivery</span>
                        <span class="text-sm text-white">Your purchase will arrive between 10 and 15 days</span>
                    </div>
                </div>

                <span class="text-sm text-white text-right">R$ 0,00</span>
            </div>
        </div>
    </div>

    <div class="flex flex-row items-center justify-end mt-8">
        <x-primary-button class="px-8 py-4" wire:click.prevent="submitShipping">
            Continue to payment
        </x-primary-button>
    </div>
</div>
