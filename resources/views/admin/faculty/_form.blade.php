@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif


		<div class="row">
			<div class="col-12">
				<div class="ml-auto">
					<h3>1. Faculty info</h3>
				</div>
			</div>

			<div class="form-group col-12">
				<label class="col-form-label">Faculty Name</label>
				<div>
					<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name',$faculty->name)}}">
					@error('name')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>
			<div class="form-group col-12">
				<label class="col-form-label">Faculty Description</label>
				<div>
					<input class="form-control @error('description') is-invalid @enderror" type="text" name="description" value="{{ old('description',$faculty->description)}}">
					@error('description')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>


			<div class="seperator"></div>

			<div class="form-group col-6">
				<label class="col-form-label">Faculty Country</label>
				<div>
					<input class="form-control @error('country') is-invalid @enderror" type="text" name="country" value="{{ old('country',$faculty->country)}}">
					@error('country')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>
			<div class="form-group col-6">
				<label class="col-form-label">Faculty City</label>
				<div>
					<input class="form-control @error('city') is-invalid @enderror" type="text" name="city" value="{{ old('city',$faculty->city)}}">
					@error('city')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>
			<div class="form-group col-12">
				<label class="col-form-label">Faculty Years</label>
				<div>
					<input class="form-control @error('years') is-invalid @enderror" type="text" name="years" value="{{ old('years',$faculty->years)}}">
					@error('years')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>
			
			<div class="col-12">
				<button type="submit" class="btn">{{ $button }}</button>
			</div>
		</div>


    
    

    
    
    
    

    

    