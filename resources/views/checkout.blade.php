<x-app-layout>
    <section class="checkout">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        YOUR FUTURE CAREER
                    </p>
                    <h2 class="primary-header">
                        Start Invest Today
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-lg-5 col-12">
                            <div class="item-bootcamp">
                                <img src="/assets/images/item_bootcamp.png" alt="" class="cover">
                                <h1 class="package text-uppercase">
                                    {{ $camp->title }}
                                </h1>
                                <p class="description">
                                    {{ $camp->description }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-1 col-12"></div>
                        <div class="col-lg-6 col-12">
                            <form action="{{ route('checkout.success') }}" class="basic-form" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        aria-describedby="name">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input name="email" type="email" class="form-control" id="email"
                                        aria-describedby="email">
                                </div>
                                <div class="mb-4">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input name="occupation" type="text" class="form-control" id="occupation"
                                        aria-describedby="occupation">
                                </div>
                                <div class="mb-4">
                                    <label for="card-number" class="form-label">Card Number</label>
                                    <input name="cardNumber" type="number" class="form-control" id="card-number"
                                        aria-describedby="cardNumber">
                                </div>
                                <div class="mb-5">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <label for="expired" class="form-label">Expired</label>
                                            <input name="expired" type="text" class="form-control" id="expired"
                                                aria-describedby="expired">
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <label for="cvc" class="form-label">CVC</label>
                                            <input name="cvc" type="text" class="form-control" id="cvc"
                                                aria-describedby="cvc">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="w-100 btn btn-primary">Pay Now</button>
                                <p class="text-center subheader mt-4">
                                    <img src="/assets/images/ic_secure.svg" alt=""> Your payment is secure and
                                    encrypted.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
