<!-- Fanspage Facebook Widget -->
{{-- <div class="card mb-4 border-0 shadow-sm">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
          <div class="fb-page" data-href="//www.facebook.com/nurulfikriserangbanten/" data-tabs="timeline" data-width="350" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="//www.facebook.com/nurulfikriserangbanten/" class="fb-xfbml-parse-ignore">
              <a href="//www.facebook.com/nurulfikriserangbanten/">Nurul Fikri Boarding School Serang</a>
            </blockquote>
          </div>
      </div>
    </div>
  </div>
</div> --}}

<!-- Popular Widget -->
<h3>Artikel Populer</h3>
<div class="list-group">
  @foreach ($popularPosts as $p)
      <a href="{{ route('post.show', $p->slug) }}" class="card2 col2">
          <div class="side__content">
              <span class="label">{{ $p->date }}</span>
              <h4 class="mb-0">{{$p->title}}</h4>
          </div>
      </a>
  @endforeach
</div>

<!-- Categories Widget -->
<h3 class="mt-4">Kategori</h3>
<div class="side__content pl-0 pt-0">
    @foreach ($categories as $c)
        <a class="btn btn-tag btn-sm mb-1" href="{{ route('category', $c->slug) }}">{{ $c->title }}</a>
    @endforeach
</div>
