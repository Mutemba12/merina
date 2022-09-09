@extends('layouts.front')
@section('content')

  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <ul class="pages">
              <li>
                <a href="{{ route('front.index') }}">
                  {{ __('Home') }}
                </a>
              </li>
              <li>
                <a href="{{ route('user-dashboard') }}">
                  {{ __('Dashboard') }}
                </a>
              </li>
              <li class="active">
                  <a href="{{ route('user-favorites') }}">
                    {{ __('Favorite Sellers') }}
                  </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Area End -->


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('partials.user.dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area d-flex align-items-center">
								<h4 class="title">{{ __('Favorite Sellers') }}</h4>          
							</div>
							<div class="mr-table allproduct message-area  mt-4">
								@include('alerts.form-success')
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __('Shop Name') }}</th>
														<th>{{ __('Owner Name') }}</th>
														<th>{{ __('Address') }}</th>
														<th>{{ __('Actions') }}</th>
													</tr>
												</thead>
												<tbody>
                        @foreach($favorites as $vendor)
                          @php
                            $seller = App\Models\User::findOrFail($vendor->vendor_id);
                          @endphp

                          <tr class="conv">
                            
                            <td>{{$seller->shop_name}}</td>
                            <td>{{$seller->owner_name}}</td>
                            <td>{{$seller->shop_address}}</td>

                            <td>
                              <a target="_blank" href="{{route('front.vendor',str_replace(' ', '-',($seller->shop_name)))}}" class="link view"><i class="fa fa-eye"></i></a>
                              <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" data-href="{{route('user-favorite-delete',$vendor->id)}}" class="link remove"><i class="fa fa-trash"></i></a>
                            </td>

                          </tr>
                        @endforeach
												</tbody>
											</table>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ __('Confirm Delete ?') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

                <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Seller.') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

<script type="text/javascript">

(function($) {
		"use strict";

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

})(jQuery);

</script>

@endsection