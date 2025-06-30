<div>
    <div class="card-body">
        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Masuk ke Akun Anda</h5>
            <p class="text-center small">Masukkan Email dan Password</p>
        </div>

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="login" class="row g-3 needs-validation" novalidate>
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input wire:model="email" type="email" class="form-control" id="email" required>
                </div>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input wire:model="password" type="password" class="form-control" id="password" required>
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input wire:model="remember" class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </div>

            <div class="col-12">
                <p class="small mb-0">Don't have account? <a href="#">Create an account</a></p>
            </div>
        </form>
    </div>

    <!-- <div class="credits mt-3 text-center">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div> -->
</div>