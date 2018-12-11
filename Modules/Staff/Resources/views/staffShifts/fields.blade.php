<fieldset>

    <!-- shift_name input-->
    <div class="form-group {{ $errors->has('shift_name') ? 'has-error' : '' }}">
        <label class="col-md-3 control-label" for="shift_name">Shift Name:</label>
        <div class="col-md-8">
            <input type="text" id="shift_name" name="shift_name" class="form-control" placeholder="Shift Name" value="{{ isset($staffShift->shift_name) ? $staffShift->shift_name : old('shift_name') }}">
            @if($errors->has('shift_name'))
                <p class="text-danger">{{ $errors->first('shift_name') }}</p>
            @endif
        </div>
    </div>

    <!-- Enter shift_descr Field -->
    <div class="form-group {{ $errors->has('shift_descr') ? 'has-error' : '' }}">
        <label class="col-md-3 control-label" for="shift_descr">Shift Descr:</label>
        <div class="col-md-8">
            <input type="text" id="shift_descr" name="shift_descr" class="form-control" placeholder="Enter Shift Descr" value="{{ isset($staffShift->shift_descr) ? $staffShift->shift_descr : old('shift_descr') }}">
            @if($errors->has('shift_descr'))
                <p class="text-danger">{{ $errors->first('shift_descr') }}</p>
            @endif
        </div>
    </div>



    <!-- Enter start_from Field -->
    <div class="form-group {{ $errors->has('start_from') ? 'has-error' : '' }}">
        <label class="col-md-3 control-label" for="start_from">Start From:</label>
        <div class="col-md-8">
            <input type="text" id="start_from" name="start_from" class="form-control click24hours" placeholder="Enter Start From" value="{{ isset($staffShift->start_from) ? $staffShift->start_from : old('start_from') }}">
            @if($errors->has('start_from'))
                <p class="text-danger">{{ $errors->first('start_from') }}</p>
            @endif
        </div>
    </div>

    <!-- Enter ends_at Field -->
    <div class="form-group {{ $errors->has('ends_at') ? 'has-error' : '' }}">
        <label class="col-md-3 control-label" for="start_from">Ends at:</label>
        <div class="col-md-8">
            <input type="text" id="ends_at" name="ends_at" class="form-control click24hours" placeholder="Enter Ends at" value="{{ isset($staffShift->ends_at) ? $staffShift->ends_at : old('ends_at') }}">
            @if($errors->has('ends_at'))
                <p class="text-danger">{{ $errors->first('ends_at') }}</p>
            @endif
        </div>
    </div>

    <!-- Submit Field -->
    <div class="form-group text-center">
        <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Save</button>
        <a href="{!! route('staffShifts.index') !!}" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> Cancel</a>
    </div>

</fieldset>