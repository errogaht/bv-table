<?php
/**
 * @var \App\Contact $contact
 */

$logController = new \App\Http\Controllers\ContactLogController;
?>

@extends('dashboard')


@section('content')

        <div class="row">

        <div class="col-md-5">

            <div class="box box-primary">
                <div class="box-body">


                    <a class="pull-right" href="{{(route('contact.edit', $contact))}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                        <small>изменить</small>
                    </a>

                    <strong><i class="fa fa-mobile margin-r-5"></i> Контакты</strong>
                    <p class="text-muted">
                        {{ $contact->phone }}
                        <?php if ($contact->phone && $contact->email) echo '<br />'; ?>
                        {{ $contact->email }}
                    </p>

                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i>Город, метро</strong>
                    <p class="text-muted">
                        {{ $contact->city }}
                        <?php if ($contact->city && $contact->metro) echo ', '; ?>
                        {{ $contact->metro }}
                    </p>

                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> О себе</strong>
                    @if ($contact->age)
                        <p class="text-muted"><b>Возраст:</b> {{$contact->age}}</p>
                    @endif
                    @if ($contact->how_long)
                        <p class="text-muted"><b>Знаком с СК:</b> {{$contact->how_long}}</p>
                    @endif
                    @if ($contact->preferred_date)
                        <p class="text-muted"><b>Удобно:</b> {{$contact->preferred_date}}</p>
                    @endif

                    <hr>
                    <strong><i class="fa fa-search margin-r-5"></i> Откуда</strong>
                    @if ($contact->source)
                        <p class="text-muted">
                            {{ $contact->source }}
                        </p>
                    @endif
                    @if ($created_by = $contact->created_by_user)
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?php echo $created_by->getProfileImage(); ?>" alt="user image" />
                                <span class="description">
                                    добавил: <a href="{{route('user.show', $created_by)}}">{{$created_by->name}}</a>
                                </span>
                            <span class="description">{{$contact->created_at->format(DATE_FORMAT)}}</span>
                        </div>
                    @endif

                    @if ($value = $contact->comment)
                        <hr>
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Дополнительно</strong>
                        <p class="text-muted"><?php echo nl2br(e($value)); ?></p>
                    @endif

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->



        <!-- Колонка справа -->
        <div class="col-md-7">

            <!-- Форма коммента -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-comment-o"></i>
                    <h3 class="box-title">История</h3>
                </div>
                <div class="box-body">
                    <?php echo $logController->create($contact->id)->render(); ?>
                </div>
            </div>

            <!-- Список комментов -->
            <div class="box box-default">
                <div class="box-body">
                    <?php echo $logController->index($contact->id)->render(); ?>
                </div>
            </div>
        </div><!-- /.col -->


    </div><!-- /.row -->
@endsection
