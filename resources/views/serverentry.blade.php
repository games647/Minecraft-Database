                        <tr>
                            <td>
                                <a href="/server/{{ $server->address }}">
@if (file_exists(public_path() . "/img/favicons/" . $server->address . ".png"))
                                    <img class="serverIcon" src="/img/favicons/{{ $server->address }}.png"
                                         alt="{{ $server->address }} favicon"/>
@else
                                    <img class="serverIcon" src="/img/favicons/default.png" alt="Default favicon"/>
@endif
                                </a>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>Servername: </td>
                                        <td class="serverName">
                                            <a href="/server/{{ $server->address }}">
                                                {{ $server->address }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Motd: </td>
                                        <td class="motd">
                                            {!! $server->getHtmlMotd() !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Onlinemode: </td>
                                        <td>
@if (is_null($server->onlinemode))
                                            <span class="label label-info">Unknown</span>
@elseif ($server->onlinemode)
                                            <span class="label label-success">Premium</span>
@else
                                            <span class="label label-danger">Cracked</span>
@endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Others: </td>
                                        <td>
@if ($server->online)
                                            <span class="label label-success">Online</span>
@else
                                            <span class="label label-danger">Offline</span>
@endif
                                            <span class="label label-info">{{ $server->version }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
@if ($server->online)
                                <div class="online">{{ $server->players }} / {{ $server->maxplayers }}</div>
@else
                                <div class="offline">0 / {{ $server->maxplayers }}</div>
@endif
                            </td>
                        </tr>