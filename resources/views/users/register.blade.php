<x-layout>
  <div class="container text-center mt-4">
      <img src="{{asset('images/logo.png')}}" alt="Logo" class="img-fluid" style="max-height: 300px;">
  </div>
  <div class="container mb-4">
      <form method = "POST" action = "/users" class="col-md-4 mx-auto" id="auth">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label text-white">Name</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
            @error('name')
            <p class = "text-danger">{{$message}}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-label text-white">Email</label>
            <input type="email" name="email" class="form-control" value="{{old('email')}}">
            @error('email')
            <p class = "text-danger">{{$message}}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="phone-number" class="form-label text-white">Phone Number</label>
            <input type="tel" name="phone_number" class="form-control" value="{{old('phone_number')}}">
            @error('phone_number')
            <p class = "text-danger">{{$message}}</p>
            @enderror
          </div>
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
              <button type="submit" class="btn btn-primary">Register</button>
              <a class="button button-outline mt-2 mx-auto" href="/login">Already have an account?</a>
          </div>
      </form>
  </div>
</x-layout>
