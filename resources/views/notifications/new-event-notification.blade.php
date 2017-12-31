@include('vendor.clear')
<div class="row justify-content-center">
  <div class="col-12 text-center">
    <div class="card" style="border: 1px solid #e51178; box-shadow: -1px -1px 25px #ccc;">
      <div class="card-block clear-card">
        @php
          $show_new_event_notification_is_valid = true;
          if($user = Auth::user())
            $show_new_event_notification_is_valid = (!$user->isParticipant($new_event)) ? true : false;
        @endphp
        @if($show_new_event_notification_is_valid)
          <h1 class="">
            Our
            @if($new_event->isClosed())
              last
            @else
              new
            @endif
            event
            <span class="font-weight-bold font-pink text-uppercase">{{ $new_event->name }}'@php echo substr($new_event->year, 2); @endphp</span>
            is
            @if($new_event->isOpened())
              Here!
            @elseif($new_event->isClosed())
              Closed!
            @else
              Upcoming!
            @endif
          </h1>
          <p
            @if($new_event->id == 11005 || $new_event->id == 11006)
              style="direction: rtl;"
            @endif
          >
          @if($new_event->description)
              {!! nl2br(substr($new_event->description, 0, 1024)) !!}...
            @else
              No Description Found
            @endif
            <a href="/event/{{ $new_event->name }}-{{ $new_event->year }}">More info</a>
          </p>
          @if($new_event->isOpened())
            <div class="row">
              <div class="col-md-4 offset-md-4">
                <a class="btn btn-danger btn-block cursor-pointer"
                    href="/event/{{ $new_event->name }}-{{ $new_event->year }}/registration">
                  Register now
                </a>
              </div>
            </div>
          @endif
        @else
          <h3>Thanks of being participant in our <b>{{ $new_event->name }}'@php echo substr($new_event->year, 2); @endphp</b> event</h3>
          <p>
            If you want to track phases of your registration, You can do so from this link:
            <a href="/event/{{ $new_event->name }}-{{ $new_event->year }}/registration/tracking">Tracking registration</a>
          </p>
        @endif
      </div>
    </div>
  </div>
</div>
