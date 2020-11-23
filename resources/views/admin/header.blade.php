<!-- Main Header -->
<header class="main-header">
  <!-- Logo -->
  <a href="{{ url('/') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">{{ str_limit(get_site_title(), 2, '.') }}</span>

    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg text-black">{{ get_site_title() }}</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->

  @if(!Auth::user()->isMerchant())
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    @endif
@if(Auth::user()->isMerchant())
      <div class="navbar-menu">
        <ul class="nav navbar-nav">
          <li class="messages-menu">
            <a href="/admin/dashboard">
              Dashboard
            </a>
          </li>
          <!-- Product Nac Item -->
          @if(Gate::allows('index', \App\Category::class) || Gate::allows('index', \App\Attribute::class) || Gate::allows('index', \App\Product::class) || Gate::allows('index', \App\Manufacturer::class) || Gate::allows('index', \App\CategoryGroup::class) || Gate::allows('index', \App\CategorySubGroup::class))
            <li class="nav-item {{ Request::is('admin/catalog/product*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Listing & Products
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <ul class="treeview-menu">
                @if(Gate::allows('index', \App\Category::class) || Gate::allows('index', \App\CategoryGroup::class) || Gate::allows('index', \App\CategorySubGroup::class))
                  <li class="{{ Request::is('admin/catalog/category*') ? 'active' : '' }}">
                    <a href="#">
                      {{ trans('nav.categories') }}
                    </a>
                    <ul class="treeview-menu">

                      @can('index', \App\CategoryGroup::class)
                        <li class="{{ Request::is('admin/catalog/categoryGroup*') ? 'active' : '' }}">
                          <a href="{{ route('admin.catalog.categoryGroup.index') }}">
                            {{ trans('nav.groups') }}
                          </a>
                        </li>
                      @endcan

                      @can('index', \App\CategorySubGroup::class)
                        <li class="{{ Request::is('admin/catalog/categorySubGroup*') ? 'active' : '' }}">
                          <a href="{{ route('admin.catalog.categorySubGroup.index') }}">
                            {{ trans('nav.sub-groups') }}
                          </a>
                        </li>
                      @endcan

                      @can('index', \App\Category::class)
                        <li class="{{ Request::is('admin/catalog/category') ? 'active' : '' }}">
                          <a href="{{ url('admin/catalog/category') }}">
                            {{ trans('nav.categories') }}
                          </a>
                        </li>
                      @endcan
                    </ul>
                  </li>
                @endif

                @can('index', \App\Attribute::class)
                  <li class=" {{ Request::is('admin/catalog/attribute*') ? 'active' : '' }}">
                    <a href="{{ url('admin/catalog/attribute') }}">
                      {{ trans('nav.attributes') }}
                    </a>
                  </li>
                @endcan

                @can('index', \App\Product::class)
                  <li class="{{ Request::is('admin/catalog/product/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.catalog.product.create') }}">
                      Add Product
                    </a>
                  </li>
                @endcan

                @can('index', \App\Product::class)
                  <li class=" {{ Request::is('admin/catalog/product') ? 'active' : '' }}">
                    <a href="{{ url('admin/catalog/product') }}">
                      {{ trans('nav.products') }}
                    </a>
                  </li>
                @endcan

                @can('index', \App\Manufacturer::class)
                  <li class=" {{ Request::is('admin/catalog/manufacturer*') ? 'active' : '' }}">
                    <a href="{{ url('admin/catalog/manufacturer') }}">
                      {{ trans('nav.manufacturers') }}
                    </a>
                  </li>
                @endcan

                @can('index', \App\Product::class)
                    <li class="{{ Request::is('admin/catalog/product/create') ? 'active' : '' }}">
                      <a href="{{ route('admin.catalog.product.create') }}">
                        Add Inventory
                      </a>
                    </li>
                  @endcan
                  
                  @can('index', \App\Inventory::class)
                    <li class=" {{ Request::is('admin/stock/inventory*') ? 'active' : '' }}">
                      <a href="{{ url('admin/stock/inventory') }}">
                        {{ trans('nav.inventories') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Warehouse::class)
                    <li class=" {{ Request::is('admin/stock/warehouse*') ? 'active' : '' }}">
                      <a href="{{ url('admin/stock/warehouse') }}">
                         {{ trans('nav.warehouses') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Supplier::class)
                    <li class=" {{ Request::is('admin/stock/supplier*') ? 'active' : '' }}">
                      <a href="{{ url('admin/stock/supplier') }}">
                         {{ trans('nav.suppliers') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Attribute::class)
                    <li class=" {{ Request::is('admin/catalog/attribute*') ? 'active' : '' }}">
                      <a href="{{ url('admin/catalog/attribute') }}">
                        {{ trans('nav.attributes') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Manufacturer::class)
                    <li class=" {{ Request::is('admin/catalog/manufacturer*') ? 'active' : '' }}">
                      <a href="{{ url('admin/catalog/manufacturer') }}">
                        {{ trans('nav.manufacturers') }}
                      </a>
                    </li>
                  @endcan
              </ul>
                
              </div>
            </li>
          @endif

          <!-- Warehouse Nav Item -->
          {{-- @if(Gate::allows('index', \App\Inventory::class) || Gate::allows('index', \App\Warehouse::class) || Gate::allows('index', \App\Supplier::class))
            <li class="nav-item {{ Request::is('admin/stock*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="warehousemenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Inventory
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="warehousemenu">
                <ul class="treeview-menu">

                  @can('index', \App\Product::class)
                    <li class="{{ Request::is('admin/catalog/product/create') ? 'active' : '' }}">
                      <a href="{{ route('admin.catalog.product.create') }}">
                        Add Inventory
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Inventory::class)
                    <li class=" {{ Request::is('admin/stock/inventory*') ? 'active' : '' }}">
                      <a href="{{ url('admin/stock/inventory') }}">
                        {{ trans('nav.inventories') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Warehouse::class)
                    <li class=" {{ Request::is('admin/stock/warehouse*') ? 'active' : '' }}">
                      <a href="{{ url('admin/stock/warehouse') }}">
                         {{ trans('nav.warehouses') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Supplier::class)
                    <li class=" {{ Request::is('admin/stock/supplier*') ? 'active' : '' }}">
                      <a href="{{ url('admin/stock/supplier') }}">
                         {{ trans('nav.suppliers') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Attribute::class)
                    <li class=" {{ Request::is('admin/catalog/attribute*') ? 'active' : '' }}">
                      <a href="{{ url('admin/catalog/attribute') }}">
                        {{ trans('nav.attributes') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Manufacturer::class)
                    <li class=" {{ Request::is('admin/catalog/manufacturer*') ? 'active' : '' }}">
                      <a href="{{ url('admin/catalog/manufacturer') }}">
                        {{ trans('nav.manufacturers') }}
                      </a>
                    </li>
                  @endcan
                </ul>
              </div>
            </li>
            
          @endif --}}

          <!-- Orders Nav Item -->
          @if(Gate::allows('index', \App\Order::class) || Gate::allows('index', \App\Cart::class))
            <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="ordersMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Orders
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul class="treeview-menu">
                  @can('index', \App\Order::class)
                    <li class=" {{ Request::is('admin/order/order*') ? 'active' : '' }}">
                      <a href="{{ url('admin/order/order') }}">
                        {{ trans('nav.orders') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Cart::class)
                    <li class=" {{ Request::is('admin/order/cart*') ? 'active' : '' }}">
                      <a href="{{ url('admin/order/cart') }}">
                        {{ trans('nav.carts') }}
                      </a>
                    </li>
                  @endcan

                  {{-- @can('index', \App\Payment::class) --}}
                    {{-- <li class=" {{ Request::is('admin/order/payment*') ? 'active' : '' }}">
                      <a href="{{ url('admin/order/payments') }}">
                      {{ trans('nav.payments') }}
                      </a>
                    </li> --}}
                  {{-- @endcan --}}
                </ul>
              </div>
            </li>
          @endif

          <!-- Admin Nav Item -->
          @if(Gate::allows('index', \App\User::class) || Gate::allows('index', \App\Customer::class))
            <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="ordersMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul class="treeview-menu">
                  @can('index', \App\User::class)
                    <li class=" {{ Request::is('admin/admin/user*') ? 'active' : '' }}">
                      <a href="{{ url('admin/admin/user') }}">
                        {{ trans('nav.users') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Customer::class)
                    <li class=" {{ Request::is('admin/admin/customer*') || Request::is('address/addresses/customer*') ? 'active' : '' }}">
                      <a href="{{ url('admin/admin/customer') }}">
                        {{ trans('nav.customers') }}
                      </a>
                    </li>
                  @endcan
                </ul>
              </div>
            </li>
          @endif

          <!-- Shipping -->
          @if(Gate::allows('index', \App\Carrier::class) || Gate::allows('index', \App\Packaging::class))
            <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="shippingMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Shipping
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul class="treeview-menu">
                  @can('index', \App\Carrier::class)
                    <li class=" {{ Request::is('admin/shipping/carrier*') ? 'active' : '' }}">
                      <a href="{{ url('admin/shipping/carrier') }}">
                        {{ trans('nav.carriers') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Packaging::class)
                    <li class=" {{ Request::is('admin/shipping/packaging*') ? 'active' : '' }}">
                      <a href="{{ url('admin/shipping/packaging') }}">
                        {{ trans('nav.packaging') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\ShippingZone::class)
                    <li class=" {{ Request::is('admin/shipping/shippingZone*') ? 'active' : '' }}">
                      <a href="{{ url('admin/shipping/shippingZone') }}">
                        {{ trans('nav.shipping_zones') }}
                      </a>
                    </li>
                  @endcan
                </ul>
              </div>
            </li>
          @endif

          <!-- Promotions -->
          @if(Gate::allows('index', \App\Coupon::class) || Gate::allows('index', \App\GiftCard::class))
            <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="shippingMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Promotions
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul class="treeview-menu">
                  @can('index', \App\Coupon::class)
                    <li class=" {{ Request::is('admin/promotion/coupon*') ? 'active' : '' }}">
                      <a href="{{ url('admin/promotion/coupon') }}">
                        {{ trans('nav.coupons') }}
                      </a>
                    </li>
                  @endcan
                  {{-- @can('index', \App\GiftCard::class)
                    <li class=" {{ Request::is('admin/promotion/giftCard*') ? 'active' : '' }}">
                      <a href="{{ url('admin/promotion/giftCard') }}">
                        {{ trans('nav.gift_cards') }}
                      </a>
                    </li>
                  @endcan --}}
                </ul>
              </div>
            </li>
          @endif

          <!-- Utilities -->
          @if(Gate::allows('index', \App\OrderStatus::class) || Gate::allows('index', \App\Currency::class))
            <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="shippingMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Utilities
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul class="treeview-menu">
                  @can('index', \App\Currency::class)
                    <li class=" {{ Request::is('admin/utility/currency*') ? 'active' : '' }}">
                      <a href="{{ url('admin/utility/currency') }}">
                        {{ trans('nav.currencies') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Page::class)
                    <li class=" {{ Request::is('admin/utility/page*') ? 'active' : '' }}">
                      <a href="{{ url('admin/utility/page') }}">
                        {{ trans('nav.pages') }}
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Blog::class)
                    <li class=" {{ Request::is('admin/utility/blog*') ? 'active' : '' }}">
                      <a href="{{ url('admin/utility/blog') }}">
                        <span>{{ trans('nav.blogs') }}</span>
                      </a>
                    </li>
                  @endcan

                  @can('index', \App\Faq::class)
                    <li class=" {{ Request::is('admin/utility/faq*') ? 'active' : '' }}">
                      <a href="{{ url('admin/utility/faq') }}">
                        {{ trans('nav.faqs') }}
                      </a>
                    </li>
                  @endcan
                </ul>
              </div>
            </li>
          @endif

          <!-- Disputes -->
          @if(Gate::allows('index', \App\Message::class) || Gate::allows('index', \App\Ticket::class) || Gate::allows('index', \App\Dispute::class) || Gate::allows('index', \App\Refund::class))
            <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="shippingMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Support Desk
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul class="treeview-menu">
                @can('index', \App\Message::class)
                  <li class=" {{ Request::is('admin/support/message*') ? 'active' : '' }}">
                    <a href="{{ url('admin/support/message/labelOf/'. \App\Message::LABEL_INBOX) }}">
                      {{ trans('nav.support_messages') }}
                    </a>
                  </li>
                @endcan

                @if(Auth::user()->isFromPlatform())
                  @can('index', \App\Ticket::class)
                    <li class=" {{ Request::is('admin/support/ticket*') ? 'active' : '' }}">
                      <a href="{{ url('admin/support/ticket') }}">
                        {{ trans('nav.support_tickets') }}
                      </a>
                    </li>
                  @endcan
                @endif

                @can('index', \App\Dispute::class)
                  <li class=" {{ Request::is('admin/support/dispute*') ? 'active' : '' }}">
                    <a href="{{ url('admin/support/dispute') }}">
                      {{ trans('nav.disputes') }}
                    </a>
                  </li>
                @endcan

                @can('index', \App\Refund::class)
                  <li class=" {{ Request::is('admin/support/refund*') ? 'active' : '' }}">
                    <a href="{{ url('admin/support/refund') }}">
                      {{ trans('nav.refunds') }}
                    </a>
                  </li>
                @endcan
                  </ul>
                </div>
              </li>
          @endif

          <!-- Settings -->
            <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="shippingMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Settings
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul class="treeview-menu">
                    @can('index', \App\SubscriptionPlan::class)
                      <li class=" {{ Request::is('admin/setting/subscriptionPlan*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/subscriptionPlan') }}">
                          {{ trans('nav.subscription_plans') }}
                        </a>
                      </li>
                    @endcan

                    @can('index', \App\Role::class)
                      <li class=" {{ Request::is('admin/setting/role*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/role') }}">
                          {{ trans('nav.user_roles') }}
                        </a>
                      </li>
                    @endcan

                    @can('index', \App\Tax::class)
                      <li class=" {{ Request::is('admin/setting/tax*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/tax') }}">
                          {{ trans('nav.taxes') }}
                        </a>
                      </li>
                    @endcan

                    @can('index', \App\EmailTemplate::class)
                      <li class=" {{ Request::is('admin/setting/emailTemplate*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/emailTemplate') }}">
                          {{ trans('nav.email_templates') }}
                        </a>
                      </li>
                    @endcan

                    @can('view', \App\Config::class)
                      <li class=" {{ Request::is('admin/setting/general*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/general') }}">
                          {{ trans('nav.general') }}
                        </a>
                      </li>

                      <li class=" {{ Request::is('admin/setting/config*') || Request::is('admin/setting/verify*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/config') }}">
                          {{ trans('nav.config') }}
                        </a>
                      </li>

                      <li class=" {{ Request::is('admin/setting/paymentMethod*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/paymentMethod') }}">
                          {{ trans('nav.payment_methods') }}
                        </a>
                      </li>
                    @endcan

                    @can('view', \App\System::class)
                      <li class=" {{ Request::is('admin/setting/system/general*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/system/general') }}">
                          {{ trans('nav.system_settings') }}
                        </a>
                      </li>
                    @endcan

                    @can('view', \App\SystemConfig::class)
                      <li class=" {{ Request::is('admin/setting/system/config*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/system/config') }}">
                          {{ trans('nav.config') }}
                        </a>
                      </li>
                    @endcan

                    @if(Auth::user()->isAdmin())
                      <li class=" {{ Request::is('admin/setting/announcement*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/announcement') }}">
                          {{ trans('nav.announcements') }}
                        </a>
                      </li>
                    @endif

                    @if(Auth::user()->isAdmin())
                      <li class=" {{ Request::is('admin/setting/language*') ? 'active' : '' }}">
                        <a href="{{ url('admin/setting/language') }}">
                          {{ trans('app.languages') }}
                        </a>
                      </li>
                    @endif
                  </ul>
              </div>
            </li>
          
          <!-- Reports -->
          <li class="nav-item {{ Request::is('admin/order*') ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" type="button" id="shippingMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reports
                <i class="fa fa-angle-down pull-right"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <ul class="treeview-menu">
                  @if(Auth::user()->isAdmin())
                    <li class=" {{ Request::is('admin/report/kpi*') ? 'active' : '' }}">
                      <a href="{{ route('admin.kpi') }}">
                        {{ trans('nav.performance') }}
                      </a>
                    </li>
                    <li class=" {{ Request::is('admin/report/visitors*') ? 'active' : '' }}">
                      <a href="{{ route('admin.report.visitors') }}">
                        {{ trans('nav.visitors') }}
                      </a>
                    </li>
                  @elseif(Auth::user()->isMerchant())
                    <li class=" {{ Request::is('admin/shop/report/kpi*') ? 'active' : '' }}">
                      <a href="{{ route('admin.shop-kpi') }}">
                        {{ trans('nav.performance') }}
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </li>

        </ul>
      </div>
    @endif







    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages Menu-->
        <li class="dropdown messages-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            @if($count_message = $unread_messages->count())
              <span class="label label-success">{{ $count_message }}</span>
            @endif
          </a>
          <ul class="dropdown-menu">
            <li class="header">{{ trans('messages.message_count', ['count' => $count_message]) }}</li>
            <li>
              <ul class="menu">
                @forelse($unread_messages as $message)
                  @continue($loop->index > 5)
                  <li><!-- start message -->
                    <a href="{{ route('admin.support.message.show', $message) }}">
                      <div class="pull-left">
                        <img src="{{ get_avatar_src($message->customer, 'tiny') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
                      </div>
                      <h4>
                        {!! $message->subject !!}
                        <small><i class="fa fa-clock-o"></i> {{ $message->created_at->diffForHumans() }}</small>
                      </h4>

                      <p>
                        {!! str_limit($message->message, 100) !!}
                      </p>
                    </a>
                  </li>
                @endforeach
              </ul><!-- /.menu -->
            </li>
            <li class="footer"><a href="{{ url('admin/support/message/labelOf/'. App\Message::LABEL_INBOX) }}">{{ trans('app.go_to_msg_inbox') }}</a></li>
          </ul>
        </li><!-- /.messages-menu -->

        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu" id="notifications-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            @if($count_notification = Auth::user()->unreadNotifications->count())
              <span class="label label-warning">{{ $count_notification }}</span>
            @endif
          </a>
          <ul class="dropdown-menu">
            <li class="header">{{ trans('messages.notification_count', ['count' => $count_notification]) }}</li>
            <li>
              <ul class="menu">
                @foreach(Auth::user()->unreadNotifications as $notification)
                  <li>
                    @php
                      $notification_view = 'admin.partials.notifications.' . snake_case(class_basename($notification->type));
                    @endphp

                    @includeFirst([$notification_view, 'admin.partials.notifications.default'])
                  </li>
                @endforeach
              </ul><!-- .menu -->
            </li>
            <li class="footer"><a href="{{ route('admin.notifications') }}">{{ trans('app.view_all_notifications') }}</a></li>
          </ul>
        </li><!-- /.notifications-menu -->

        <!-- Announcement Menu -->
        @if($active_announcement)
          <li class="dropdown tasks-menu" id="announcement-dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bullhorn"></i>
              @if($active_announcement && $active_announcement->updated_at > Auth::user()->read_announcements_at)
                <span class="label"><i class="fa fa-circle"></i></span>
              @endif
            </a>
            <ul class="dropdown-menu">
              <li>
                {!! $active_announcement->parsed_body !!}
                @if($active_announcement->action_url)
                  <span class="indent10">
                    <a href="{{ $active_announcement->action_url }}" class="btn btn-flat btn-default btn-xs">{{ $active_announcement->action_text }}</a>
                  </span>
                @endif
              </li>
            </ul>
          </li><!-- /.notifications-menu -->
        @endif

        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if(Auth::user()->image)
              <img src="{{ get_storage_file_url(Auth::user()->image->path, 'tiny') }}" class="user-image" alt="{{ trans('app.avatar') }}">
            @else
              <img src="{{ get_gravatar_url(Auth::user()->email, 'tiny') }}" class="user-image" alt="{{ trans('app.avatar') }}">
            @endif
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{ ($Tname = Auth::user()->getName()) ? $Tname : trans('app.welcome') }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              @if(Auth::user()->image)
                <img src="{{ get_storage_file_url(Auth::user()->image->path, 'small') }}" class="user-image" alt="{{ trans('app.avatar') }}">
              @else
                <img src="{{ get_gravatar_url(Auth::user()->email, 'small') }}" class="user-image" alt="{{ trans('app.avatar') }}">
              @endif

              <h4>{{Auth::user()->name}}</h4>
              <p>
                @if(Auth::user()->isSuperAdmin())
                  {{ trans('app.super_admin') }}
                @else
                  @if(Auth::user()->isFromPlatform())
                    {{ Auth::user()->role->name }}
                  @elseif(Auth::user()->isMerchant())
                    {{ Auth::user()->owns ? Auth::user()->owns->name : Auth::user()->role->name }}
                  @else
                    {{ Auth::user()->role->name . ' | ' . Auth::user()->shop->name }}
                  @endif
                @endif

                <small>{{ trans('app.member_since') . ' ' . Auth::user()->created_at->diffForHumans() }}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ route('admin.account.profile') }}" class="btn btn-default btn-flat"><i class="fa fa-user"></i> {{ trans('app.account') }}</a>
              </div>
              <div class="pull-right">
                <a href="{{ Request::session()->has('impersonated') ? route('admin.secretLogout') : route('logout') }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> {{ trans('app.log_out') }}</a>
              </div>
            </li>
          </ul>
        </li><!-- /.user-menu -->

        <!-- Control Sidebar Toggle Button -->
        <li>
          {{-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> --}}
        </li>
      </ul>
    </div>
  </nav>
</header>