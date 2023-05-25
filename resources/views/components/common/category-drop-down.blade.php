<div class="<?= $columnClass ?>">
    <div class="form-group">
        {{-- <label>Constitution Of Business <span style="color:red">*</span></label> --}}
        {!! Form::select($name, $categories, $selected ? $selected : old($name), [ 'placeholder' => 'Select Category', 'class' => ' form-control']) !!}
        @error($name)
            <p class="text-danger fs-12">{{ $message }}</p>
        @enderror
    </div>
</div>
