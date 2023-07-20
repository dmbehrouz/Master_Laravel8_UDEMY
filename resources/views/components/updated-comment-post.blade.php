<div>
    <!-- It is never too late to be what you might have been. - George Eliot -->
    <p class="text-muted">
        {{-- diffforhuman used in carbon class--}}
        {{ !empty(trim($slot)) ? $slot : 'Added ' }}
        {{ !empty(trim($slot)) ?
            $params['dateUpdate']->diffForHumans() :
            (isset($params['date']) ? $params['date']->diffForHumans() : '')  }}

        @if( isset($params['name']) )
            by {{ $params['name'] }}
        @endif
    </p>
</div>
