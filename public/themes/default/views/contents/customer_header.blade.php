  <div class="container-fluid">
    <!-- <div style="margin-bottom:80px"></div> -->
    <div class="row customer-items-wrapper" >
      <div class="col-md-3 top-links-wrapper">
        <h4 class="customer-badge-heading">
        @auth('customer')
          <a href="{{ route('account', 'dashboard') }}" role="button">
            <span>{{ trans('theme.hello') . ', ' . Auth::guard('customer')->user()->getName() }}</span>
          </a>
        @endauth
        </h4>
        <p>Top Links for You</p>
        <div class="top-links-inner">
          @auth('customer')
            <div class="inner-img-wrapper">
                <a class="product-link" href="{{ route('account', 'orders') }}">
                  <img class="product-img" src="{{ asset('storage/images/banners/box.jpg') }}" data-name="product_image"  />
                  <h6 class="text-center">Your Orders</h6>
                </a>  
              </div>
          @endauth
          @foreach($popular_categories as $key => $item)
            @auth('customer')
              @php 
                $count = 3
              @endphp
            @else
              @php 
                $count = 4
              @endphp
            @endauth
            @if($key < $count)
              <!-- <div class="inner-img-wrapper">
                <a class="product-link" href="{{ route('show.product', $item->slug) }}">
                  <img class="product-img" src="{{ get_inventory_img_src($item, 'medium') }}" data-name="product_image" alt="{!! $item->title !!}" title="{!! $item->title !!}" />
                  <h6 class="text-center">{!! $item->title !!}</h6>
                </a>  
              </div> -->
              
            @endif
          @endforeach
        </div>
      </div>
      <!-- Recently Viewed -->
          <div class="col-md-3 top-links-wrapper recently-viewed-wrapper">
              <h4 class="customer-badge-heading">
                Recently Viewed
              </h4>
              <div class="customer-product-wrapper">
                @foreach($recent as $key => $item)
                  @if($key < 1)
                  <a class="product-link product-<?php echo $key+1 ?>" href="{{ route('show.product', $item->slug) }}">
                    <div class="customer-product-img">
                      <div class="img-wrapper">
                        <img class="product-img" src="{{ get_inventory_img_src($item, 'large') }}" data-name="product_image" alt="{!! $item->title !!}" title="{!! $item->title !!}" />
                      </div>
                      <h6 class="text-center">{{ $item->title }}</h6>
                    </div>
                  </a> 
                  @endif
                @endforeach
              </div>
          </div>
          <!-- Recently Added -->
          <div class="col-md-3 top-links-wrapper">
              <h4 class="customer-badge-heading">
                Recently Added
              </h4>
              <div class="customer-product-wrapper">
                <?php $num = 0; ?>
                @foreach($recent as $key => $item)
                  @if($key % 2 == 0 && $num < 4)
                    <a class="product-link product-<?php echo $num+1 ?>" href="{{ route('show.product', $item->slug) }}">
                      <div class="customer-product-img">
                        <img class="product-img" src="{{ get_inventory_img_src($item, 'large') }}" data-name="product_image" alt="{!! $item->title !!}" title="{!! $item->title !!}" />
                        <h6 class="text-center">{{ $item->title }}</h6>
                      </div>
                    </a> 
                    <?php $num += 1; ?>
                  @endif
                @endforeach
              </div>
          </div>
          <!-- Daily Deals -->
          <div class="col-md-3 top-deal-wrapper">
            <div class="top-links-wrapper ">
              <h4 class="customer-badge-heading">
                Top Deals
              </h4>
              <p>Looking for a Deal? Browse 1000s of Deals on top selling products.</p>
              <p>
                <a href="#">Shop all Deals</a>
              </p>
            </div>
            <div class="top-deals-wrapper">

            </div>
          </div>
    </div><!-- /.row -->
  </div><!-- /.container -->
