{!! Modal::start($modal) !!}
<div class="form-group row">
    <label for="input_name" class="col-sm-3 col-form-label">Name:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="input_name" name="name"
               placeholder="Enter name" required value="{{ isset($role) ? $role->name : old('name')}}">
    </div>
</div>
<div class="form-group row">
    <label for="input_desc" class="col-sm-3 col-form-label">Description:</label>
    <div class="col-sm-9">
                <textarea class="form-control" id="input_desc"
                          cols="4"
                          name="description" placeholder="Enter description" required>
                    {{ isset($role) ? $role->description : old('description') }}
                </textarea>
    </div>
</div>
{!! Modal::end() !!}