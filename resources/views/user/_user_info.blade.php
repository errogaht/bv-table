<?php
$user_stats = App\Contact::countUserStats($user);
?>

<div class="box box-primary">
    <div class="box-body box-profile">
        <a href="http://ru.gravatar.com/"><img class="profile-user-img img-responsive img-circle" src="<?php echo $user->getProfileImage(); ?>" /></a>
        <h3 class="profile-username text-center">{{$user->name}}</h3>
        <p class="text-muted text-center">{{$user->role}}</p>
        <p class="text-muted text-center">Санга: {{$user->sanga}}</p>
        <p class="text-muted text-center">Округ: {{$user->circle}}</p>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>В обработке</b> <a class="pull-right" href="{{route('contact.user', $user->id)}}">{{$user_stats[\App\Contact::STATUS_WORK]}}</a>
            </li>
            <li class="list-group-item">
                <b>Посещает</b> <a class="pull-right" href="{{route('contact.user', $user->id)}}">{{$user_stats[\App\Contact::STATUS_SUCCESS]}}</a>
            </li>
        </ul>
    </div><!-- /.box-body -->
</div><!-- /.box -->
