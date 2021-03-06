@extends('shopper::layouts.'. config('shopper.theme'))
@section('title', __('Inventories') . ' ' . $inventory->name)

@section('content')

	<x:breadcrumb back="shopper.settings.inventories.index">
		<svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
			<path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
		</svg>
		<a href="{{ route('shopper.settings.inventories.index') }}" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:underline transition duration-150 ease-in-out">{{ __('Inventories') }}</a>
	</x:breadcrumb>

	<div class="mt-6 md:flex md:items-center md:justify-between">
		<div class="flex-1 min-w-0">
			<h2 class="text-2xl font-bold leading-7 text-gray-600 sm:text-3xl sm:leading-9 sm:truncate">{{ $inventory->name }}</h2>
		</div>
	</div>

	{!! Form::model($inventory, ['route' => ['shopper.settings.inventories.update', $inventory], 'method' => 'put']) !!}
		<div class="mt-8">
			<div class="md:grid md:grid-cols-3 md:gap-6">
				<div class="md:col-span-1">
					<div class="px-4 sm:px-0">
						<h3 class="text-lg font-medium leading-6 text-gray-700">{{ __("Details") }}</h3>
						<p class="mt-1 text-sm leading-5 text-gray-500">
							{{ __("Give this location a short name to make it easy to identify. You’ll see this name in areas like products.") }}
						</p>
					</div>
				</div>
				<div class="mt-5 md:mt-0 md:col-span-2">
					<div class="shadow sm:rounded-md sm:overflow-hidden">
						<div class="px-4 py-5 bg-white sm:p-6">
							<div class="grid grid-cols-1 gap-6">
								<div>
									<label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Inventory Name") }}</label>
									<div class="relative mt-1">
										{!! Form::text('name', null, [
                                                'class' => 'form-input form-input-shopper block w-full sm:text-sm sm:leading-5',
                                                'placeholder' => __('e.g.: Douala, BP Cité Stock'),
                                                'id' => 'name',
											    'autocomplete' => 'off'
											])
										!!}
									</div>
								</div>
								@if($inventory->is_default)
									<div class="rounded-md bg-blue-50 p-4">
										<div class="flex">
											<div class="flex-shrink-0">
												<svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
													<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
												</svg>
											</div>
											<div class="ml-3 flex-1 md:flex md:justify-between">
												<p class="text-sm leading-5 text-blue-700">
													{{ __("This is your default inventory. To change whether you fulfill online orders from this inventory, select another default inventory first.") }}
												</p>
											</div>
										</div>
									</div>
                                @else
                                    <div class="px-3 py-2.5 bg-blue-50 rounded-md text-blue-600 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <span class="h-8 w-8 flex items-center justify-center rounded-md bg-blue-600 flex-shrink-0">
                                                <svg class="h-6 w-6 text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </span>
                                            <span class="font-semibold ml-3 text-sm">{{ __("Set Default inventory") }}</span>
                                        </div>
                                        <div>
                                            <span role="checkbox" tabindex="0" x-data="{ on: @if($inventory->is_default) true @else false @endif }" x-on:click="$dispatch('input', !on); on = !on" @keydown.space.prevent="on = !on" :aria-checked="on.toString()" aria-checked="false" x-bind:class="{ 'bg-gray-100': !on, 'bg-blue-600': on }" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline-blue bg-gray-200">
                                                <input type="hidden" x-ref="input" name="is_default" aria-label="Visible" x-model="on" />
                                                <span aria-hidden="true" x-bind:class="{ 'translate-x-5': on, 'translate-x-0': !on }" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200 translate-x-0"></span>
                                            </span>
                                        </div>
                                    </div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="hidden sm:block">
			<div class="py-5">
				<div class="border-t border-gray-200"></div>
			</div>
		</div>
		
		<div class="mt-10 sm:mt-0">
			<div class="md:grid md:grid-cols-3 md:gap-6">
				<div class="md:col-span-1">
					<div class="px-4 sm:px-0">
						<h3 class="text-lg font-medium leading-6 text-gray-900">{{ __("Address") }}</h3>
						<p class="mt-1 text-sm leading-5 text-gray-600">
							{{ __("Your inventory's complete information.") }}
						</p>
					</div>
				</div>
				<div class="mt-5 md:mt-0 md:col-span-2">
					<div class="shadow sm:rounded-md">
						<div class="px-4 py-5 bg-white sm:p-6">
							<div class="grid grid-cols-6 gap-6">
								<div class="col-span-6">
									<label for="street" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Address") }}</label>
									<div class="mt-1 relative">
										{!! Form::text('street', null, [
												'class' => 'form-input block w-full sm:text-sm sm:leading-5 transition ease-in-out duration-150',
												'id' => 'street',
												'autocomplete' => 'off',
												'placeholder' => __("Your inventory full address...")
											])
										!!}
									</div>
									@error('street')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
								</div>
				
								<div class="col-span-6">
									<label for="email" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Email") }}</label>
									<div class="relative mt-1">
										{!! Form::email('email', null, [
												'class' => 'form-input form-input-shopper block w-full sm:text-sm sm:leading-5',
												'id' => 'email',
											    'autocomplete' => 'off'
											])
										!!}
									</div>
									@error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
								</div>
				
								<div class="col-span-6">
									<label for="country" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Country / Region") }}</label>
									<div id="country-selector" class="mt-1" data-value="{{ $inventory->country }}"></div>
								</div>
				
								<div class="col-span-6 sm:col-span-3">
									<label for="city" class="block text-sm font-medium leading-5 text-gray-700">{{ __("City") }}</label>
									<div class="relative mt-1">
										{!! Form::text('city', null, [
												'class' => 'form-input form-input-shopper block w-full sm:text-sm sm:leading-5',
												'id' => 'city',
											    'autocomplete' => 'off'
											])
										!!}
									</div>
									@error('city')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
								</div>
				
								<div class="col-span-6 sm:col-span-3">
									<label for="postcode" class="block text-sm font-medium leading-5 text-gray-700">{{ __("ZIP / Postal") }}</label>
									<div class="relative mt-1">
										{!! Form::text('postcode', null, [
												'class' => 'form-input form-input-shopper block w-full sm:text-sm sm:leading-5',
												'id' => 'postcode',
											    'autocomplete' => 'off'
											])
										!!}
									</div>
								</div>

								<div class="col-span-6">
                                    <label for="phone" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Phone number") }}</label>
                                    <div class="mt-1 relative">
                                        {!! Form::tel('phone_number', null, [
                                                'class' => 'form-input block w-full sm:text-sm sm:leading-5 transition duration-150 ease-in-out pr-10',
                                                'id' => 'phone',
                                                'autocomplete' => 'off'
                                            ])
                                        !!}
                                        @error('phone_number')
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @enderror
                                    </div>
                                    @error('phone_number')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="mt-8 border-t pt-5 border-gray-200">
            <div class="flex justify-between">
                <x:delete-action
                    :title="$inventory->name"
                    action="inventory"
                    message="Are you sure you want to delete this inventory? All this data will be removed. This action cannot be undone."
                    :url="route('shopper.settings.inventories.destroy', $inventory)"
                />
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-brand-500 hover:bg-brand-600 focus:outline-none focus:border-brand-700 focus:shadow-outline-brand active:bg-brand-700 transition ease-in-out duration-150">{{ __('Update') }}</button>
            </div>
        </div>

	{!! Form::close() !!}

@endsection

@push('scripts')
    <script>
      {{--var free = @json($course->free);--}}
      {{--var type = @json($type);--}}
      {{--var dateShow = @json($dateShow);--}}

      {{--function display() {--}}
      {{--  return {--}}
      {{--    open: false,--}}
      {{--    value: free,--}}
      {{--    on: type,--}}
      {{--    toggle() {--}}
      {{--      return this.value = !this.value--}}
      {{--    },--}}
      {{--    toggleType() {--}}
      {{--      return this.on = !this.on--}}
      {{--    },--}}
      {{--  }--}}
      {{--}--}}
    </script>
@endpush
