    <header>
        <h2 class="text-lg">
            {{ __('Delete Account') }}
        </h2>

        <p class="my-1">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">{{ __('Delete Account') }}</button>

    <!-- Modal -->
    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-hidden="true">
        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title fs-2" id="exampleModalLabel">{{ __('Are you sure you want to delete your account?') }}</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>
            <div class="form-floating @error('password') is-invalid @enderror">
                <input type="password" id="password" name="password" class="block my-2 w-full form-control @error('password') is-invalid @enderror" placeholder="Password" autofocus autocomplete="current-password" />
                <label for="password">Password</label>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
        </div>
        </div>
    </div>
        </form>
    </div>