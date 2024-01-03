<x-layout>
    <div class="container mb-4">
        <form method = "POST" action = "/users/edit" class="col-md-4 mx-auto" id="auth" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="name" class="form-label text-white">Name</label>
              <input type="text" name="name" class="form-control" value="{{$user->name}}">
              @error('name')
              <p class = "text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label text-white">Email</label>
              <input type="email" name="email" class="form-control" value="{{$user->email}}">
              @error('email')
              <p class = "text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="phone-number" class="form-label text-white">Phone Number</label>
              <input type="tel" name="phone_number" class="form-control" value="{{$user->phone_number}}">
              @error('phone_number')
              <p class = "text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label text-white">Profile Picture</label>
                <input type="file" class="form-control" name="image"/>
                @error('image')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
  </x-layout>
  