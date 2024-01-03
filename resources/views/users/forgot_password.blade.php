<x-layout>
    <div class="container text-center mt-4">
        <img src="{{asset('images/logo.png')}}" alt="Logo" class="img-fluid" style="max-height: 300px;">
    </div>
    <div class="container mb-4">
        <form method = "POST" action = "/forgot-password" class="col-md-4 mx-auto">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label text-white">Email</label>
              <input type="email" name="email" class="form-control" value="{{old('email')}}">
              @error('email')
              <p class = "text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Send Recovery E-mail</button>
            </div>
        </form>
    </div>
</x-layout>