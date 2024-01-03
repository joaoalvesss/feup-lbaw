// cart AJAX
document.addEventListener('DOMContentLoaded', function() {
    let quantityInputs = document.querySelectorAll('.quantity-input');
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    function updateTotalPrice(){
        let priceSpans = document.querySelectorAll('.price');

        let totalPrice = Array.from(priceSpans).reduce(function (total, priceSpan){
            return total + parseFloat(priceSpan.textContent);
        }, 0);

        let totalElement = document.querySelector('.total-price');

        totalElement.textContent = totalPrice.toFixed(2) + '€';
    }

    quantityInputs.forEach(function(input) {
        let originalQuantity = input.value;

        input.addEventListener('input', function() {
            let productId = input.getAttribute('data-product-id');
            let quantity = input.value;

            fetch('/cart/' + productId, {
                method: 'PATCH', 
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(data) {
                console.log(data);

                let priceSpan = input.parentElement.nextElementSibling.querySelector('.price');

                priceSpan.textContent = (quantity * data.price).toFixed(2) + '€';

                originalQuantity = quantity;

                updateTotalPrice();
            })
            .catch(function(error) {
                console.error(error);

                input.value = originalQuantity;
            });
        });
    });
});

//review votes

document.addEventListener('DOMContentLoaded', function() {
    let upvote = document.querySelectorAll('.upvote');
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    upvote.forEach(function(input) {
        input.addEventListener('click', function() {
            let reviewId = input.getAttribute('data-review-id');

            fetch('/reviews/' + reviewId + '/up', {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(data) {
                console.log(data);
                let vote_span = input.nextElementSibling.children[0];
                let current_votes = vote_span.innerText;
                vote_span.innerText = data.votes;
                let down_arrow = input.nextElementSibling.nextElementSibling;
                if (current_votes < data.votes) {
                    input.classList.remove('text-white');
                    input.classList.add('text-success');
                }
                else {
                    input.classList.remove('text-success');
                    input.classList.add('text-white');
                }
                down_arrow.classList.remove('text-danger');
                down_arrow.classList.add('text-white');
            })
            .catch(function(error) {
                console.error(error);
            });
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    let downvote = document.querySelectorAll('.downvote');
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    downvote.forEach(function(input) {
        input.addEventListener('click', function() {
            let reviewId = input.getAttribute('data-review-id');

            fetch('/reviews/' + reviewId + '/down', {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(data) {
                console.log(data);
                let vote_span = input.previousElementSibling.children[0];
                let current_votes = vote_span.innerText;
                vote_span.innerText = data.votes;
                let up_arrow = input.previousElementSibling.previousElementSibling;
                if (current_votes > data.votes) {
                    input.classList.remove('text-white');
                    input.classList.add('text-danger');
                }
                else {
                    input.classList.remove('text-danger');
                    input.classList.add('text-white');
                }
                up_arrow.classList.remove('text-success');
                up_arrow.classList.add('text-white');
            })
            .catch(function(error) {
                console.error(error);
            });
        });
    });
});
//review stars

document.addEventListener('DOMContentLoaded', function() {
  var stars = document.querySelectorAll('.star');

  stars.forEach(function(star) {
      star.addEventListener('click', function() {
          var value = this.dataset.value;

          stars.forEach(function(s) {
              s.classList.remove('fas');
              s.classList.add('far');
          });

          var currentStar = this;
          while (currentStar) {
              currentStar.classList.remove('far');
              currentStar.classList.add('fas');
              currentStar = currentStar.previousElementSibling;
          }
          document.getElementById('score').value = value;
      });
  });
});

//review character limit

document.addEventListener('DOMContentLoaded', function() {
    var commentInput = document.getElementById('comment');
    var charCount = document.getElementById('charCount');

    commentInput.addEventListener('input', function() {
        var currentLength = this.value.length;
        var maxLength = parseInt(this.getAttribute('maxlength'));
        var remaining = maxLength - currentLength;

        if (remaining < 0) {
            this.value = this.value.substring(0, maxLength);
            remaining = 0;
        }

        charCount.textContent = remaining;
    });
});

// stock AJAX

document.addEventListener('DOMContentLoaded', function() {
    let stockInputs = document.querySelectorAll('.stock-input');
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    stockInputs.forEach(function(input) {
        let originalStock = input.value;

        input.addEventListener('input', function() {
            let productId = input.getAttribute('data-product-id');
            let stock = input.value;

            fetch('/admin/products/' + productId, {
                method: 'PATCH', 
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ stock: stock })
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                originalStock = stock;

                return response.json();
            })
            .catch(function(error) {
                console.error(error);

                input.value = originalStock;
            });
        });
    });
});
function addToCart() {
    const form = document.querySelector('.add-to-cart-form');
    submitForm(form);
}

function addToWishlist() {
    const form = document.querySelector('.add-to-wishlist-form');
    submitForm(form);
}

function submitForm(form) {
    fetch(form.action, {
        method: form.method,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
        },
        body: new URLSearchParams(new FormData(form)).toString(),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        // Handle success, e.g., show a success message
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        // Handle error, e.g., show an error message
    });
}


function updateCheckoutForm(radio) {
    var selectedAddressId = radio.value;
    document.getElementById('checkoutForm').elements['addressId'].value = selectedAddressId;
}
