<?php

use Flarum\Event\PostWillBeSaved;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

return function (Dispatcher $events, Mailer $mailer) {
  $events->listen(DiscussionWillBeSaved::class, function (DiscussionWillBeSaved $event) {
    $discussion = $event->discussion;
    // $content =  $event->actor->username .
    //             " has started a new discussion at " .
    //             $discussion->url .
    //             ": <br>" .
    //             $event->discussion->content;

    $content = "ERMAHGERD.";
    $mailer->raw($content, function (Message $message) use ($discussion) {
            $message->to('alex@grozav.com');
            $message->subject("[Support] ");
        }
    );
  });
};
