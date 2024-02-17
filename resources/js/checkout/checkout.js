import { loadMercadoPago } from "@mercadopago/sdk-js";

export default () => ({
    async creditCardPayment() {
        await loadMercadoPago();
        const mp = new window.MercadoPago(import.meta.env.VITE_MERCADO_PAGO_PUBLIC_KEY);


        const cardForm = mp.cardForm({
            amount: this.$wire.get("cart.total"),
            iframe: true,
            form: {
                id: "form-checkout",
                cardNumber: {
                    id: "form-checkout__cardNumber",
                    placeholder: "Card Number",
                    style: {
                        color: '#ff79c5'
                    }
                },
                expirationDate: {
                    id: "form-checkout__expirationDate",
                    placeholder: "MM/YY",
                    style: {
                        color: '#ff79c5'
                    }
                },
                securityCode: {
                    id: "form-checkout__securityCode",
                    placeholder: "Security Code",
                    style: {
                        color: '#ff79c5'
                    }
                },
                cardholderName: {
                    id: "form-checkout__cardholderName",
                    placeholder: "Card Nominee",
                },
                issuer: {
                    id: "form-checkout__issuer",
                    placeholder: "Issuer",
                },
                installments: {
                    id: "form-checkout__installments",
                    placeholder: "Installments",
                },
                identificationType: {
                    id: "form-checkout__identificationType",
                    placeholder: "Identification Type",
                },
                identificationNumber: {
                    id: "form-checkout__identificationNumber",
                    placeholder: "Identification Type",
                },
                cardholderEmail: {
                    id: "form-checkout__cardholderEmail",
                    placeholder: "E-mail",
                },
            },
            callbacks: {
                onFormMounted: error => {
                    if (error) return console.warn("Form Mounted handling error: ", error);
                    console.log("Form mounted");
                },
                onSubmit: async event => {
                    event.preventDefault();

                    const {
                        paymentMethodId: payment_method_id,
                        issuerId: issuer_id,
                        cardholderEmail: email,
                        amount,
                        token,
                        installments,
                        identificationNumber,
                        identificationType,
                    } = cardForm.getCardFormData();

                    const result = this.$wire.creditCardPayment({
                        token,
                        issuer_id,
                        payment_method_id,
                        transaction_amount: Number(amount),
                        installments: Number(installments),
                        description: "Descrição do produto",
                        payer: {
                            email,
                            identification: {
                                type: identificationType,
                                number: identificationNumber,
                            },
                        }
                    })
                }
            },
        });

    },
    async pixOrBankSlipPayment(method) {
        this.$wire.pixOrBankSlipPayment({
            amount: this.$wire.$get("cart.total"),
            method,
            cpf: this.$wire.$get('user.cpf')
        })
    }
})
