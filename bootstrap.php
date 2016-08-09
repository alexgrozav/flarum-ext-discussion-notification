<?php
use Flarum\Core;
use Flarum\Core\Repository\UserRepository;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Event\DiscussionWasStarted;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

return function (Dispatcher $events, Mailer $mailer) {
  $events->listen(DiscussionWasStarted::class, function (DiscussionWasStarted $event) use ($mailer) {
    $discussion = $event->discussion;
    $content = $discussion->content;
    $mailer->raw($content, function (Message $message) use ($discussion) {
        $message->to('alex@grozav.com');
        $message->subject("[Support] " . $discussion->title);
      }
    );
  });
};
