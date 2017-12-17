
<!-- Demo version: 2017.08.06 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.webrtc-experiment.com/style.css">

    <title>WebRTC Scalable Video Broadcast using RTCMultiConnection</title>

    <meta name="description" content="This module simply initializes socket.io and configures it in a way that single audio/video/screen stream can be shared/relayed over unlimited users without any bandwidth/CPU usage issues. Everything happens peer-to-peer!" />
    <meta name="keywords" content="WebRTC,RTCMultiConnection,Demos,Experiments,Samples,Examples" />

    <style>
        video {
            object-fit: fill;
            width: 30%;
        }
        button,
        input,
        select {
            font-weight: normal;
            padding: 2px 4px;
            text-decoration: none;
            display: inline-block;
            text-shadow: none;
            font-size: 16px;
            outline: none;
        }

        .make-center {
            text-align: center;
            padding: 5px 10px;
        }

        button, input, select {
            font-family: Myriad, Arial, Verdana;
            font-weight: normal;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            padding: 4px 12px;
            text-decoration: none;
            color: rgb(27, 26, 26);
            display: inline-block;
            box-shadow: rgb(255, 255, 255) 1px 1px 0px 0px inset;
            text-shadow: none;
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(0.05, rgb(241, 241, 241)), to(rgb(230, 230, 230)));
            font-size: 20px;
            border: 1px solid red;
            outline:none;
            vertical-align: middle;
        }
        button, select {
            height: 35px;
            margin: 0 5px;
        }

        button:hover, input:hover, select:hover {
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(5%, rgb(221, 221, 221)), to(rgb(250, 250, 250)));
            border: 1px solid rgb(142, 142, 142);
        }

        button:active, input:active, select:active, button:focus, input:focus, select:focus {
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(5%, rgb(183, 183, 183)), to(rgb(255, 255, 255)));
            border: 1px solid rgb(142, 142, 142);
        }
        button[disabled], iput[disabled], select[disabled] {
            background: rgb(249, 249, 249);
            border: 1px solid rgb(218, 207, 207);
            color: rgb(197, 189, 189);
        }
        input, input:focus, input:active {
            background: white;
        }

        video {
            width: 30%;
        }
    </style>
</head>

<body>
<article>

    <header style="text-align: center;">
        <h1><a href="https://github.com/muaz-khan/WebRTC-Scalable-Broadcast">WebRTC Scalable Video Broadcast</a> using <a href="https://github.com/muaz-khan/RTCMultiConnection">RTCMultiConnection</a></h1>
        <p>
            <a href="https://rtcmulticonnection.herokuapp.com/">HOME</a>
            <span> &copy; </span>
            <a href="http://www.MuazKhan.com/" target="_blank">Muaz Khan</a> .
            <a href="http://twitter.com/WebRTCWeb" target="_blank" title="Twitter profile for WebRTC Experiments">@WebRTCWeb</a> .
            <a href="https://github.com/muaz-khan?tab=repositories" target="_blank" title="Github Profile">Github</a> .
            <a href="https://github.com/muaz-khan/RTCMultiConnection/issues?state=open" target="_blank">Latest issues</a> .
            <a href="https://github.com/muaz-khan/RTCMultiConnection/commits/master" target="_blank">What's New?</a>
        </p>
    </header>

    <div class="github-stargazers"></div>

    <section class="experiment">
        <div class="make-center">
            <input type="text" id="broadcast-id" placeholder="broadcast-id" value="room-xyz">
            <select id="broadcast-options">
                <option>Audio+Video</option>
                <option title="Works only in Firefox.">Audio+Screen</option>
                <option>Audio</option>
                <option>Video</option>
                <option title="Screen capturing requries HTTPs. Please run this demo on HTTPs to make sure it can capture your screens.">Screen</option>
            </select>
            <button id="open-or-join">Open or Join Broadcast</button>
        </div>

        <div id="videos-container"></div>
    </section>

    <blockquote>
        This module simply initializes socket.io and configures it in a way that single audio/video/screen stream can be shared/relayed over unlimited users without any <a href="https://www.webrtc-experiment.com/docs/RTP-usage.html">bandwidth/CPU usage issues</a>. Everything happens peer-to-peer!

        <br><br>
        Share files with unlimited users using p2p methods! <a href="/demos/Files-Scalable-Broadcast.html">Files Scalable Broadcast</a> or <a href="/demos/Scalable-Broadcast.html">all-in-one scalable broadcast</a>.
    </blockquote>

    <script src="https://cdn.webrtc-experiment.com/RTCMultiConnection.js"></script>
    <script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>

    <script>
        var maxRelayLimitPerUser = 2;
        var parameters = '';

        parameters += '?enableScalableBroadcast=true';
        parameters += '&maxRelayLimitPerUser=' + maxRelayLimitPerUser;

        var socket = io.connect('https://rtcmulticonnection.herokuapp.com:443/' + parameters);

        // using single socket for RTCMultiConnection signaling
        var onMessageCallbacks = {};
        socket.on('scalable-broadcast-message', function(data) {
            if (data.sender == connection.userid) return;
            if (onMessageCallbacks[data.channel]) {
                onMessageCallbacks[data.channel](data.message);
            };
        });

        socket.on('logs', function(log) {
            document.querySelector('h1').innerHTML = log.replace(/</g, '----').replace(/>/g, '___').replace(/----/g, '(<span style="color:red;">').replace(/___/g, '</span>)');
        });

        // initializing RTCMultiConnection constructor.
        function initRTCMultiConnection(userid) {
            var connection = new RTCMultiConnection();
            document.getElementById('broadcast-id').value = connection.token();
            connection.body = document.getElementById('videos-container');
            connection.channel = connection.sessionid = connection.userid = userid || connection.userid;
            connection.sdpConstraints.mandatory = {
                OfferToReceiveAudio: false,
                OfferToReceiveVideo: true
            };
            // using socket.io for signaling
            connection.openSignalingChannel = function(config) {
                var channel = config.channel || this.channel;
                onMessageCallbacks[channel] = config.onmessage;
                if (config.onopen) setTimeout(config.onopen, 1000);
                return {
                    send: function(message) {
                        socket.emit('scalable-broadcast-message', {
                            sender: connection.userid,
                            channel: channel,
                            message: message
                        });
                    },
                    channel: channel
                };
            };
            connection.onMediaError = function(error) {
                alert(JSON.stringify(error));
            };
            return connection;
        }

        // this RTCMultiConnection object is used to connect with existing users
        var connection = initRTCMultiConnection();

        connection.getExternalIceServers = false;

        var broadcastId = '';
        if(localStorage.getItem('rmc-broadcast-id')) {
            broadcastId = localStorage.getItem('rmc-broadcast-id');
        }
        else {
            broadcastId = connection.token();
        }
        document.getElementById('broadcast-id').value = broadcastId;
        document.getElementById('broadcast-id').onkeyup = function() {
            localStorage.setItem('rmc-broadcast-id', this.value);
        };

        connection.onstream = function(event) {
            connection.body.appendChild(event.mediaElement);

            if (connection.isInitiator == false && !connection.broadcastingConnection) {
                // "connection.broadcastingConnection" global-level object is used
                // instead of using a closure object, i.e. "privateConnection"
                // because sometimes out of browser-specific bugs, browser
                // can emit "onaddstream" event even if remote user didn't attach any stream.
                // such bugs happen often in chrome.
                // "connection.broadcastingConnection" prevents multiple initializations.

                // if current user is broadcast viewer
                // he should create a separate RTCMultiConnection object as well.
                // because node.js server can allot him other viewers for
                // remote-stream-broadcasting.
                connection.broadcastingConnection = initRTCMultiConnection(connection.userid);

                // to fix unexpected chrome/firefox bugs out of sendrecv/sendonly/etc. issues.
                connection.broadcastingConnection.onstream = function() {};

                connection.broadcastingConnection.session = connection.session;
                connection.broadcastingConnection.attachStreams.push(event.stream); // broadcast remote stream
                connection.broadcastingConnection.dontCaptureUserMedia = true;

                // forwarder should always use this!
                connection.broadcastingConnection.sdpConstraints.mandatory = {
                    OfferToReceiveVideo: false,
                    OfferToReceiveAudio: false
                };

                connection.broadcastingConnection.open({
                    dontTransmit: true
                });
            }
        };

        // ask node.js server to look for a broadcast
        // if broadcast is available, simply join it. i.e. "join-broadcaster" event should be emitted.
        // if broadcast is absent, simply create it. i.e. "start-broadcasting" event should be fired.
        document.getElementById('open-or-join').onclick = function() {
            var broadcastid = document.getElementById('broadcast-id').value;
            if (broadcastid.replace(/^\s+|\s+$/g, '').length <= 0) {
                alert('Please enter broadcast-id');
                document.getElementById('broadcast-id').focus();
                return;
            }

            this.disabled = true;

            connection.session = {
                video: document.getElementById('broadcast-options').value.indexOf('Video') !== -1,
                screen: document.getElementById('broadcast-options').value.indexOf('Screen') !== -1,
                audio: document.getElementById('broadcast-options').value.indexOf('Audio') !== -1,
                oneway: true
            };

            socket.emit('join-broadcast', {
                broadcastid: broadcastid,
                userid: connection.userid,
                typeOfStreams: connection.session
            });
        };

        // this event is emitted when a broadcast is already created.
        socket.on('join-broadcaster', function(hintsToJoinBroadcast) {
            connection.session = hintsToJoinBroadcast.typeOfStreams;
            connection.channel = connection.sessionid = hintsToJoinBroadcast.userid;

            connection.sdpConstraints.mandatory = {
                OfferToReceiveVideo: !!connection.session.video,
                OfferToReceiveAudio: !!connection.session.audio
            };

            connection.join({
                sessionid: hintsToJoinBroadcast.userid,
                userid: hintsToJoinBroadcast.userid,
                extra: {},
                session: connection.session
            });
        });

        // this event is emitted when a broadcast is absent.
        socket.on('start-broadcasting', function(typeOfStreams) {
            // host i.e. sender should always use this!
            connection.sdpConstraints.mandatory = {
                OfferToReceiveVideo: false,
                OfferToReceiveAudio: false
            };
            connection.session = typeOfStreams;
            connection.open({
                dontTransmit: true
            });

            if (connection.broadcastingConnection) {
                // if new person is given the initiation/host/moderation control
                connection.broadcastingConnection.close();
                connection.broadcastingConnection = null;
            }
        });

        window.onbeforeunload = function() {
            // Firefox is weird!
            document.getElementById('open-or-join').disabled = false;
        };
    </script>

    <section class="experiment" id="demos"><details><summary style="text-align:center;">Check 51 other RTCMultiConnection-v3 demos</summary><h2 style="text-align:center;display:block;"><a href="https://www.npmjs.com/package/rtcmulticonnection-v3"><img src="https://img.shields.io/npm/v/rtcmulticonnection-v3.svg"></a><a href="https://www.npmjs.com/package/rtcmulticonnection-v3"><img src="https://img.shields.io/npm/dm/rtcmulticonnection-v3.svg"></a><a href="https://travis-ci.org/muaz-khan/RTCMultiConnection"><img src="https://travis-ci.org/muaz-khan/RTCMultiConnection.png?branch=master"></a></h2><ol><li><a href="/demos/Audio+ScreenSharing.html">Audio+ScreenSharing.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Audio+ScreenSharing.html">Source</a>)</li><li><a href="/demos/Audio+Video+TextChat+FileSharing.html">Audio+Video+TextChat+FileSharing.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Audio+Video+TextChat+FileSharing.html">Source</a>)</li><li><a href="/demos/Audio-Conferencing.html">Audio-Conferencing.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Audio-Conferencing.html">Source</a>)</li><li><a href="/demos/Audio-Video-Screen.html">Audio-Video-Screen.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Audio-Video-Screen.html">Source</a>)</li><li><a href="/demos/Cross-Domain-Screen-Capturing.html">Cross-Domain-Screen-Capturing.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Cross-Domain-Screen-Capturing.html">Source</a>)</li><li><a href="/demos/Disconnect+Rejoin.html">Disconnect+Rejoin.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Disconnect+Rejoin.html">Source</a>)</li><li><a href="/demos/Files-Scalable-Broadcast.html">Files-Scalable-Broadcast.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Files-Scalable-Broadcast.html">Source</a>)</li><li><a href="/demos/Firebase-Demo.html">Firebase-Demo.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Firebase-Demo.html">Source</a>)</li><li><a href="/demos/MCU.html">MCU.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/MCU.html">Source</a>)</li><li><a href="/demos/Multi-Broadcasters-and-Many-Viewers.html">Multi-Broadcasters-and-Many-Viewers.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Multi-Broadcasters-and-Many-Viewers.html">Source</a>)</li><li><a href="/demos/One-to-One.html">One-to-One.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/One-to-One.html">Source</a>)</li><li><a href="/demos/Password-Protected-Rooms.html">Password-Protected-Rooms.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Password-Protected-Rooms.html">Source</a>)</li><li><a href="/demos/Pre-recorded-Media-Streaming.html">Pre-recorded-Media-Streaming.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Pre-recorded-Media-Streaming.html">Source</a>)</li><li><a href="/demos/PubNub-Demo.html">PubNub-Demo.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/PubNub-Demo.html">Source</a>)</li><li><a href="/demos/SFU.html">SFU.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/SFU.html">Source</a>)</li><li><a href="/demos/SSEConnection.html">SSEConnection.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/SSEConnection.html">Source</a>)</li><li><a href="/demos/Scalable-Broadcast.html">Scalable-Broadcast.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Scalable-Broadcast.html">Source</a>)</li><li><a href="/demos/Scalable-Screen-Broadcast.html">Scalable-Screen-Broadcast.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Scalable-Screen-Broadcast.html">Source</a>)</li><li><a href="/demos/Scalable-Screen-plus-Audio-Broadcast.html">Scalable-Screen-plus-Audio-Broadcast.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Scalable-Screen-plus-Audio-Broadcast.html">Source</a>)</li><li><a href="/demos/Scalable-Video-Conferencing.html">Scalable-Video-Conferencing.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Scalable-Video-Conferencing.html">Source</a>)</li><li><a href="/demos/StreamHasData.html">StreamHasData.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/StreamHasData.html">Source</a>)</li><li><a href="/demos/TextChat+FileSharing.html">TextChat+FileSharing.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/TextChat+FileSharing.html">Source</a>)</li><li><a href="/demos/Translate-TextChat.html">Translate-TextChat.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Translate-TextChat.html">Source</a>)</li><li><a href="/demos/Video-Conferencing.html">Video-Conferencing.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Video-Conferencing.html">Source</a>)</li><li><a href="/demos/Video-Scalable-Broadcast.html">Video-Scalable-Broadcast.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Video-Scalable-Broadcast.html">Source</a>)</li><li><a href="/demos/Videos-Layout.html">Videos-Layout.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/Videos-Layout.html">Source</a>)</li><li><a href="/demos/WebSocket-Demo.html">WebSocket-Demo.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/WebSocket-Demo.html">Source</a>)</li><li><a href="/demos/addStream-in-Chat-room.html">addStream-in-Chat-room.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/addStream-in-Chat-room.html">Source</a>)</li><li><a href="/demos/admin-guest.html">admin-guest.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/admin-guest.html">Source</a>)</li><li><a href="/demos/applyConstraints.html">applyConstraints.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/applyConstraints.html">Source</a>)</li><li><a href="/demos/autoCreateMediaElement.html">autoCreateMediaElement.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/autoCreateMediaElement.html">Source</a>)</li><li><a href="/demos/change-resolutions.html">change-resolutions.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/change-resolutions.html">Source</a>)</li><li><a href="/demos/checkPresence.html">checkPresence.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/checkPresence.html">Source</a>)</li><li><a href="/demos/custom-socket-event.html">custom-socket-event.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/custom-socket-event.html">Source</a>)</li><li><a href="/demos/file-sharing.html">file-sharing.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/file-sharing.html">Source</a>)</li><li><a href="/demos/getPublicModerators.html">getPublicModerators.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/getPublicModerators.html">Source</a>)</li><li><a href="/demos/getStats.html">getStats.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/getStats.html">Source</a>)</li><li><a href="/demos/keep-rejoining.html">keep-rejoining.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/keep-rejoining.html">Source</a>)</li><li><a href="/demos/replaceTrack.html">replaceTrack.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/replaceTrack.html">Source</a>)</li><li><a href="/demos/screen-sharing.html">screen-sharing.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/screen-sharing.html">Source</a>)</li><li><a href="/demos/share-part-of-screen.html">share-part-of-screen.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/share-part-of-screen.html">Source</a>)</li><li><a href="/demos/switch-cameras.html">switch-cameras.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/switch-cameras.html">Source</a>)</li><li><a href="/demos/v2-conference.html">v2-conference.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/v2-conference.html">Source</a>)</li><li><a href="/demos/video-broadcasting.html">video-broadcasting.html</a> (<a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/demos/video-broadcasting.html">Source</a>)</li><ol></details></section><section class="experiment" id="docs"><details><summary style="text-align:center;">RTCMultiConnection Docs</summary><h2 style="text-align:center;display:block;"><a href="http://www.rtcmulticonnection.org/docs/">http://www.rtcmulticonnection.org/docs/</a></h2><ol><li><a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/docs/README.md">README.md</a></li><li><a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/docs/api.md">api.md</a></li><li><a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/docs/getting-started.md">getting-started.md</a></li><li><a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/docs/how-to-use.md">how-to-use.md</a></li><li><a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/docs/installation-guide.md">installation-guide.md</a></li><li><a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/docs/ios-android.md">ios-android.md</a></li><li><a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/docs/tips-tricks.md">tips-tricks.md</a></li><li><a href="https://github.com/muaz-khan/RTCMultiConnection/tree/master/docs/upgrade.md">upgrade.md</a></li></ol></details></section><section class="experiment own-widgets latest-commits">
        <h2 class="header" id="updates" style="color: red;padding-bottom: .1em;"><a href="https://github.com/muaz-khan/RTCMultiConnection/commits/master">Latest Updates</a></h2>
        <div id="github-commits"></div>
    </section>

    <section class="experiment own-widgets">
        <h2 class="header" id="updates" style="color: red;padding-bottom: .1em;"><a href="https://github.com/muaz-khan/RTCMultiConnection/issues">Latest Issues</a></h2>
        <div id="github-issues"></div>
    </section>

    <section class="experiment">
        <h2 class="header" id="feedback">Feedback</h2>
        <div>
            <textarea id="message" style="height: 8em; margin: .2em; width: 98%; border: 1px solid rgb(189, 189, 189); outline: none; resize: vertical;" placeholder="Have any message? Suggestions or something went wrong?"></textarea>
        </div>
        <button id="send-message" style="font-size: 1em;">Send Message</button><small style="margin-left:1em;">Enter your email too; if you want "direct" reply!</small>
    </section>

    <a href="https://github.com/muaz-khan/RTCMultiConnection" class="fork-left"></a>

    <script>
        window.useThisGithubPath = 'muaz-khan/RTCMultiConnection';
    </script>
    <script src="https://cdn.webrtc-experiment.com/commits.js" async></script>

</article>

<footer>
    <p>
        <a href="https://www.webrtc-experiment.com">WebRTC Experiments</a> © <a href="https://plus.google.com/+MuazKhan" rel="author" target="_blank">Muaz Khan</a>
        <a href="mailto:muazkh@gmail.com" target="_blank">muazkh@gmail.com</a>
        <a href="https://github.com/muaz-khan" target="_blank">Github</a>
    </p>
</footer>

</body>

</html>
