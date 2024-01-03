<x-layout>
    <div class="container text-center mt-4">
        <img src="{{asset('images/logo.png')}}" alt="Logo" class="img-fluid" style="max-height: 300px;">
    </div>
    <div class="container mb-4">
        <form method = "POST" action = "/reset-password" class="col-md-4 mx-auto" id="auth">
            @csrf
            <input type="hidden" name="email" value="{{request('email')}}"/>
            <input type="hidden" name="token" value="{{$token}}"/>
            <div class="mb-3">
              <label for="password" class="form-label text-white">Password</label>
              <input type="password" name="password" class="form-control">
              @error('password')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password2" class="form-label text-white">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control"/>
              @error('password_confirmation')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </form>
    </div>
  </x-layout>
  