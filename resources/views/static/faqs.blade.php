<x-layout>
     <div class="faq-container">
         <h1 id="tittle" class="text-white">Frequently Asked Questions</h1>
         <ul class="faq-list">
             @foreach($faqs as $key => $faq)
                 <li class="faq-item">
                     <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $key }}" aria-expanded="false" aria-controls="faqCollapse{{ $key }}">
                         <strong>
                             {{ $faq->question }}
                             <span class="accordion-icon"></span>
                         </strong>
                     </button>
                     <div id="faqCollapse{{ $key }}" class="collapse">
                         <p>{{ $faq->answer }}</p>
                     </div>
                 </li>
             @endforeach
         </ul>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-sb2E9iVITFfEGQMSQ4HI+GQ4Oj3l6smkAHC7bc8sG/Lv98TpR/RRg6Iek9gKxUy1" crossorigin="anonymous"></script>
</x-layout>
 