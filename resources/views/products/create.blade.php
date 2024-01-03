<x-layout>
    <div class="edit-create-product mb-4">
        <h1 style="text-align: center; color: white;">Create Product</h1>
        <form method = "POST" action = "/products" class="form-container col-md-4" id="auth" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label text-white">Name</label>
              <input type="text" name="name" class="form-control">
              @error('name')
              <p class = "text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="price" class="form-label text-white">Price</label>
              <input type="text" name="price" class="form-control">
              @error('price')
              <p class = "text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="description" class="form-label text-white">Description</label>
              <textarea class="form-control" name="description" rows="4" maxlength="300"></textarea>
              @error('description')
              <p class = "text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
                <label for="platform" class="form-label text-white">Platform</label>
                <select name="platform" class="form-control">
                    @foreach(App\Models\Platform::all() as $platform)
                        <option value="{{$platform->id}}">{{$platform->name}}</option>
                    @endforeach
                </select>
                @error('platform')
                <p class = "text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3 text-white">
                <label class="form-label">Categories</label>
                <div class="category-checkboxes">
                    @foreach (App\Models\Category::all() as $category)
                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{$category->id}}"/>
                        <label class="form-check-label">{{$category->name}}</label>
                        <br>
                    @endforeach                    
                </div>

                @error('categories')
                <p class = "text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label text-white"> Image </label>
                <input type="file" class="form-control" name="image"/>
                @error('image')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image2" class="form-label text-white"> Image2 </label>
                <input type="file" class="form-control" name="image2"/>
                @error('image2')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="button-container d-flex justify-content-center">
                <button type="submit" class="edit-create-button">Create</button>
            </div>
        </form>
    </div>
  </x-layout>
  