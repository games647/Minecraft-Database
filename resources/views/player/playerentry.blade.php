                    <tr>
                        <td class="icon">
                            <a href="/player/{{ $player->uuid }}">
@if (file_exists(public_path() . "/img/head/" . $player->uuid . ".png"))
                                <img src="/img/head/{{ $player->uuid }}.png" alt="{{ $player->name }} Head"
                                     class="icon"/>
@else
                                <img src="/img/head/default.png" alt="Default icon" class="icon"/>
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
                                        {{ $player->uuid }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
