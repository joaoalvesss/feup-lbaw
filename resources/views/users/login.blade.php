<x-layout>
    <div class="container text-center mt-4">
        <img src="{{asset('images/logo.png')}}" alt="Logo" class="img-fluid" style="max-height: 300px;">
    </div>
    <div class="container mb-4">
        <form method = "POST" action = "/users/authenticate" class="col-md-4 mx-auto" id="auth">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label text-white">Email</label>
              <input type="email" name="email" class="form-control" value="{{old('email')}}">
              @error('email')
              <p class = "text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label text-white">Password</label>
              <input type="password" name="password" class="form-control">
              @error('password')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{old('remember') ? 'checked' : ''}}>
                <label class="form-check-label text-white" for="remember">Remember Me</label>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="button button-outline mt-2 mx-auto" href="/forgot-password">Forgot password?</a>
                <a class="button button-outline mt-2 mx-auto" href="/register">Don't have an account?</a>
            </div>
        </form>
    </div>
</x-layout>