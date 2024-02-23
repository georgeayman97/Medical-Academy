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
					<h3>1. Subject info</h3>
				</div>
			</div>

			<div class="form-group col-6">
				<label class="col-form-label">Subject Name</label>
				<div>
					<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name',$subject->name)}}">
					@error('name')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>
			<div class="form-group col-6">
				<label class="col-form-label">Subject Year</label>
				<div>
					<input class="form-control @error('year') is-invalid @enderror" type="text" name="year" value="{{ old('year',$subject->year)}}">
					@error('year')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>
			<div class="form-group col-12">
				<label class="col-form-label" for="">Faculty Name</label>
				<select name="faculty_id" id="faculty_id" class="form-control @error('faculty_id') is-invalid @enderror">
					<option value="">No Faculty</option>
					@foreach($faculties as $faculty)
					<option value="{{ $faculty->id }}" @if($faculty->id == old('faculty_id',$subject->faculty_id)) selected @endif>{{ $faculty->name }}</option>
					@endforeach
				</select>
				@error('faculty_id')
				<p class="invalid-feedback">{{ $message }}</p>
				@enderror
			</div>
			<div class="form-group col-12">
				<label class="col-form-label">Subject Description</label>
				<div>
					<input class="form-control @error('description') is-invalid @enderror" type="text" name="description" value="{{ old('description',$subject->description)}}">
					@error('description')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>

			<div class="form-group col-12">
				<label class="col-form-label">Image</label>
				<input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image_path',$subject->image_path)}}" name="image">
				@error('image')
				<p class="invalid-feedback">{{ $message }}</p>
				@enderror
			</div>
			
			

		


			<div class="seperator"></div>

			
			
			<!-- <div class="col-12 m-t20">
				<div class="ml-auto">
					<h3 class="m-form__section">3. Add Item</h3>
				</div>
			</div>
			<div class="col-12">
				<table id="item-add" style="width:100%;">
					<tr class="list-item">
						<td>
							<div class="row">
								<div class="col-md-4">
									<label class="col-form-label">Course Name</label>
									<div>
										<input class="form-control" type="text" value="">
									</div>
								</div>
								<div class="col-md-3">
									<label class="col-form-label">Course Category</label>
									<div>
										<input class="form-control" type="text" value="">
									</div>
								</div>
								<div class="col-md-3">
									<label class="col-form-label">Course Category</label>
									<div>
										<input class="form-control" type="text" value="">
									</div>
								</div>
								<div class="col-md-2">
									<label class="col-form-label">Close</label>
									<div class="form-group">
										<a class="delete" href="#"><i class="fa fa-close"></i></a>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div> -->
			<div class="col-12">
				<!-- <button type="button" class="btn-secondry add-item m-r5"><i class="fa fa-fw fa-plus-circle"></i>Add Item</button> -->
				<button type="submit" class="btn">{{ $button }}</button>
			</div>
		</div>


    
    

    
    
    
    

    

    