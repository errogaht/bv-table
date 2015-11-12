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

        <?php
        $comment = $comment->comment;
        if (false !== strpos($comment, 'json:')): ?>
            <?php $comment = json_decode(substr($comment, 5)); ?>
            <table class="table table-bordered">
                <tr>
                    <th>редактирование</th>
                    <th>было</th>
                    <th>стало</th>
                </tr>
                <?php foreach ($comment as $log): ?>
                <?php list($key, $old, $new) = $log; ?>
                <tr>
                    <td>{{Lang::get('contact.field_'.$key)}}</td>
                    <td>{{$old}}</td>
                    <td>{{$new}}</td>
                </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>
            <p><?php echo nl2br(e($comment)); ?></p>
        <?php endif; ?>
    </div>
@endforeach