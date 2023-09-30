@extends('layout.empty')

@section('title', 'Customer Order')

@push('js')
  <script src="{{URL::asset('assets/js/demo/pos-customer-order.demo.js')}}"></script>
@endpush

@php ($storeName = session()->get('sessStoreName'))

@section('content')
	<!-- BEGIN pos -->
	<div class="pos pos-with-menu pos-with-sidebar" id="pos">
		<div class="pos-container">
			<!-- BEGIN pos-menu -->
			<div class="pos-menu">
				<!-- BEGIN logo -->
				<div class="logo">
					<a href="{{ url('/')}}">
						<div class="logo-img"><i class="fa fa-bowl-rice"></i></div>
						<div class="logo-text text-center">{{$storeName}}</div>
					</a>
				</div>
				<!-- END logo -->
				<!-- BEGIN nav-container -->
				<div class="nav-container">
					<div class="h-100" data-scrollbar="true" data-skip-mobile="true">
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a class="nav-link active" href="#" data-filter="all">
									<i class="fa fa-fw fa-utensils"></i> All Dishes
								</a>
							</li>
							@foreach ($categories as $category_id)
								<li class="nav-item">
									<a class="nav-link" href="#" data-filter="{{$category_id}}">
										<i class="fa fa-fw fa-utensils"></i> {{$category_id}}
									</a>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
				<!-- END nav-container -->
			</div>
			<!-- END pos-menu -->
		
			<!-- BEGIN pos-content -->
			<div class="pos-content">
				<div class="pos-content-container h-100">
					<input type="text" id="myInput" class="w-100 mb-4 p-3" style="border-radius: 6px; background:var(--bs-app-header-input-bg);" onkeyup="searchMenu()" placeholder="Search Menu">
					<div class="row gx-4" id="myItems">

						@foreach ($menus as $menu)
						@if ($menu->getIsactive() === true)
						<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 pb-4" data-type="{{$menu->getCategoryname()}}">
								@if ($menu->getIsavailable() === true)
								<a href="#" class="pos-product" data-bs-toggle="modal" data-bs-target="#modalPosItem{{$menu->getMenuid()}}">
									<div class="img" style="background-image: url(/assets/img/pos/product-1.jpg)"></div>
									<div class="info">
										<div class="title">{{$menu->getName()}}</div>
										<div class="desc">{{$menu->getDescription()}}</div>
										<div class="price">Rp. {{number_format($menu->getPrice())}}</div>
									</div>
								</a>
								@else
								<div class="pos-product not-available">
									<div class="img" style="background-image: url(/assets/img/pos/product-1.jpg)"></div>
									<div class="info">
										<div class="title">{{$menu->getName()}}</div>
										<div class="desc">{{$menu->getDescription()}}</div>
										<div class="price">Rp.{{$menu->getPrice()}}</div>
									</div>
									<div class="not-available-text">
										<div>Not Available</div>
									</div>
								</div>
								@endif
							</div>
						@endif
						@endforeach

					</div>
				</div>
			</div>
			<!-- END pos-content -->
		
			<!-- BEGIN pos-sidebar -->
			<div class="pos-sidebar" id="pos-sidebar">
				<div class="h-100 d-flex flex-column p-0">
					<div class="d-flex">
						<button class="btn btn-dark flex-1" onclick="window.location.href='{{ url('/pos/customer-order-list')}}'" type="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fas fa-arrow-left"></i>	other order
						</button>
						
						<button class="pos-mobile-sidebar-toggler-top btn btn-danger" data-toggle-class="pos-mobile-sidebar-toggled" data-toggle-target="#pos">
							<i class="far fa-window-close"></i>
						</button>
					</div>
					<!-- BEGIN pos-sidebar-header -->
					<div class="pos-sidebar-header">
						<div class="dropdown mx-auto d-flex" style="flex-direction: column">
							<button class="btn btn-dark disabled" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-order-id="{{$result->getInfo()[0]->getOrderid()}}" id="order_id">
							  Order id : {{$result->getInfo()[0]->getOrderid()}}
							</button>
							<button class="btn btn-dark disabled" type="button" data-bs-toggle="dropdown" aria-expanded="false">
							  Cust name : {{$result->getInfo()[0]->getCustomer()}}
							</button>
						</div>
					</div>
					<!-- END pos-sidebar-header -->
				
					<!-- BEGIN pos-sidebar-nav -->
					<div class="pos-sidebar-nav small">
						<ul class="nav nav-tabs nav-fill">
							<li class="nav-item">
								<a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#orderHistoryTab">Order History ({{count($result->getDetail())}})</a>
							</li>
						</ul>
					</div>
					<!-- END pos-sidebar-nav -->
				
					<!-- BEGIN pos-sidebar-body -->
					<div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">
						<!-- BEGIN #newOrderTab -->
						{{-- <div class="tab-pane fade h-100 show active" id="newOrderTab">
							<!-- BEGIN pos-order -->
							<div class="pos-order">
								<div class="pos-order-product">
									<div class="img" style="background-image: url(/assets/img/pos/product-2.jpg)"></div>
									<div class="flex-1">
										<div class="h6 mb-1">Grill Pork Chop</div>
										<div class="small">$12.99</div>
										<div class="small mb-2">- size: large</div>
										<div class="d-flex">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-minus"></i></a>
											<input type="text" class="form-control w-50px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center" value="01">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></a>
										</div>
									</div>
								</div>
								<div class="pos-order-price d-flex flex-column">
									<div class="flex-1">$12.99</div>
									<div class="text-end">
										<a href="#" class="btn btn-default btn-sm btn-trash" type="button"><i class="fa fa-trash"></i></a>
									</div>
								</div>
							</div>
							<!-- END pos-order -->
							<!-- BEGIN pos-order -->
							<div class="pos-order">
								<div class="pos-order-product">
									<div class="img" style="background-image: url(/assets/img/pos/product-8.jpg)"></div>
									<div class="flex-1">
										<div class="h6 mb-1">Orange Juice</div>
										<div class="small">$5.00</div>
										<div class="small mb-2">
											- size: large<br>
											- less ice
										</div>
										<div class="d-flex">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-minus"></i></a>
											<input type="text" class="form-control w-50px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center" value="02">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></a>
										</div>
									</div>
								</div>
								<div class="pos-order-price d-flex flex-column">
									<div class="flex-1">$10.00</div>
									<div class="text-end">
										<a href="#" class="btn btn-default btn-sm btn-trash" type="button"><i class="fa fa-trash"></i></a>
									</div>
								</div>
							</div>
							<!-- END pos-order -->
							<!-- BEGIN pos-order -->
							<div class="pos-order">
								<div class="pos-order-product">
									<div class="img" style="background-image: url(/assets/img/pos/product-1.jpg)"></div>
									<div class="flex-1">
										<div class="h6 mb-1">Grill chicken chop</div>
										<div class="small">$10.99</div>
										<div class="small mb-2">
											- size: large<br>
											- spicy: medium
										</div>
										<div class="d-flex">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-minus"></i></a>
											<input type="text" class="form-control w-50px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center" value="01">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></a>
										</div>
									</div>
								</div>
								<div class="pos-order-price d-flex flex-column">
									<div class="flex-1">$10.99</div>
									<div class="text-end">
										<a href="#" class="btn btn-default btn-sm btn-trash" type="button"><i class="fa fa-trash"></i></a>
									</div>
								</div>
							</div>
							<!-- END pos-order -->
							<!-- BEGIN pos-order -->
							<div class="pos-order">
								<div class="pos-order-product">
									<div class="img" style="background-image: url(/assets/img/pos/product-5.jpg)"></div>
									<div class="flex-1">
										<div class="h6 mb-1">Hawaiian Pizza</div>
										<div class="small">$15.00</div>
										<div class="small mb-2">
											- size: large<br>
											- more onion
										</div>
										<div class="d-flex">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-minus"></i></a>
											<input type="text" class="form-control w-50px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center" value="01">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></a>
										</div>
									</div>
								</div>
								<div class="pos-order-price d-flex flex-column">
									<div class="flex-1">$15.00</div>
									<div class="text-end">
										<a href="#" class="btn btn-default btn-sm btn-trash" type="button"><i class="fa fa-trash"></i></a>
									</div>
								</div>
								<div class="pos-order-confirmation text-center d-flex flex-column justify-content-center">
									<div class="mb-1">
										<i class="fa fa-trash fs-36px lh-1 text-body text-opacity-25"></i>
									</div>
									<div class="mb-2">Remove this item?</div>
									<div>
										<a href="#" type="button" class="btn btn-default btn-sm ms-auto btn-trash-cancel me-2 width-100px">No</a>
										<a href="#" class="btn btn-danger btn-sm width-100px">Yes</a>
									</div>
								</div>
							</div>
							<!-- END pos-order -->
							<!-- BEGIN pos-order -->
							<div class="pos-order">
								<div class="pos-order-product">
									<div class="img" style="background-image: url(/assets/img/pos/product-10.jpg)"></div>
									<div class="flex-1">
										<div class="h6 mb-1">Mushroom Soup</div>
										<div class="small">$3.99</div>
										<div class="small mb-2">
											- size: large<br>
											- more cheese
										</div>
										<div class="d-flex">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-minus"></i></a>
											<input type="text" class="form-control w-50px form-control-sm mx-2 bg-white bg-opacity-25 bg-white bg-opacity-25 text-center" value="01">
											<a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></a>
										</div>
									</div>
								</div>
								<div class="pos-order-price d-flex flex-column">
									<div class="flex-1">$3.99</div>
									<div class="text-end">
										<a href="#" class="btn btn-default btn-sm btn-trash" type="button"><i class="fa fa-trash"></i></a>
									</div>
								</div>
							</div>
							<!-- END pos-order -->
						</div>
						<!-- END #orderHistoryTab --> --}}
					
						<!-- BEGIN #orderHistoryTab -->
						<div class="tab-pane fade h-100 show active" id="orderHistoryTab">
							@if (count($result->getDetail()) == 0)
							<div class="h-100 d-flex align-items-center justify-content-center text-center p-20">
								<div>
									<div class="mb-3 mt-n5">
										<svg width="6em" height="6em" viewBox="0 0 16 16" class="text-gray-300" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z"/>
											<path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z"/>
										</svg>
									</div>
									<h5>No order history found</h5>
								</div>
							</div>
							@else	
								@foreach ($result->getDetail() as $detail)
								<div class="pos-order">
									<div class="pos-order-product" id="parent{{$detail->getMenuid()}}">
										<div class="img" style="background-image: url(/assets/img/pos/product-1.jpg)"></div>
										<div class="flex-1">
											<div class="d-flex">
												@if (count($detail->getAddonname()) == 0)
												<div class="h6 mb-1">{{$detail->getMenu()}}</div>
												@else
												<div class="h6 mb-1">{{$detail->getMenu()}} (Addon)</div>
												@endif
												<div class="flex-1 text-end" data-onesPrice="{{$detail->getPrice()}}" name="qtyOrderHistory{{$detail->getMenuid()}}price">Rp. {{number_format($detail->getSubtotal())}}</div>
											</div>
											<div class="small">Rp. {{number_format($detail->getPrice())}}</div>
											@if (count($detail->getAddonname()) == 0)
												<div class="small mb-2">-</div>
											@else
												<div class="small mb-2">
													<p>
													@foreach ($detail->getAddonname() as $addon)
														{{$addon}}, 
													@endforeach
													</p>
												</div>
											@endif
											<div class="d-flex">
												<button type="reset" data-field="qtyOrderHistory{{$detail->getMenuid()}}" class="btn btn-secondary btn-sm me-2 btn-cancel"><i class="fa fa-undo"></i></button>
												<button class="btn btn-secondary btn-number" data-type="minus" data-field="qtyOrderHistory{{$detail->getMenuid()}}"><i class="fa fa-minus"></i></button>
												<input type="text" class="form-control w-50px fw-bold mx-2 text-center input-number" min="1" max="@foreach ($menus as $menu)
													@if ($menu->getMenuid() == $detail->getMenuid())
														{{ $menu->getStock() }}
													@endif
												@endforeach" id="qtyOrderHistory{{$detail->getMenuid()}}" name="qtyOrderHistory{{$detail->getMenuid()}}" data-initialValue="{{$detail->getAmount()}}" value="{{$detail->getAmount()}}">
												<button class="btn btn-secondary btn-number" data-type="plus" data-field="qtyOrderHistory{{$detail->getMenuid()}}"><i class="fa fa-plus"></i></button>
												<a href="#" id="cancel{{$detail->getMenuid()}}" class="btn btn-default btn-sm btn-trash ms-2" type="button"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							@endif
							
						</div>
						<!-- END #orderHistoryTab -->
					</div>
					<!-- END pos-sidebar-body -->
				
					<!-- BEGIN pos-sidebar-footer -->
					<div class="pos-sidebar-footer">
						<div class="d-flex align-items-center mb-2">
							<div>Subtotal</div>
							<div class="flex-1 text-end h6 mb-0">Rp. {{number_format($result->getInfo()[0]->getTotal())}}</div>
						</div>
						<div class="d-flex align-items-center">
							@if ($result->getInfo()[0]->getGrandtotal() == 0)
								<div>Taxes (11%)</div>
								<div class="flex-1 text-end h6 mb-0">Rp. {{number_format($result->getInfo()[0]->getTax())}}</div>
							@else
								
								<div>Taxes ({{number_format(($result->getInfo()[0]->getGrandtotal() / ($result->getInfo()[0]->getTotal() + $result->getInfo()[0]->getService()) - 1) * 100)}}%)</div>
								<div class="flex-1 text-end h6 mb-0">Rp. {{number_format($result->getInfo()[0]->getTax())}}</div>
							@endif
						</div>
						<hr class="opacity-1 my-10px">
						<div class="d-flex align-items-center mb-2">
							<div>Total</div>
							<div class="flex-1 text-end h4 mb-0">Rp. {{number_format($result->getInfo()[0]->getGrandtotal())}}</div>
						</div>
						<div class="mt-3">
							<div class="d-flex">
								<a href="#" class="btn btn-theme flex-fill d-flex align-items-center justify-content-center">
									<span>
										<i class="fa fa-cash-register fa-lg my-10px d-block"></i>
										<span class="small fw-semibold">Close Order</span>
									</span>
								</a>
							</div>
						</div>
					</div>
					<!-- END pos-sidebar-footer -->
				</div>
			</div>
			<!-- END pos-sidebar -->
		</div>
	</div>
	<!-- END pos -->
	
	<!-- BEGIN pos-mobile-sidebar-toggler -->
	<a href="#" class="pos-mobile-sidebar-toggler" data-toggle-class="pos-mobile-sidebar-toggled" data-toggle-target="#pos">
		<i class="fa fa-shopping-bag"></i>
		@if (count($result->getDetail()) > 0)
		<span class="badge">{{count($result->getDetail())}}</span>
		@else
			
		@endif
	</a>
	<!-- END pos-mobile-sidebar-toggler -->
	
	<!-- BEGIN #modalPosItem -->
	@foreach ($menus as $menukey => $menu)
		@if ($menu->getIsavailable() === true)
		<div class="modal modal-pos fade" id="modalPosItem{{$menu->getMenuid()}}">
			<div class="modal-dialog modal-lg">
				<div class="modal-content border-0">
					<a href="#" data-bs-dismiss="modal" class="btn-close position-absolute top-0 end-0 m-4"></a>
					<div class="modal-pos-product">
						<div class="modal-pos-product-img">
							<div class="img" style="background-image: url(/assets/img/pos/product-1.jpg)"></div>
						</div>
						<div class="modal-pos-product-info">
							<div class="fs-4 fw-semibold">{{$menu->getName()}}</div>
							<div class="text-body text-opacity-50 mb-2">
								{{$menu->getDescription()}}
							</div>
							<div class="fs-3 fw-bold mb-3 add-order-detail" data-price="{{$menu->getPrice()}}" name="qtyToCart{{$menu->getMenuid()}}">Rp. {{number_format($menu->getPrice())}}</div>

							<form action="#" class="formAddToCart" id="formCart{{$menu->getMenuid()}}" method="POST">
							@csrf
							<div class="d-flex mb-3">
								<input type="hidden" name="order_id" value="{{$result->getInfo()[0]->getOrderid()}}">
								<input type="hidden" name="menu_id" value="{{$menu->getMenuid()}}">

								<button class="btn btn-secondary btn-number" data-type="minus" data-field="qtyToCart{{$menu->getMenuid()}}"><i class="fa fa-minus"></i></button>
								<input type="text" class="form-control w-50px fw-bold mx-2 text-center input-number" min="1" max="{{$menu->getStock()}}" data-target="qtyToCart{{$menu->getMenuid()}}" name="qtyToCart" value="1">
								<button class="btn btn-secondary btn-number" data-type="plus" data-field="qtyToCart{{$menu->getMenuid()}}"><i class="fa fa-plus"></i></button>
							</div>

							<div class="fs-3 fw-bold mb-3 add-order-detail" name="qtyToCart{{$menu->getMenuid()}}price" id="">Rp. {{number_format($menu->getPrice())}}</div>
							<hr class="opacity-1">
							<div class="mb-2">
								@if (count($menu->getAddon()) == 0)
									
								@else
								<div class="fw-bold">Add On:</div>
								<div class="option-list">
									@foreach ($menu->getAddon() as $addon)
									<div class="option">
										<input type="hidden" class="check_addon" id="check_addon_{{$menu->getMenuid()}}|{{$addon->getAddonid()}}" value="off">
										<input type="checkbox" data-price="{{$addon->getAddonprice()}}" name="addon_{{$menu->getMenuid()}}|{{$addon->getAddonid()}}" data-menu="{{$menu->getMenuid()}}" value="true" class="option-input addon-checkbox" id="addon_{{$menu->getMenuid()}}|{{$addon->getAddonid()}}">

										<label class="option-label" for="addon_{{$menu->getMenuid()}}|{{$addon->getAddonid()}}">
											<span class="option-text">{{$addon->getAddonname()}}</span>
											<span class="option-price">+Rp. {{number_format($addon->getAddonprice())}}</span>
										</label>
									</div>
									@endforeach
								</div>
								@endif
							</div>
							<hr class="opacity-1">
							<div class="row">
								<div class="col-4">
									<a href="#" class="btn btn-default fw-semibold mb-0 d-block py-3" data-bs-dismiss="modal">Cancel</a>
								</div>
								<div class="col-8">
									<button type="submit" class="btn btn-theme fw-semibold d-flex justify-content-center align-items-center py-3 m-0 buttonAddCart" id="buttonCart{{$menu->getMenuid()}}">Add to cart <i class="fa fa-plus ms-2 my-n3"></i></button>
								</div>
							</div>
							</form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	@endforeach
	<!-- END #modalPosItem -->
@endsection
