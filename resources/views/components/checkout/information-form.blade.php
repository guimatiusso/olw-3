<div>
    <x-section-title title="Contact Information" />

    <div class="mt-6">
        <x-input-label for="email-adress" value="E-mail"/>
        <div class="mt-1">
            <x-text-input
                type="email" id="email-adress" name="email" autocomplete="email" placeholder="E-mail" wire:model="user.email" />
        </div>

        <div>
            @error('user.email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-6">
        <x-input-label for="name" value="Name"/>
        <div class="mt-1">
            <x-text-input
                type="name" id="name" name="name" autocomplete="name" placeholder="Name" wire:model="user.name" />
        </div>

        <div>
            @error('user.name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-10">
        <x-section-title title="Delivery Address" />

        <div class="mt-6 grid grid-cols-3 gap-x-4 gap-y-6 sm:grid-cols-4">
            <div class="col-span-6 sm:col-span-1">
                <x-input-label for="zipcode" value="Zipcode"/>
                <div class="mt-1">
                    <x-text-input type="text" id="zipcode" name="zipcode" placeholder="Zipcode" wire:model="address.zipcode" wire:change="findAddress()" />
                </div>
                <div>
                    @error('address.zipcode') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>

            </div>

            <div class="col-span-2 sm:col-span-3">
                <x-input-label for="address" value="Address"/>
                <div class="mt-1">
                    <x-text-input type="text" id="address" name="address" placeholder="Address" wire:model="address.address"/>
                </div>
                <div>
                    @error('address.address') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-span-2">
                <x-input-label for="number" value="Number"/>
                <div class="mt-1">
                    <x-text-input type="text" id="number" name="number" placeholder="Number" wire:model="address.number"/>
                </div>
                <div>
                    @error('address.number') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-span-2">
                <x-input-label for="complement" value="Complement"/>
                <div class="mt-1">
                    <x-text-input type="text" id="complement" name="complement" placeholder="Complement" wire:model="address.complement"/>
                </div>
                <div>
                    @error('address.complement') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-span-2 sm:col-span-4">
                <x-input-label for="district" value="District"/>
                <div class="mt-1">
                    <x-text-input type="text" id="district" name="District" placeholder="District" wire:model="address.district"/>
                </div>
                <div>
                    @error('address.district') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-span-2">
                <x-input-label for="city" value="City"/>
                <div class="mt-1">
                    <x-text-input type="text" id="city" name="city" placeholder="City" wire:model="address.city"/>
                </div>
                <div>
                    @error('address.city') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-span-2">
                <x-input-label for="state" value="State"/>
                <div class="mt-1">
                    <x-text-input type="text" id="state" name="state" placeholder="State" wire:model="address.state"/>
                </div>
                <div>
                    @error('address.state') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-row items-center justify-end mt-8">
    <x-primary-button class="px-8 py-4" wire:click.prevent="submitInformation">
        Continuar com o frete
    </x-primary-button>
</div>
