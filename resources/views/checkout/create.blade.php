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
                            <form action="{{ route('checkout.store', $camp->id) }}" class="basic-form"
                                method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        aria-describedby="name" value="{{ Auth::user()->name }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        aria-describedby="email" value="{{ Auth::user()->email }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input name="occupation" type="text"
                                        class="form-control @error('occupation') is-invalid @enderror" id="occupation"
                                        aria-describedby="occupation"
                                        value="{{ old('occupation', Auth::user()->occupation) }}" required>
                                    @error('occupation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="card-number" class="form-label">Card Number</label>
                                    <input name="card_number" type="number" value="{{ old('card_number') }}"
                                        class="form-control @error('card_number') is-invalid @enderror" id="card-number"
                                        aria-describedby="cardNumber" required>
                                    @error('card_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <label for="expired" class="form-label">Expired</label>
                                            <input name="expired" type="month" value="{{ old('expired') }}"
                                                class="form-control @error('expired') is-invalid @enderror" id="expired"
                                                aria-describedby="expired" required>
                                            @error('expired')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <label for="cvc" class="form-label">CVC</label>
                                            <input name="cvc" type="number" value="{{ old('cvc') }}"
                                                class="form-control @error('cvc') is-invalid @enderror" id="cvc"
                                                aria-describedby="cvc" maxlength="3" required>
                                            @error('cvc')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
