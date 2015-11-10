<?php
/**
 * @var \App\ContactLog $comments
 */
?>

@foreach($comments as $comment)
    <?php $user = $comment->user; ?>

    <div class="post clearfix">
        <div class='user-block'>
            <img class='img-circle img-bordered-sm' src='<?php echo $user->getProfileImage(); ?>' />
            <span class='username'><a href="#">{{$user->name}}</a></span>
            <span class='description'>{{$comment->created_at}}</span>
        </div>
        <p>
            {{$comment->comment}}
        </p>
    </div>
@endforeach