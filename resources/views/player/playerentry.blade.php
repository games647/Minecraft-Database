<tr>
    <td class="playerIcon">
        <a href="/player/{{ $player->uuid }}">
            @if (file_exists(public_path() . "/img/favicons/" . $player->uuid . ".png"))
            <img src="/img/favicons/{{ $player->uuid }}.png"
                 alt="{{ $server->address }} favicon"/>
            @else
            <img src="/img/favicons/head_default.png" style="position: relative; left: 25%;" alt="Default Head"/>
            @endif
        </a>
    </td>
    <td>
        <table class="playerTable">
            <tr>
                <td>Username: </td>
                <td class="playerName">
                    <a href="/player/{{ $player->uuid }}">
                        {{ $player->name }}
                    </a>
                </td>
            </tr>
            <tr>
                <td>UUID: </td>
                <td class="uuid">
                    {!! $player->uuid !!}
                </td>
            </tr>
        </table>
    </td>
</tr>
