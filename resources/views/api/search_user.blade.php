<div class="kt-quick-search__result">
  @if ($user_list->count() <= 0 && $character_list->count() <= 0)
      <div class="kt-quick-search__message kt-hidden">
        No record found
      </div>
  @else
    @if ($user_list->count() > 0)
      <div class="kt-quick-search__category">
        Users
      </div>
      <div class="kt-quick-search__section">
        @foreach ($user_list as $user)
          <div class="kt-quick-search__item">
            <div class="kt-quick-search__item-wrapper">
              <a href="{{ route('lookup.user.search', ['user' => $user]) }}" class="kt-quick-search__item-title">
                {{ $user->username }}
              </a>
              <div class="kt-quick-search__item-desc">
                {{ $user->getRank() }}
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    @if ($character_list->count() > 0)
      <div class="kt-quick-search__category">
        Characters
      </div>
      <div class="kt-quick-search__section">
        @foreach ($character_list as $character)
          <div class="kt-quick-search__item">
            <div class="kt-quick-search__item-wrapper">
              <a href="{{ route('lookup.user.search', ['user' => $character->user]) }}" class="kt-quick-search__item-title">
                {{ $character->name }}
              </a>
              <div class="kt-quick-search__item-desc">
                Linked to <a href="#">{{ $character->user->username }}</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  @endif
</div>
