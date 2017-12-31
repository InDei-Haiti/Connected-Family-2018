@php
  $diffForHumans = $idea->created_at->diffForHumans();
  if($diffForHumans == "1 second ago")
    $diffForHumans = "Just now";
  $diffForHumans = " - " . $diffForHumans;
  $diffForHumans = NULL;
@endphp
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body clear-card">
        <div class="row">
          <div class="col">
            <a href="/profile/{{ $idea->user->username }}">{{ $idea->user->name }}</a> shared an idea.
            <br>
            {{-- Novembe 24, 2017 at 11:36AM --}}
            <a href="/idea/{{ $idea->user->username }}/{{ $idea->id }}"><span class="text-muted article-date">{{ date("F j, Y \a\\t g:iA",  strtotime($idea->created_at)) }}</span></a><span class="text-muted article-date">{{ $diffForHumans }}</span>
            <br>
            <p class="idea-content" style="direction: {{ $idea->direction }}">{!! nl2br($idea->content) !!} </p>
            <hr>
            <div class="row">
              <div class="col">
                <span class="idea-vote cursor-pointer">
                  <i class="fa fa-heart-o fa-fw idea-vote-heart" aria-hidden="true"></i> VOTE
                </span>
              </div>
              <div class="col text-right">
                <i class="fa fa-heart fa-fw idea-vote-heart" aria-hidden="true"></i> 15 VOTES
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
