@props(['product'])

<div>
    <div>
        <div>
            <div class="review">
                <form method="POST" action="/reviews" id="reviewForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product}}"/>
                    <div class="d-flex justify-content-end align-items-center">
                        <strong class="text-white">Score: </strong>
                        <span class="text-warning stars">
                            <i class="far fa-star star" data-value="1"></i>
                            <i class="far fa-star star" data-value="2"></i>
                            <i class="far fa-star star" data-value="3"></i>
                            <i class="far fa-star star" data-value="4"></i>
                            <i class="far fa-star star" data-value="5"></i>
                        </span>
                        <input type="hidden" id="score" name="score" value=""/>
                        @error('score')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="comment" class="text-white">Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="4" maxlength="200"></textarea>
                        <div id="charCount" class="text-white text-end mt-1">200</div>
                    </div>
                    <div>
                        <button type="submit" class="buy">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>    
    </div>
</div>
