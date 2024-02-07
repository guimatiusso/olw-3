<div>
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
                    {{ $address->street }}
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
                        <span class="text-sm text-white">Standard Delivery - R$ 0,00</span>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-10">
            <x-section-title title="Payment" />

            <div class="mt-4 w-full flex flex-col rounded-md border border-primary-200 p-4 divide-y divide-primary-200 divide-opacity-10">
                <label for="credit_card" class="flex flex-row gap-x-4 items-center py-4 cursor-pointer" @click.prevent="$wire.method = 1;">
                    <input type="radio" name="payment_method" id="credit_card" value="1" wire:model.live="method">

                    <div class="flex flex-col">
                        <span class="text-sm text-white">Credit Card</span>
                    </div>
                </label>

                <label for="pix" class="flex flex-row gap-x-4 items-center py-4 cursor-pointer" @click.prevent="$wire.method = 2;">
                    <input type="radio" name="payment_method" id="pix" value="2" wire:model.live="method">

                    <div class="flex flex-col">
                        <span class="text-sm text-white">Pix</span>
                    </div>
                </label>

                <label for="bank_slip" class="flex flex-row gap-x-4 items-center py-4 cursor-pointer" @click.prevent="$wire.method = 3;">
                    <input type="radio" name="payment_method" id="bank_slip" value="3" wire:model.live="method">

                    <div class="flex flex-col">
                        <span class="text-sm text-white">Bank Slip</span>
                    </div>
                </label>
            </div>
        </div>
    </div>

</div>
