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
                    <x-checkout.product-item
                        name="High Wall Tote"
                        image="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg"
                        price="49.99"
                        :features="[
                                '100% cotton',
                                'Imported',
                            ]"
                    />
                </x-checkout.product-list>

                <dl class="space-y-6 border-t border-white border-opacity-10 pt-6 text-sm font-medium">
                    <x-checkout.summary-item title="Subtotal" :price="49.99" />
                    <x-checkout.summary-item title="Frete" :price="20.00" />
                    <x-checkout.summary-item title="Total" :price="69.99" :is-last="true" />
                </dl>
            </div>
        </section>

        <section
            aria-labelledby="payment-and-shipping-heading"
            class="py-6 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:max-w-lg lg:w-full lg:pb-24 lg:pt-0"
        >
            <form>
                <div class="mx-auto max-w-2xl px-4 lg:max-w-none lg:px-0">
                    <x-section-title title="Informações de contato" />

                    <div class="mt-6">
                        <x-input-label for="email-adress" value="E-mail"/>
                        <div class="mt-1">
                            <x-text-input
                                type="email" id="email-adress" name="email" autocomplete="email" />
                        </div>
                    </div>

                    <div class="mt-10">
                        <x-section-title title="Detalhes do pagamento" />

                        <div class="mt-6 grid grid-cols-3 gap-x-4 gap-y-6 sm:grid-cols-4">
                            <div class="col-span-3 sm:col-span-4">
                                <x-input-label for="card-number" value="Número do cartão"/>
                                <div class="mt-1">
                                    <x-text-input type="text" id="card-number" name="card-number" placeholder="Número do cartão" />
                                </div>
                            </div>

                            <div class="col-span-2 sm:col-span-3">
                                <x-input-label for="expiration-date" value="Data de validade"/>
                                <div class="mt-1">
                                    <x-text-input type="text" id="expiration-date" name="expiration-date" placeholder="MM/AA" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="card-number" value="CVV"/>
                                <div class="mt-1">
                                    <x-text-input type="text" id="cvv" name="cvv" placeholder="CVV" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
