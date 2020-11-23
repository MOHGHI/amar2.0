<!-- Main Footer -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
  	@if(auth()->user()->isSuperAdmin())
	    Version: {{ \App\System::VERSION }}</a>
  	@else
	  	<span>{{ 'Today is' . ' ' . date('l M-j, Y')}}</span>
  	@endif
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; {{date('Y') }} {{ config('system_settings.name') ?: config('app.name') }}.</strong> All rights reserved.
</footer>