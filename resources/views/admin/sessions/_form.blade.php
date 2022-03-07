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
					<h3>1. Basic info</h3>
				</div>
			</div>

			<div class="form-group col-12">
				<label class="col-form-label">Session title</label>
				<div>
					<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name',$session->name)}}">
					@error('name')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>

			@if (isset($course_id))
			<input type="hidden" name="course_id" value="{{ $course_id }}">
			@else
			<input type="hidden" name="course_id" value="{{ $session->course_id }}">
			@endif
			

			<div class="form-group col-12">
				<label class="col-form-label">Session Link</label>
				<div>
					<input class="form-control @error('session_link') is-invalid @enderror" type="text" value="{{ old('session_link',$session->session_link)}}" name="session_link">
				</div>
			</div>

			

			<div class="seperator"></div>

			<div class="col-12 m-t20">
				<div class="ml-auto m-b5">
					<h3>Description</h3>
				</div>
			</div>
			<div class="form-group col-12">
				<label class="col-form-label">Course description</label>
				<div>
					<textarea class="form-control @error('description') is-invalid @enderror" name="description">
					{{ old('description',$session->description)}}
				 	</textarea>
					@error('description')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
				</div>
			</div>
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


    
    

    
    
    
    

    

    