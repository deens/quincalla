<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            {!! Form::select('rules[][column]', $rulesColumns, null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select('rules[][relation]', $rulesRelations, null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::text('rules[][condition]', '', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            {!! Form::select('rules[][column]', $rulesColumns, null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select('rules[][relation]', $rulesRelations, null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::text('rules[][condition]', '', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
