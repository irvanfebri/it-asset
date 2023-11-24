<x-filament-panels::page>

    @if ($this->hasInfolist())
        {{ $this->infolist }}
        <div id="qrcode" style="width: 100px; height:100px; margin-top:15px;"></div>
    @else
        {{ $this->form }}
    @endif

    {{-- @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers
            :active-manager="$activeRelationManager"
            :managers="$relationManagers"
            :owner-record="$record"
            :page-class="static::class"
        />
    @endif --}}
</x-filament-panels::page>
