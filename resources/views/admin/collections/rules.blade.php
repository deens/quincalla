<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            {!! Form::select(
                'rules[][column]',
                $rulesColumns,
                isset($collection->rules[0][0]->column)
                ? $collection->rules[0][0]->column
                : old('rules[][relation]')
                , ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select(
                'rules[][relation]',
                $rulesRelations,
                isset($collection->rules[0][1]->relation)
                ? $collection->rules[0][1]->relation
                : old('rules[][relation]'),
                ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::text(
                'rules[][condition]',
                isset($collection->rules[0][2]->condition)
                ? $collection->rules[0][2]->condition
                : old('rules[][condition]'),
                ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            {!! Form::select(
                'rules[][column]',
                $rulesColumns,
                isset($collection->rules[1][0]->column)
                ? $collection->rules[1][0]->column
                : old('rules[][relation]')
                , ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::select(
                'rules[][relation]',
                $rulesRelations,
                isset($collection->rules[1][1]->relation)
                ? $collection->rules[1][1]->relation
                : old('rules[][relation]'),
                ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-4">
            {!! Form::text(
                'rules[][condition]',
                isset($collection->rules[1][2]->condition)
                ? $collection->rules[1][2]->condition
                : old('rules[][condition]'),
                ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

