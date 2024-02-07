<div class="bg-tertiary-900">
    <div class="fixed left-0 top-0 hidden lg:block h-full w-1/2 bg-tertiary-900"></div>
    <div class="fixed right-0 top-0 hidden lg:block h-full w-1/2 bg-tertiary-800"></div>

    <div class="relative mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2 gap-x-16 lg:px-8 lg:pt-16">
        <section
            aria-labelledby="summary-heading"
            class="bg-tertiary-800 py-12 md:px-10 lg:col-start-2 lg:row-start-1 lg:mx-auto lg:w-full lg:max-w-lg lg:bg-transparent lg:px-0 lg:pb-24 lg:pt-0"
        >
            <div class="mx-auto max-w-2xl px-4 lg:max-w-none lg:px-0">
                <dl>
                    <dt class="text-lg font-medium text-primary-200">Resumo</dt>
                </dl>

                <x-checkout.product-list>
                    @foreach($cart['skus'] as $sku)
                        <x-checkout.product-item
                            :name="$sku['name']"
                            image="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg"
                            :price="$sku['price']"
                            :features="collect($sku['features'])->map(fn($feauture) => $feauture['name']. ': ' .$feauture['pivot']['value'])"
                            :quantity="$sku['pivot']['quantity']"
                        />
                    @endforeach
                </x-checkout.product-list>

                <dl class="space-y-6 border-t border-white border-opacity-10 pt-6 text-sm font-medium">
                    <x-checkout.summary-item title="Subtotal" :value="$cart['total']" />
                    <x-checkout.summary-item title="Frete" value="0" />
                    <x-checkout.summary-item title="Total" :value="$cart['total']" :is-last="true" />
                </dl>
            </div>
        </section>

        <section
            aria-labelledby="payment-and-shipping-heading"
            class="py-6 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:max-w-lg lg:w-full lg:pb-24 lg:pt-0">
            <div class="mx-auto max-w-2xl px-4 lg:max-w-none lg:px-0">
                <div>
                    <div class="flex flex-row items-center text-white">
                        <nav class="flex mb-4" aria-label="Breadcrumb">
                            <ol class="text-xs inline-flex items-center space-x-1 md:space-x-3">
                                <li @class((['font-bold text-lg' => $step === CheckoutStepsEnum::INFORMATION->value]))>
                                    <span>{{CheckoutStepsEnum::INFORMATION->getName()}}</span>
                                </li>
                                <span class="text-sm text-white font-bold">&gt</span>
                                <li @class((['font-bold text-lg' => $step === CheckoutStepsEnum::SHIPPING->value]))>
                                    <span>{{CheckoutStepsEnum::SHIPPING->getName()}}</span>
                                </li>
                                <span class="text-sm text-white font-bold">&gt</span>
                                <li @class((['font-bold text-lg' => $step === CheckoutStepsEnum::PAYMENT->value]))>
                                    <span>{{CheckoutStepsEnum::PAYMENT->getName()}}</span>
                                </li>
                            </ol>
                        </nav>
                    </div>

                    @if($step == CheckoutStepsEnum::INFORMATION->value)
                        <x-checkout.information-form />
                    @elseif($step == CheckoutStepsEnum::SHIPPING->value)
                        <x-checkout.shipping-form :user="$user" :address="$address" />
                    @elseif($step == CheckoutStepsEnum::PAYMENT->value)
                        <x-checkout.payment-form :user="$user" :address="$address"/>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
