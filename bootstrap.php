<?php

use Flarum\Event\PostWillBeSaved;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

return function (Dispatcher $events, Mailer $mailer) {
  $events->listen(DiscussionWillBeSaved::class, function (DiscussionWillBeSaved $event) {
    $title = $event->discussion->title;
    $url = $event->discussion->url;
    $content =  $event->actor->username .
                " has started a new discussion at " .
                $link .
                ": <br>" .
                $event->discussion->content;

    $mailer->raw(
        ['raw' => $content],
        function (Message $message) use ($title) {
            $message->to('alex@pixevil.com', "Alex Grozav")
                    ->subject("[Support] " . $title);
        }
    );
  });
};
