<section class="light-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="section-title cat-title">
            <h4>Select From Categories</h4>
          </div>
          @foreach($all_categories as $categoryGroup)
            @if($categoryGroup->subGroups->count())
              <div class="col-md-2 col-sm-6 bg-white category-widget space30">
                <a href="{{ route('categoryGrp.browse', $categoryGroup->slug) }}">
                  <section class="category-banner-img-wrapper">
                    <div class="banner banner-o-hid" style="background-color: #333; background-image:url( {{ get_cover_img_src($categoryGroup, 'category') }} );">
                      <div class="banner-caption">
                        
                      </div>
                    </div>
                  </section>
                  <p class="lead">{{ $categoryGroup->name }}</p>
                </a>
                <!-- @foreach($categoryGroup->subGroups as $subGroup)
                  <p class="category-heading">
                    <a href="{{ route('categories.browse', $subGroup->slug) }}">{{ $subGroup->name }}</a>
                  </p> -->
                  <!-- <ul class="nav-category-inner-list">
                    @foreach($subGroup->categories as $cat)
                      <li><a href="{{ route('category.browse', $cat->slug) }}">{{ $cat->name }}</a>
                        @if($cat->description)
                          <p>{!! $cat->description !!}</p>
                        @endif
                      </li>
                    @endforeach
                  </ul> -->
                <!-- @endforeach -->
              </div><!-- /.col-md-3 -->
              <!-- @if($loop->iteration % 4 == 0)
                <div class="clearfix"></div>
              @endif -->
              <!-- @if($loop->iteration % 2 == 0) -->
                <!-- Add clearfix for only the sm viewport -->
                <!-- <div class="clearfix visible-sm-block"></div> -->
              <!-- @endif -->
            @endif
          @endforeach
        </div>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>