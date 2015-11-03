<?php
/**
 * @var \App\Contact $contact
 */
$fields = [
        'phone'          => 'Телефон',
        'email'          => 'Email',
        'city'           => 'Город',
        'metro'          => 'Метро',
        'age'            => 'Возраст',
        'how_long'       => 'Как давно знаком с СК',
        'preferred_date' => 'В какие дни удобно',
//        'status'         => '',
        'source'         => 'Откуда',
        'comment'        => 'Комментарий',
];
?>

@extends('dashboard')

@section('content')

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2">
                    <span class="label label-success" style="font-size: 100%; font-weight: normal; padding: 6px 12px;">Новый</span>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                @foreach ($fields as $key => $label)
                    @if ($value = $contact->$key)
                        <dt>{{ $label }}: </dt>
                        <dd> <?php echo nl2br(e($value)); ?></dd>
                    @endif
                @endforeach
            </dl>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

@endsection
